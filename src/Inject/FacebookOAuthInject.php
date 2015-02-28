<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace Ray\OAuthModule\Inject;

use Maye\OAuthClient\OAuth2ClientInterface;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

trait FacebookOAuthInject
{
    /**
     * @var OAuth2ClientInterface
     */
    protected $facebookOAuth;

    /**
     * @param OAuth2ClientInterface $client
     *
     * @Inject
     * @Named("facebook")
     */
    public function setFacebookOAuthInject(OAuth2ClientInterface $client)
    {
        $this->facebookOAuth = $client;
    }
} 
