<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace Ray\OAuthModule;

use Maye\OAuthClient\OAuth1ClientInterface;
use Ray\Di\Injector;

class OAuth1ModuleTest extends \PHPUnit_Framework_TestCase
{
    public function testOAuth1Module()
    {
        $module = new OAuth1Module(OAuth1Service::TWITTER, 'ConsumerKey', 'ConsumerSecret', 'CallbackUrlPath');
        $injector = (new Injector($module, $_ENV['TMP_DIR']));
        /** @var FakeOAuth1Consumer $consumer */
        $consumer = $injector->getInstance(FakeOAuth1Consumer::class);

        $this->assertInstanceOf(OAuth1ClientInterface::class, $consumer->getClient());
        $this->assertEquals(OAuth1Service::TWITTER, $consumer->getClient()->getServiceName());
    }
}
