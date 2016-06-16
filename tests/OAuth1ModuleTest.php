<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace Ray\OAuthModule;

use Maye\OAuthClient\OAuth1ClientInterface;
use OAuth\Common\Storage\TokenStorageInterface;
use Ray\Di\Injector;

class OAuth1ModuleTest extends \PHPUnit_Framework_TestCase
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
