<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace Ray\OAuthModule;

use Maye\OAuthClient\OAuth1ClientInterface;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

class FakeOAuth1Consumer
{
    /**
     * @var OAuth1ClientInterface
     */
    private $client;

    /**
     * @param OAuth1ClientInterface $client
     *
     * @Inject
     * @Named("Twitter")
     */
    public function setClient(OAuth1ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return OAuth1ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }
} 
