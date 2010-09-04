<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Twitter_Demo extends Controller_Demo {

	public function demo_login()
	{
		// Attempt to complete signin
		if ($verifier = Arr::get($_REQUEST, 'oauth_verifier'))
		{
			if ( ! $token = $this->session->get('twitter_request') OR $token->token !== Arr::get($_REQUEST, 'oauth_token'))
			{
				// Token is invalid
				$this->session->delete('twitter_request');

				// Restart the login process
				$this->request->redirect($this->request->uri);
			}

			// Store the verifier in the token
			$token->verifier($verifier);

			// Exchange the request token for an access token
			$token = $this->provider->access_token($this->consumer, $token);

			// Store the access token
			$this->session->set('twitter_access', $token);

			// Request token is no longer needed
			$this->session->delete('twitter_request');

			// Refresh the page to prevent errors
			$this->request->redirect($this->request->uri);
		}

		if ($token = $this->session->get('twitter_access'))
		{
			// Login succesful
			$this->content = Kohana::debug('Access token granted:', $token);
		}
		else
		{
			// We will need a callback URL for the user to return to
			$callback = $this->request->url(NULL, TRUE);

			// Add the callback URL to the consumer
			$this->consumer->callback($callback);

			// Get a request token for the consumer
			$token = $this->provider->request_token($this->consumer);

			// Get the login URL from the provider
			$url = $this->provider->authorize_url($token);

			// Store the token
			$this->session->set('twitter_request', $token);

			// Redirect to the twitter login page
			$this->content = HTML::anchor($url, 'Login to Twitter');
		}
	}

	public function demo_logout()
	{
		if (Arr::get($_GET, 'confirm'))
		{
			// Delete the access token
			$this->session->delete('twitter_access');

			// Redirect to the demo list
			$this->request->redirect($this->request->uri(array('action' => FALSE, 'id' => FALSE)));
		}

		$this->content = HTML::anchor("{$this->request->uri}?confirm=yes", 'Logout of Twitter');
	}

} // End Twitter_Demo