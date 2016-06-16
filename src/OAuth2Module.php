<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace Ray\OAuthModule;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Maye\OAuthClient\OAuth2ClientInterface;
use OAuth\Common\Storage\TokenStorageInterface;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;
use Ray\OAuthModule\Annotation\OAuth2Config;

class OAuth2Module extends AbstractModule
{
    /**
     * @var string
     */
    private $serviceName;

    /**
     * @param string                $serviceName     Service name
     * @param string                $consumerKey     Consumer key
     * @param string                $consumerSecret  Consumer secret
     * @param string                $callbackUrlPath Callback url path
     * @param array                 $scopes          Scopes
     * @param array                 $extraAuthParams Extra authorization params
     * @param TokenStorageInterface $storage         Token Storage
     */
    public function __construct(
        $serviceName,
        $consumerKey,
        $consumerSecret,
        $callbackUrlPath,
        array $scopes = [],
        array $extraAuthParams = [],
        TokenStorageInterface $storage = null
    ) {
        $this->serviceName = $serviceName;

        AnnotationRegistry::registerFile(__DIR__ . '/DoctrineAnnotations.php');
        $this->bind()->annotatedWith(OAuth2Config::class)->toInstance([$serviceName, $consumerKey, $consumerSecret, $callbackUrlPath, $scopes, $extraAuthParams, $storage]);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $named = strtolower($this->serviceName);

        $this->bind(OAuth2ClientInterface::class)->annotatedWith($named)->toProvider(OAuth2Provider::class)->in(Scope::SINGLETON);
    }
}
