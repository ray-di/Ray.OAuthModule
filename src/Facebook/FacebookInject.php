<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/bsd-license.php MIT
 */
namespace Ray\OAuthModule\Facebook;

use OAuth\OAuth2\Service\Facebook;
use Ray\Di\Di\Inject;

trait FacebookInject
{
    /**
     * @var Facebook
     */
    protected $facebookOAuthClient;

    /**
     * @param Facebook $facebook
     *
     * @Inject
     */
    public function setFacebookOAuthClient(Facebook $facebook)
    {
        $this->facebookOAuthClient = $facebook;
    }
}
