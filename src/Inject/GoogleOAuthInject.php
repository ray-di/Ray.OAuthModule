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

trait GoogleOAuthInject
{
    /**
     * @var OAuth2ClientInterface
     */
    protected $googleOAuth;

    /**
     * @param OAuth2ClientInterface $client
     *
     * @Inject
     * @Named("google")
     */
    public function setGoogleOAuthInject(OAuth2ClientInterface $client)
    {
        $this->googleOAuth = $client;
    }
}
