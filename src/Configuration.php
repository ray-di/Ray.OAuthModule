<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/bsd-license.php MIT
 */
namespace Ray\OAuthModule;

class Configuration
{
    /**
     * @var string
     */
    public $serviceName;

    /**
     * @var string
     */
    public $consumerKey;

    /**
     * @var string
     */
    public $consumerSecret;

    /**
     * @var string
     */
    public $callbackUrlPath;

    /**
     * @var array
     */
    public $scopes = [];
} 
