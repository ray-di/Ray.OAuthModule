<?php
/**
 * OAuth2 Demo
 *
 * 1) Create and configure the App on Facebook Developer Site.
 *      https://developers.facebook.com/
 *
 *      [My Apps > Settings > Website > Site URL]
 *          => http://localhost:8080/oauth2_facebook.php
 *
 * 2) Set App ID and Secret of your Facebook App.
 */
define('APP_ID', 'xxxxxx');
define('APP_SECRET', 'yyyyyy');
/*
 * 3) Start the PHP built-in Web-Server.
 *
 *      $ php -S localhost:8080 -t docs/demo/www
 *
 * 4) Access 'http://localhost:8080/oauth2_facebook.php' in your browser.
 */

error_reporting(E_ALL ^ E_NOTICE);

require dirname(dirname(dirname(__DIR__))) . '/vendor/autoload.php';

use OAuth\OAuth2\Service\Facebook;
use Ray\Di\AbstractModule;
use Ray\Di\Injector;
use Ray\OAuthModule\Inject\FacebookOAuthInject;
use Ray\OAuthModule\OAuth2Module;
use Ray\OAuthModule\OAuth2Service;

/**
 * AppModule
 */
class AppModule extends AbstractModule
{
    protected function configure()
    {
        $module = new OAuth2Module(
            OAuth2Service::FACEBOOK,
            APP_ID,
            APP_SECRET,
            '/oauth2_facebook.php',
            [Facebook::SCOPE_READ_STREAM, Facebook::SCOPE_PUBLISH_ACTIONS],
            ['auth_type' => 'reauthenticate']
        );

        $this->install($module);
    }
}

/**
 * OAuthController
 */
class OAuthController
{
    use FacebookOAuthInject;

    public function redirectAction()
    {
        // redirects to Facebook authorization page
        $this->facebookOAuth->authorize();
    }

    public function callbackAction($code)
    {
        if (!$code) {
            // should be handled as error
            return 'ERROR';
        }

        // requests AccessToken
        $token = $this->facebookOAuth->requestAccessToken($code);
        /** @var OAuth\OAuth2\Token\TokenInterface $token */

        // $accessToken = $token->getAccessToken();
        // $refreshToken = $token->getRefreshToken();

        // gets authorized user info
        $me = $this->facebookOAuth->api('get', '/me', ['fields' => 'id,name']);
        $me = json_decode($me);

        $result = 'id : ' . $me->id .'<br />';
        $result.= 'name : ' . $me->name;

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
    $result = $controller->callbackAction($_GET['code']);
    echo $result;
}
