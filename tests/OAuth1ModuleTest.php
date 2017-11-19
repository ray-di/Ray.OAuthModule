<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace Ray\OAuthModule;

use Maye\OAuthClient\OAuth1ClientInterface;
use OAuth\Common\Storage\TokenStorageInterface;
use PHPUnit\Framework\TestCase;
use Ray\Di\Injector;

class OAuth1ModuleTest extends TestCase
{
    public function testOAuth1Module()
    {
        $module = new OAuth1Module(OAuth1Service::TWITTER, 'ConsumerKey', 'ConsumerSecret', 'CallbackUrlPath', [], new FakeTokenStorage);
        $injector = (new Injector($module, $_ENV['TMP_DIR']));
        /** @var FakeOAuth1Consumer $consumer */
        $consumer = $injector->getInstance(FakeOAuth1Consumer::class);

        $this->assertInstanceOf(OAuth1ClientInterface::class, $consumer->getClient());
        $this->assertEquals(OAuth1Service::TWITTER, $consumer->getClient()->getServiceName());

        $this->assertInstanceOf(FakeTokenStorage::class, $this->getStorage($consumer->getClient()));
    }

    public function testInjectMultipleOAuth1()
    {
        $consumer = (new Injector(new FakeMultipleOAuthModule, $_ENV['TMP_DIR']))->getInstance(FakeMultipleOAuthConsumer::class);
        /* @var $consumer FakeMultipleOAuthConsumer */

        $this->assertSame(OAuth1Service::TWITTER, $consumer->getTwitterOAuth()->getServiceName());
        $this->assertSame(OAuth1Service::YAHOO, $consumer->getYahooOAuth()->getServiceName());
    }

    /**
     * @param OAuth1ClientInterface $client
     *
     * @return TokenStorageInterface
     */
    private function getStorage(OAuth1ClientInterface $client)
    {
        $clazz = new \ReflectionClass($client);
        $prop = $clazz->getProperty('service');
        $prop->setAccessible(true);
        $service = $prop->getValue($client);

        return $service->getStorage();
    }
}
