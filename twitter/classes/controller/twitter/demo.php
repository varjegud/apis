<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Twitter_Demo extends Controller_Demo {

	public function demo_account_verify_credentials()
	{
		$api = Twitter::factory('account');

		$response = $api->verify_credentials($this->consumer, $this->token);

		$this->content = Kohana::debug($response);
	}

	public function demo_account_rate_limit_status()
	{
		$api = Twitter::factory('account');

		$response = $api->rate_limit_status($this->consumer, $this->token);

		$this->content = Kohana::debug($response);
	}

	public function demo_account_end_session()
	{
		$api = Twitter::factory('account');

		$response = $api->end_session($this->consumer, $this->token);

		// The access token is not valid after ending the session
		$this->session->delete($this->key('access'));

		$this->content = Kohana::debug($response);
	}

	public function demo_user_show()
	{
		if (Request::$method === 'POST')
		{
			$api = Twitter::factory('user');

			if ($screen_name = Arr::get($_POST, 'screen_name'))
			{
				$params['screen_name'] = $screen_name;
			}
			elseif ($account_id = Arr::get($_POST, 'account_id'))
			{
				$params['account_id'] = $account_id;
			}
			else
			{
				$this->request->redirect($this->request->uri);
			}

			$response = $api->show($this->consumer, $this->token, $params);

			$this->content = Kohana::debug($response);
		}
		else
		{
			$this->content = View::factory('api/form')
				->set('message', 'Enter either an account ID or screen name.')
				->set('inputs', array(
					'Screen Name' => Form::input('screen_name'),
					'Account ID'  => Form::input('acount_id'),
				))
				;
		}
	}

} // End Twitter_Demo