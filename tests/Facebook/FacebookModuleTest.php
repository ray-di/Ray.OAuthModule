<?php

namespace Ray\OAuthModule\Facebook;

use OAuth\OAuth2\Service\Facebook;
use Ray\Di\Injector;

class FacebookModuleTest extends \PHPUnit_Framework_TestCase
{
    public function testFacebookModule()
    {
        $module = new FacebookModule(
            '{CONSUMER_KEY}', '{CONSUMER_SECRET}', '{OAUTH_CALLBACK_PATH}', [Facebook::SCOPE_READ_STREAM]);
        $instance = (new Injector($module, $_ENV['TMP_DIR']))->getInstance(Facebook::class);
        $this->assertInstanceOf(Facebook::class, $instance);
    }
}
