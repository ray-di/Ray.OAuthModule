<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace Ray\OAuthModule;

use Maye\OAuthClient\OAuth2Client;
use Maye\OAuthClient\OAuth2ClientInterface;
use Ray\Di\ProviderInterface;
use Ray\OAuthModule\Annotation\OAuth2Config;

class OAuth2Provider implements ProviderInterface
{
    /**
     * @var array
     */
    private $config;

    /**
     * @param array $config OAuth2 Config
     *
     * @OAuth2Config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     *
     * @return OAuth2ClientInterface
     */
    public function get()
    {
        list($serviceName, $consumerKey, $consumerSecret, $callbackUrlPath, $scopes, $extraAuthParams) = $this->config;

        return new OAuth2Client($serviceName, $consumerKey, $consumerSecret,$callbackUrlPath, $scopes, $extraAuthParams);
    }
}
