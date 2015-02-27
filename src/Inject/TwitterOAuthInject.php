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

trait TwitterOAuthInject
{
    /**
     * @var OAuth1ClientInterface
     */
    protected $twitterOAuth;

    /**
     * @param OAuth1ClientInterface $client
     *
     * @Inject
     * @Named("twitter")
     */
    public function setTwitterOAuthInject(OAuth1ClientInterface $client)
    {
        $this->twitterOAuth = $client;
    }
} 
