ray/oauth-module
================

[![Build Status](https://travis-ci.org/ray-di/Ray.OAuthModule.svg?branch=master)](https://travis-ci.org/ray-di/Ray.OAuthModule)

[OAuth](https://github.com/Lusitanian/PHPoAuthLib) Module for [Ray.Di](https://github.com/ray-di/Ray.Di)

## Installation

### Composer install

```bash
$ composer require ray/oauth-module
```
 
### Module install

**OAuthServiceModule**

```php
use Ray\Di\AbstractModule;
use Ray\OAuthModule\OAuthServiceModule;

class AppModule extends AbstractModule
{
	protected function configure()
	{
		// Twitter OAuth Configuration
		$twConfig = new Configuration();
		$twConfig->serviceName     = Twitter::class;
		$twConfig->consumerKey     = $_ENV['TW_CONSUMER_KEY'];
		$twConfig->consumerSecret  = $_ENV['TW_CONSUMER_SECRET'];
		$twConfig->callbackUrlPath = '/oauth/callback/twitter';

		// Facebook OAuth Configuration
		$fbConfig = new Configuration();
		$fbConfig->serviceName     = Facebook::class;
		$fbConfig->consumerKey     = $_ENV['FB_CONSUMER_KEY'];
		$fbConfig->consumerSecret  = $_ENV['FB_CONSUMER_SECRET'];
		$fbConfig->callbackUrlPath = '/oauth/callback/twitter';

		$configs = new ConfigurationCollection();
		$configs[Twitter::class]  = $twConfig;
		$configs[Facebook::class] = $fbConfig;

		$this->install(new OAuthServiceModule($configs);
	}
}

```
### DI trait

**OAuthServiceInject**

```php

use OAuth\OAuth1\Service\Twitter;
use OAuth\OAuth2\Service\Facebook;
use Ray\OAuthModule\OAuthServiceInject;

class AuthController extends AbstractController
{
    use OAuthServiceInject;
    
	/**
	 * OAuth1 example
	 */
    public function twitterAction()
    {
		$twService = $this->getOAuthService(Twitter::class);

		$requestToken = $twService->requestRequestToken()->getRequestToken();
		$url = $twService->getAuthorizationUri([
			'oauth_token' => $requestToken,
			'force_login' => 'true'
		]);

		// redirect to Twitter authorize URL
		header('Location:' . $url);
		exit(0);
    }

	/**
	 * OAuth2 example
	 */
    public function facebookAction()
    {
		$fbService = $this->getOAuthService(Facebook::class);

		$url = $fbService->getAuthorizationUri();

		// redirect to Facebook authorize URL
		header('Location:' . $url);
		exit(0);
    }
}

```

### Requiuments

 * PHP 5.5+
 * hhvm
