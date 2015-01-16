<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/bsd-license.php MIT
 */
namespace Ray\OAuthModule;

use OAuth\Common\Service\ServiceInterface;
use Ray\Di\Di\Inject;

trait OAuthServiceInject
{
    /**
     * @var ServiceCollection
     */
    private $oAuthServiceCollection;

    /**
     * @param ServiceCollection $services
     *
     * @Inject
     */
    public function setOAuthServiceCollection(ServiceCollection $services)
    {
        $this->oAuthServiceCollection = $services;
    }

    /**
     * @param string $serviceName
     *
     * @return ServiceInterface
     */
    public function getOAuthService($serviceName)
    {
        return $this->oAuthServiceCollection[$serviceName];
    }
} 
