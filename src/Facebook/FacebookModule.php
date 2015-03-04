<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/bsd-license.php MIT
 */
namespace Ray\OAuthModule\Facebook;

use OAuth\OAuth2\Service\Facebook;
use Ray\OAuthModule\AbstractModule;

class FacebookModule extends AbstractModule
{
    protected $serviceClass = Facebook::class;
}
