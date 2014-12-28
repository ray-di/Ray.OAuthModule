<?php

namespace Ray\OAuthModule\OAuth1\Inject;

use OAuth\OAuth1\Service\Twitter;
use Ray\Di\Di\Inject;

trait TwitterInject
{
    /**
     * @var Twitter
     */
    protected $twitterOAuthClient;

    /**
     * @param Twitter $twitter
     *
     * @Inject
     */
    public function setTwitterOAuthClient(Twitter $twitter)
    {
        $this->twitterOAuthClient = $twitter;
    }
}
