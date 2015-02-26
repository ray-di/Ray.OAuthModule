<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/bsd-license.php MIT
 */
namespace Ray\OAuthModule;

use OAuth\Common\Service\ServiceInterface;

class ServiceCollection implements \ArrayAccess, \Iterator
{
    /**
     * @var ServiceInterface[]
     */
    private $services = [];

    /**
     * @param string $serviceName
     *
     * @return bool
     */
    public function offsetExists($serviceName)
    {
        return isset($this->services[$serviceName]);
    }

    /**
     * @param string $serviceName
     *
     * @return ServiceInterface
     */
    public function offsetGet($serviceName)
    {
        return $this->services[$serviceName];
    }

    /**
     * @param string           $serviceName
     * @param ServiceInterface $service
     */
    public function offsetSet($serviceName, $service)
    {
        $this->services[$serviceName] = $service;
    }

    /**
     * @param string $serviceName
     */
    public function offsetUnset($serviceName)
    {
        unset($this->services[$serviceName]);
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return current($this->services);
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        next($this->services);
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return key($this->services);
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
        reset($this->services);
    }
}
