<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/bsd-license.php MIT
 */
namespace Ray\OAuthModule;

use Ray\Di\Di\Inject;
use Ray\Di\ProviderInterface;

class ServiceCollectionProvider implements ProviderInterface
{

    /**
     * @var ConfigurationCollection
     */
    private $configs;

    /**
     * @param ConfigurationCollection $configs
     *
     * @Inject
     */
    public function __construct(ConfigurationCollection $configs)
    {
        $this->configs = $configs;
    }

    /**
     * @return ServiceCollection
     */
    public function get()
    {
        $services = new ServiceCollection();

        foreach ($this->configs as $config) {
            /** @var Configuration $config */

            $client = (new ServiceFactory)->createService(
                $config->serviceName,
                $config->consumerKey,
                $config->consumerSecret,
                $config->callbackUrlPath,
                $config->scopes
            );

            $services[$config->serviceName] = $client;
        }

        return $services;
    }
}
