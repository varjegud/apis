<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Twitter_Demo extends Controller_Demo {

	public function demo_account_verify_credentials()
	{
		$api = Twitter::factory('account');

		$response = $api->verify_credentials($this->consumer, $this->token);

		$this->content = Kohana::debug($response);
	}

} // End Twitter_Demo