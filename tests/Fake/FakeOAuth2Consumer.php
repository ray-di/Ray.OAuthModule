<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace Ray\OAuthModule;

use Maye\OAuthClient\OAuth2ClientInterface;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

class FakeOAuth2Consumer
{
    /**
     * @var OAuth2ClientInterface
     */
    private $client;

    /**
     * @param OAuth2ClientInterface $client
     *
     * @Inject
     * @Named("facebook")
     */
    public function setClient(OAuth2ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return OAuth2ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }
} 
