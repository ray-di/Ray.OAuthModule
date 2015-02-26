<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/bsd-license.php MIT
 */
namespace Ray\OAuthModule;

use OAuth\OAuth1\Service\Twitter;
use OAuth\OAuth2\Service\Facebook;
use Ray\Di\Injector;

class OAuthServiceModuleTest extends \PHPUnit_Framework_TestCase
{
    public function testOAuthServiceModule()
    {
        // Twitter OAuth Configuration
        $twConfig = new Configuration();
        $twConfig->serviceName = Twitter::class;
        $twConfig->consumerKey = '{CONSUMER_KEY}';
        $twConfig->consumerSecret = '{CONSUMER_SECRET}';
        $twConfig->callbackUrlPath = '{CALLBACK_URL_PATH}';

        // Facebook OAuth Configuration
        $fbConfig = new Configuration();
        $fbConfig->serviceName = Facebook::class;
        $fbConfig->consumerKey = '{CONSUMER_KEY}';
        $fbConfig->consumerSecret = '{CONSUMER_SECRET}';
        $fbConfig->callbackUrlPath = '{CALLBACK_URL_PATH}';

        $configs = new ConfigurationCollection();
        $configs[Twitter::class] = $twConfig;
        $configs[Facebook::class] = $fbConfig;

        $module = new OAuthServiceModule($configs);
        $instance = (new Injector($module, $_ENV['TMP_DIR']))->getInstance(ServiceCollection::class);

        $this->assertInstanceOf(ServiceCollection::class, $instance);
        $this->assertCount(2, $instance);
        $this->assertInstanceOf(Twitter::class, $instance[Twitter::class]);
        $this->assertInstanceOf(Facebook::class, $instance[Facebook::class]);
    }
}
