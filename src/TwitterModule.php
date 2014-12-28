<?php

namespace Ray\OAuthModule;

use OAuth\OAuth1\Service\Twitter;

class TwitterModule extends AbstractModule
{
    protected $serviceClass = Twitter::class;
}
