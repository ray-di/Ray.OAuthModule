<?php

namespace Ray\OAuthModule\Twitter;

use OAuth\OAuth1\Service\Twitter;
use Ray\Di\Injector;

class TwitterModuleTest extends \PHPUnit_Framework_TestCase
{
    public function testTwitterModule()
    {
        $module = new TwitterModule('{CONSUMER_KEY}', '{CONSUMER_SECRET}', '{OAUTH_CALLBACK_PATH}');
        $instance = (new Injector($module, $_ENV['TMP_DIR']))->getInstance(Twitter::class);
        $this->assertInstanceOf(Twitter::class, $instance);
    }
}
