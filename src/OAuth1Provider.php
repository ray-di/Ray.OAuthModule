<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace Ray\OAuthModule;

use Maye\OAuthClient\OAuth1Client;
use Maye\OAuthClient\OAuth1ClientInterface;
use Ray\Di\ProviderInterface;
use Ray\OAuthModule\Annotation\OAuth1Config;

class OAuth1Provider implements ProviderInterface
{
    /**
     * @var array
     */
    private $config;

    /**
     * @param array $config OAuth1 Config
     *
     * @OAuth1Config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     *
     * @return OAuth1ClientInterface
     */
    public function get()
    {
        list($serviceName, $consumerKey, $consumerSecret, $callbackUrlPath, $extraAuthParams) = $this->config;

        return new OAuth1Client($serviceName, $consumerKey, $consumerSecret,$callbackUrlPath, $extraAuthParams);
    }
}
