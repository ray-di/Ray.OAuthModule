<?php

namespace Ray\OAuthModule;

use OAuth\OAuth2\Service\Facebook;
use OAuth\OAuth2\Service\Google;
use Ray\Di\AbstractModule;

class FakeMultipleOAuthModule extends AbstractModule
{

    /**
     * Configure binding
     */
    protected function configure()
    {
        $this->install(new OAuth1Module(
            OAuth1Service::TWITTER,
            'twitter-key',
            'twitter-secret',
            '/callback/twitter',
            [],
            new FakeTokenStorage
        ));

        $this->install(new OAuth1Module(
            OAuth1Service::YAHOO,
            'yahoo-key',
            'yahoo-secret',
            '/callback/yahoo',
            [],
            new FakeTokenStorage
        ));

        $this->install(new OAuth2Module(
            OAuth2Service::FACEBOOK,
            'facebook-key',
            'facebook-secret',
            '/callback/facebook',
            [Facebook::SCOPE_READ_STREAM],
            [],
            new FakeTokenStorage
        ));

        $this->install(new OAuth2Module(
            OAuth2Service::GOOGLE,
            'google-key',
            'google-secret',
            '/callback/google',
            [Google::SCOPE_EMAIL],
            [],
            new FakeTokenStorage
        ));
    }
}
