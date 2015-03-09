<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace Ray\OAuthModule\Annotation;

use Ray\Di\Di\Qualifier;

/**
 * @Annotation
 * @Target("METHOD")
 * @Qualifier
 */
class OAuth2Config
{
    public $value;
}
