<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace Ray\OAuthModule;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Maye\OAuthClient\OAuth1ClientInterface;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;
use Ray\OAuthModule\Annotation\OAuth1Config;

class OAuth1Module extends AbstractModule
{
    /**
     * @var string
     */
    private $serviceName;

    /**
     * @param string $serviceName     Service name
     * @param string $consumerKey     Consumer key
     * @param string $consumerSecret  Consumer secret
     * @param string $callbackUrlPath Callback url path
     * @param array  $extraAuthParams Extra authorization params
     */
    public function __construct($serviceName, $consumerKey, $consumerSecret, $callbackUrlPath, array $extraAuthParams = [])
    {
        $this->serviceName = $serviceName;

        AnnotationRegistry::registerFile(__DIR__ . '/DoctrineAnnotations.php');
        $this->bind()->annotatedWith(OAuth1Config::class)->toInstance([$serviceName, $consumerKey, $consumerSecret, $callbackUrlPath, $extraAuthParams]);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $named = strtolower($this->serviceName);

        $this->bind(OAuth1ClientInterface::class)->annotatedWith($named)->toProvider(OAuth1ClientProvider::class)->in(Scope::SINGLETON);
    }
}
