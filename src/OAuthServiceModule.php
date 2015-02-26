<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/bsd-license.php MIT
 */
namespace Ray\OAuthModule;

use Ray\Di\AbstractModule;
use Ray\Di\Scope;

class OAuthServiceModule extends AbstractModule
{
    /**
     * @var ConfigurationCollection
     */
    private $configs;

    /**
     * @param ConfigurationCollection $configs
     */
    public function __construct(ConfigurationCollection $configs)
    {
        $this->configs = $configs;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bind(ConfigurationCollection::class)->toInstance($this->configs)->in(Scope::SINGLETON);
        $this->bind(ServiceCollection::class)->toProvider(ServiceCollectionProvider::class)->in(Scope::SINGLETON);
    }
}
