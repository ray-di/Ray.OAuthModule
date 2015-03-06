<?php
/**
 * OAuth1 Demo
 *
 * 1) Create and configure the App on Twitter Developer Site.
 *      https://apps.twitter.com/
 *
 *      [Settings > Application Details > Website]
 *          => http://127.0.0.1:8080/oauth1_twitter.php
 *
 *      [Settings > Application Details > Callback URL]
 *          => http://127.0.0.1:8080/oauth1_twitter.php
 *
 * 2) Set Consumer Key and Secret of your Twitter App.
 */
define('CONSUMER_KEY', 'xxxxxx');
define('CONSUMER_SECRET', 'yyyyyy');
/*
 * 3) Start the PHP built-in Web-Server.
 *
 *      $ php -S localhost:8080 -t docs/demo/www
 *
 * 4) Access 'http://localhost:8080/oauth1_twitter.php' in your browser.
 */

error_reporting(E_ALL ^ E_NOTICE);

require dirname(dirname(dirname(__DIR__))) . '/vendor/autoload.php';

use Ray\Di\AbstractModule;
use Ray\Di\Injector;
use Ray\OAuthModule\Inject\TwitterOAuthInject;
use Ray\OAuthModule\OAuth1Module;
use Ray\OAuthModule\OAuth1Service;

/**
 * AppModule
 */
class AppModule extends AbstractModule
{
    protected function configure()
    {
        $module = new OAuth1Module(
            OAuth1Service::TWITTER,
            CONSUMER_KEY,
            CONSUMER_SECRET,
            '/oauth1_twitter.php',
            ['force_login' => 'true']
        );

        $this->install($module);
    }
}

/**
 * OAuthController
 */
class OAuthController
{
    use TwitterOAuthInject;

    public function redirectAction()
    {
        // redirects to Twitter authorization page
        $this->twitterOAuth->authorize();
    }

    public function callbackAction($oauth_token, $oauth_verifier, $denied)
    {
        if ($denied) {
            // should be handled as error
            return 'ERROR';
        }

        // requests AccessToken
        $token = $this->twitterOAuth->requestAccessToken($oauth_token, $oauth_verifier);
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

// - * - * - * - * - * - * - * - * - * - * - * - * - * - * - * - * - * - * - * - * - * - * -
// - * - * - * - * - * - * - * - * - * - * - * - * - * - * - * - * - * - * - * - * - * - * -

/** @var OAuthController $controller */
$controller = (new Injector(new AppModule))->getInstance(OAuthController::class);

if (empty($_GET)) {
    $controller->redirectAction();

} else {
    $result = $controller->callbackAction($_GET['oauth_token'], $_GET['oauth_verifier'], $_GET['denied']);
    echo $result;
}
