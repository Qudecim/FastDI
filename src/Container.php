<?php

namespace DI;

use DI\Definitions\Definition;
use DI\Definitions\DefinitionCollection;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{

    public function __construct(
        private DefinitionCollection $definitions
    )
    {
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function get(string $id): mixed
    {
        return $this->definitions[$id];
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return isset($this->definitions[$id]);
    }

    /**
     * @param string $id
     * @param $definition
     * @return void
     */
    public function set(string $id, $definition): void
    {
        $this->definitions->add($id, new Definition($id, $definition));
    }

    /**
     * @param string $class
     * @param string $callable
     * @param array $parameters
     * @return mixed
     * @throws \ReflectionException
     */
    public function call(string $class, string $callable, array $parameters = []): mixed
    {
        $obj = $this->build($class);
        if (method_exists($obj, $callable)) {
            return $obj->$callable(...$parameters);
        }

        return null;
    }

    /**
     * @param string $class
     * @return object
     * @throws \ReflectionException
     */
    private function build(string $class): object
    {
        $definition = $this->definitions->get($class);
        if ($definition->hasInstance()) {
            return $definition->getInstance();
        }

        $reflectionClass = new \ReflectionClass($class);
        $constructor = $reflectionClass->getConstructor();
        $dependencies = [];

        if ($constructor) {
            $parameters = $constructor->getParameters();
            foreach ($parameters as $parameter) {
                $dependency = $parameter->getType();
                 if ($dependency instanceof \ReflectionNamedType && !$dependency->isBuiltin()) {
                     $dependencies[] = $this->build($parameter->getType());
                 }
            }
        }

        $definition->setParameters($dependencies);
        return $definition->getInstance();
    }

}