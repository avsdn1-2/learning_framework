<?php


namespace Framework\Container;


use Pimple\Container;

trait ContainerTrait
{
    /** @var Container */
    private $container;

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    public function get($key)
    {
        if (!isset($this->container[$key])) {
            return null;
        }
        return $this->container[$key];
    }
}