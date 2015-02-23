<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace Ray\OAuthModule\Inject;

use Maye\OAuthClient\OAuth1ClientInterface;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

trait TwitterOAuthClientInject
{
    /**
     * @var OAuth1ClientInterface
     */
    protected $twitterOAuthClient;

    /**
     * @param OAuth1ClientInterface $client
     *
     * @Inject
     * @Named("twitter")
     */
    public function setTwitterOAuthClientInject(OAuth1ClientInterface $client)
    {
        $this->twitterOAuthClient = $client;
    }
} 
