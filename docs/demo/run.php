<?php

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use Maye\OAuthClient\OAuth1ClientInterface;
use Ray\Di\Injector;
use Ray\OAuthModule\Inject\TwitterOAuthInject;
use Ray\OAuthModule\OAuth1Module;
use Ray\OAuthModule\OAuth1Service;

class Fake
{
    use TwitterOAuthInject;

    public function getTwitterOAuth()
    {
        return $this->twitterOAuth;
    }
}

/*
 * (Emulates $_SERVER and $_ENV variables for CLI)
 */
$_SERVER['REQUEST_URI'] = 'http://127.0.0.1:8080/';
$_ENV['CONSUMER_KEY'] = 'Consumer Key of your twitter app';
$_ENV['CONSUMER_SECRET'] = 'Consumer Secret of your twitter app';

$module = new OAuth1Module(OAuth1Service::TWITTER, $_ENV['CONSUMER_KEY'], $_ENV['CONSUMER_SECRET'], '/callback/twitter');
/** @var Fake $fake */
$fake = (new Injector($module))->getInstance(Fake::class);
$works = ($fake->getTwitterOAuth() instanceof OAuth1ClientInterface);

echo($works ? 'It works!' : 'It DOES NOT work!') . PHP_EOL;
