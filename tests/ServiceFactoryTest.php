<?php

namespace Ray\OAuthModule;

use OAuth\OAuth1\Service\AbstractService as AbstractOAuth1Service;
use OAuth\OAuth2\Service\AbstractService as AbstractOAuth2Service;
use OAuth\OAuth1\Service\Twitter;
use OAuth\OAuth2\Service\Facebook;

class ServiceFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateOAuth1Service()
    {
        $client = (new ServiceFactory)->createService(
            Twitter::class,
            '{CONSUMER_KEY}',
            '{CONSUMER_SECRET}',
            '{OAUTH_CALLBACK_URL}'
        );

        $this->assertInstanceOf(AbstractOAuth1Service::class, $client);
        $this->assertInstanceOf(Twitter::class, $client);
    }

    public function testCreateOAuth2Service()
    {
        $client = (new ServiceFactory)->createService(
            Facebook::class,
            '{CONSUMER_KEY}',
            '{CONSUMER_SECRET}',
            '{OAUTH_CALLBACK_URL}',
            [Facebook::SCOPE_READ_STREAM]
        );

        $this->assertInstanceOf(AbstractOAuth2Service::class, $client);
        $this->assertInstanceOf(Facebook::class, $client);
    }

    public function testTrimNamespace()
    {
        $result = (new ServiceFactory)->trimNamespace(Twitter::class);
        $this->assertEquals('Twitter', $result);
    }

    public function testCreateCallbackURL()
    {
        $url = (new ServiceFactory)->createCallbackURL('/oauth/twitter/callback');
        $this->assertEquals('http://example.com/oauth/twitter/callback', $url);
    }
}
