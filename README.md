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
		$this->install(new OAuth1Module(OAuth1Service::TWITTER, $_ENV['CONSUMER_KEY'], $_ENV['CONSUMER_SECRET'], '/oauth/callback'));
	}
}
```

### Usage

Redirects to the authorization page.

```php
use Ray\OAuthModule\Inject\TwitterOAuthInject;

class OAuthController
{
    use TwitterOAuthInject;

    public function redirectAction()
    {
        $this->twitterOAuth->authorize();
    }
}
```

Requests the AccessToken.
This is callback process after authorization finished.

```php
use Ray\OAuthModule\Inject\TwitterOAuthInject;

class OAuthController
{
    use TwitterOAuthInject;

    public function callbackAction()
    {
        if ($_GET['denied']) {
            // should be handled as error
            return 'ERROR';
        }

        // requests AccessToken
        $token = $this->twitterOAuth->requestAccessToken($_GET['oauth_token'], $_GET['oauth_verifier']);
        /** @var OAuth\OAuth1\Token\TokenInterface $token */

        // $accessToken       = $token->getAccessToken();
        // $accessTokenSecret = $token->getAccessTokenSecret();
        $userId     = $token->getExtraParams()['user_id'];
        $screenName = $token->getExtraParams()['screen_name'];

        // gets authorized user info
        $user = $this->twitterOAuth->api('get', 'users/show.json', ['user_id' => $userId]);
        $user = json_decode($user);

        $result = 'user_id : ' . $userId .'<br />';
        $result.= 'screen_name : @' . $screenName . '<br />';
        $result.= 'name: ' . $user->name;

        return $result;
    }
}
```

## Demo

#### OAuth1 (Twitter)

See ```docs/demo/www/oauth1_twitter.php``` for detail.

```php
# 1. Create and configure the Twitter App on Developer Website

# 2. Set Consumer Key and Secret in docs/demo/www/oauth1_twitter.php

# 3. Start the PHP built-in Web-Server
$ php -S localhost:8080 -t docs/demo/www

# 4. Access http://localhost:8080/oauth1_twitter.php
<< output >>
user_id: {Your User ID}
screen_name: @{your_screen_name}
name: {Your Name}
```

#### OAuth2 (Facebook)

See ```docs/demo/www/oauth2_facebook.php``` for detail.

```php
# 1. Create and configure the Facebook App on Developer Website

# 2. Set App ID and Secret in docs/demo/www/oauth2_facebook.php

# 3. Start the PHP built-in Web-Server
$ php -S localhost:8080 -t docs/demo/www

# 4. Access http://localhost:8080/oauth2_facebook.php
<< output >>
id: {Your ID}
name: {Your Name}
```

### Requirements

* PHP 5.5+
* hhvm
