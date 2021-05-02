<?php

namespace Frame\Affection;

use Psr\Container\ContainerInterface;

trait DependencyAware
{
    /**
     * @var ContainerInterface
     */
    private $dependency = null;

    /**
     * Set configured Dependency container for object
     *
     * @param ContainerInterface $dependency
     */
    public function setDependency(ContainerInterface $dependency): void
    {
        $this->dependency = $dependency;
    }

    /**
     * Get Dependency object by requested key
     * Alias for direct Container->get method
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getDependency(string $key)
    {
        return $this->dependency->get($key);
    }

    /**
     * Get container object
     *
     * @return ContainerInterface
     */
    public function getDependencyContainer(): ContainerInterface
    {
        return $this->dependency;
    }
}
