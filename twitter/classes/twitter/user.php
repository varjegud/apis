<?php defined('SYSPATH') or die('No direct script access.');

class Twitter_User extends Twitter {

	public function show(OAuth_Consumer $consumer, OAuth_Token $token = NULL, array $params = NULL)
	{
		if ( ! isset($params['user_id']) AND ! isset($params['screen_name']))
		{
			throw new Kohana_OAuth_Exception('Required parameter not passed: user_id or screen_name must be provided');
		}

		// Create a new GET request with the required parameters
		$request = OAuth_Request::factory('resource', 'GET', $this->url('users/show'), array(
				'oauth_consumer_key' => $consumer->key,
			))
			->required('oauth_token', FALSE);

		if ($token)
		{
			// Include the access token
			$params['oauth_token'] = $token->token;
		}

		// Load user parameters
		$request->params($params);

		// Sign the request using only the consumer, no token is available yet
		$request->sign($this->signature, $consumer);

		// Create a response from the request
		$response = $request->execute();

		return $this->parse($response);
	}

} // End Twitter_User