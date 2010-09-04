<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Demo extends Controller {

	/**
	 * @var  string  API 
	 */
	protected $api;

	/**
	 * @var  string  demo name
	 */
	protected $demo;

	/**
	 * @var  string  demo content
	 */
	protected $content;

	/**
	 * @var  object  OAuth_Provider
	 */
	protected $provider;

	/**
	 * @var  object  OAuth_Consumer
	 */
	protected $consumer;

	/**
	 * @var  object  OAuth_Token
	 */
	protected $token;

	public function before()
	{
		$this->request->response = View::factory('api/demo')
			->bind('content', $this->content)
			->bind('api', $this->api)
			->bind('demo', $this->demo)
			->bind('demos', $demos)
			;

		// Get the name of the demo from the class name
		$provider = strtolower($this->api = preg_replace('/^Controller_(.+)_Demo$/i', '$1', get_class($this)));

		// Load the provider
		$this->provider = OAuth_Provider::factory($provider);

		// Load the consumer
		$this->consumer = OAuth_Consumer::factory(Kohana::config("oauth.{$provider}"));

		// Load the cookie session
		$this->session = Session::instance('cookie');

		// Start reflection to get the demo list
		$class   = new ReflectionClass($this);
		$methods = $class->getMethods();

		$demos = array();
		foreach ($methods as $method)
		{
			if (preg_match('/^demo_(.+)$/i', $method->name, $matches))
			{
				// Set the demo name
				$demo = $matches[1];

				// Add the demo link
				$demos[$demo] = $this->request->uri(array('action' => 'api', 'id' => strtolower($demo)));
			}
		}

		return parent::before();
	}

	public function action_index()
	{
		// Nothing, the user must choose a demo
	}

	public function action_api($method)
	{
		// Set the demo name
		$this->demo = $method;

		// Get the method name for the demo
		$method = "demo_{$method}";

		// Execute the demo
		$this->$method();
	}

	public function after()
	{
		$this->request->response->title = $this->api.($this->demo ? ": {$this->demo}" : '');

		return parent::after();
	}

} // End Demo