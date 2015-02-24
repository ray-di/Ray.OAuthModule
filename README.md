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

**e.g. TwitterModule**

```php
use Ray\Di\AbstractModule;
use Ray\OAuthModule\Twitter\TwitterModule;

class AppModule extends AbstractModule
{
	protected function configure()
	{
		// Callback URL Path of your application
		$callbackUrlPath = '/oauth/twitter/callback';
		$this->install(new TwitterModule('{YOUR_CONSUMER_KEY}', '{YOUR_CONSUMER_SECRET}', $callbackUrlPath);
	}
}

```
### DI trait

**e.g. TwitterInject**

```php

use Ray\OAuthModule\Twitter\TwitterInject;

class AuthController extends AbstractController
{
    use TwitterInject;
    
    public function indexAction()
    {
        $requestToken = $this->twitterOAuthClient->requestRequestToken()->getRequestToken();
        $url = $this->twitterOAuthClient->getAuthorizationUri([
            'oauth_token' => $requestToken,
            'force_login' => 'true'
        ]);
        // redirect to Twitter authorize URL
        header('Location:' . $url);
        exit(0);
    }
}

```

### Requiuments

 * PHP 5.5+
 * hhvm
 
## Other Services?

If you need other [OAuth1](https://github.com/Lusitanian/PHPoAuthLib/tree/master/src/OAuth/OAuth1/Service)/[OAuth2](https://github.com/Lusitanian/PHPoAuthLib/tree/master/src/OAuth/OAuth2/Service) service module, for example "Tumblr" (OAuth1), 

1. Add TumblrModle class and TumblrInject trait.

1. Send a Pull Request.
