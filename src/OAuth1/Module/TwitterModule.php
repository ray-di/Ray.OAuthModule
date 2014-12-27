<?php

namespace Ray\OAuthModule\OAuth1\Module;

use OAuth\OAuth1\Service\Twitter;
use Ray\OAuthModule\OAuth1\AbstractModule;

class TwitterModule extends AbstractModule
{
	protected $serviceClass = Twitter::class;
}
