Ray.OAuthModule
================

[![Build Status](https://travis-ci.org/Ray-Di/Ray.OAuthModule.svg?branch=master)](https://travis-ci.org/Ray-Di/Ray.OAuthModule)

[OAuth](https://github.com/kawanamiyuu/Maye.OAuthClient) Module for [Ray.Di](https://github.com/koriym/Ray.Di)

## Installation

### Composer install

```bash
$ composer require ray/oauth-module
```
 
### Module install

```php
use Ray\Di\AbstractModule;
use Ray\OAuthModule\OAuth1Module;
use Ray\OAuthModule\OAuth1Service;

class AppModule extends AbstractModule
{
	protected function configure()
	{
		$this->install(new OAuth1Module(OAuth1Service::TWITTER, $_ENV['CONSUMER_KEY'], $_ENV['CONSUMER_SECRET'], '/callback/twitter'));
	}
}
```

### Usage

Redirects to the authorization page.

```php
use Ray\OAuthModule\Inject\TwitterOAuthInject;

class RedirectController
{
	use TwitterOAuthInject;
    
	public function twitterAction()
	{
		// redirects to Twitter authorization page
		$this->twitterOAuth->authorize();
		exit;
	}
}
```

Requests the AccessToken.
(callback process after authorization finished)

```php
use Ray\OAuthModule\Inject\TwitterOAuthInject;

class CallbackController
{
	use TwitterOAuthInject;

	public function twitterAction()
	{
		$oauthToken    = $_GET['oauth_token'];
		$oauthVerifier = $_GET['oauth_verifier'];
		$denied = $_GET['denied'];

		if ($denied) {
			// should be handled as error
			return;
		}

		// requests AccessToken
		$token = $this->twitterOAuth->requestAccessToken($oauthToken, $oauthVerifier);
		/** @var OAuth\OAuth1\Token\TokenInterface $token */

		// $accessToken       = $token->getAccessToken();
		// $accessTokenSecret = $token->getAccessTokenSecret();
		$userId = $token->getExtraParams()['user_id'];
		// $screenName = $token->getExtraParams()['screen_name'];

		// gets the authorized user info
		$result = $this->twitterOAuth->api('get', 'users/show.json', ['user_id' => $userId]);
		$result = json_decode($result);

		$name = $result->name;
	}
}
```

## Demo

```php
$ php docs/demo/run.php
// It works!
```

### Requirements

* PHP 5.5+
* hhvm
