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
     * @throws \ReflectionException
     */
    public function get(string $id): object
    {
        $definition = $this->definitions->get($id);
        if ($definition->hasInstance()) {
            return $definition->getInstance();
        }

        $reflectionClass = new \ReflectionClass($id);
        $constructor = $reflectionClass->getConstructor();
        $dependencies = [];

        if ($constructor) {
            $parameters = $constructor->getParameters();
            foreach ($parameters as $parameter) {
                $dependency = $parameter->getType();
                if ($dependency instanceof \ReflectionNamedType && !$dependency->isBuiltin()) {
                    $dependencies[] = $this->get($parameter->getType());
                }
            }
        }

        $definition->setParameters($dependencies);
        return $definition->createInstance();
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return $this->definitions->has($id);
    }

    /**
     * @param string $class
     * @param string $callable
     * @return mixed
     * @throws \ReflectionException
     */
    public function call(string $class, string $callable): mixed
    {
        $obj = $this->get($class);
        $parameters = $this->getCallableParameters($class, $callable);
        if (method_exists($obj, $callable)) {
            return $obj->$callable(...$parameters);
        }

        return null;
    }

    /**
     * @param string $class
     * @param string $callable
     * @return array
     * @throws \ReflectionException
     */
    private function getCallableParameters(string $class, string $callable): array
    {
        $parameters = [];
        $reflection = new \ReflectionMethod($class, $callable);
        foreach($reflection->getParameters() as $arg) {
            $parameters[] = $this->get($arg->getType());
        }

        return $parameters;
    }

}