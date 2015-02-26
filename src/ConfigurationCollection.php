<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/bsd-license.php MIT
 */
namespace Ray\OAuthModule;

class ConfigurationCollection implements \ArrayAccess, \Iterator
{
    /**
     * @var Configuration[]
     */
    private $configs = [];

    /**
     * @param string $serviceName
     *
     * @return bool
     */
    public function offsetExists($serviceName)
    {
        return isset($this->configs[$serviceName]);
    }

    /**
     * @param string $serviceName
     *
     * @return Configuration
     */
    public function offsetGet($serviceName)
    {
        return $this->configs[$serviceName];
    }

    /**
     * @param string        $serviceName
     * @param Configuration $config
     */
    public function offsetSet($serviceName, $config)
    {
        $this->configs[$serviceName] = $config;
    }

    /**
     * @param string $serviceName
     */
    public function offsetUnset($serviceName)
    {
        unset($this->configs[$serviceName]);
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return current($this->configs);
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        next($this->configs);
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return key($this->configs);
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return $this->key() !== null;
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        reset($this->configs);
    }
}
