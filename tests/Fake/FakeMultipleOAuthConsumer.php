<?php

namespace Ray\OAuthModule;

use Ray\OAuthModule\Inject\FacebookOAuthInject;
use Ray\OAuthModule\Inject\GoogleOAuthInject;
use Ray\OAuthModule\Inject\TwitterOAuthInject;
use Ray\OAuthModule\Inject\YahooOAuthInject;

class FakeMultipleOAuthConsumer
{
    use TwitterOAuthInject;

    use YahooOAuthInject;

    use FacebookOAuthInject;

    use GoogleOAuthInject;

    public function getTwitterOAuth()
    {
        return $this->twitterOAuth;
    }

    public function getYahooOAuth()
    {
        return $this->yahooOAuth;
    }

    public function getFacebookOAuth()
    {
        return $this->facebookOAuth;
    }

    public function getGoogleOAuth()
    {
        return $this->googleOAuth;
    }
}
