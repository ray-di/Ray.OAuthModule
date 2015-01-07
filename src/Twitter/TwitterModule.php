<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/bsd-license.php MIT
 */
namespace Ray\OAuthModule\Twitter;

use OAuth\OAuth1\Service\Twitter;
use Ray\OAuthModule\AbstractModule;

class TwitterModule extends AbstractModule
{
    protected $serviceClass = Twitter::class;
}
