<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/bsd-license.php MIT
 */
namespace Ray\OAuthModule;

use OAuth\OAuth1\Service\Twitter;

class TwitterModule extends AbstractModule
{
    protected $serviceClass = Twitter::class;
}
