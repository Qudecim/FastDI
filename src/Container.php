<?php

namespace DI;

use DI\Definitions\ArrayDefinitions;
use DI\Definitions\Definition;
use DI\Proxy\ProxyInstance;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{

    private array $definitions;
    private array $instances = [];

    public function __construct(
        ArrayDefinitions $arrayDefinitions
    )
    {
        foreach ($arrayDefinitions->get() as $definitionKey => $definitionValue) {
            if (gettype($definitionValue) == 'string') {
                $class = $definitionValue;
                $callable = function () use ($class) {
                    return new $class();
                };
            } else {
                $class = $definitionKey;
                $callable = $definitionValue;
            }
            $this->definitions[$class] = new Definition($class, $callable);
        }
    }

    public function get(string $id): mixed
    {
        return $this->definitions[$id];
    }

    public function has(string $id): bool
    {
        return isset($this->definitions[$id]);
    }

    public function call($class, $callable, $parameters = []): mixed
    {
        $obj = $this->build($class);
        return $obj->$callable(...$parameters);
    }

    private function build(string $class): ProxyInstance
    {
        if ($this->definitions[$class]->getIsBuilt()) {
            return $this->definitions[$class];
        }
        $reflectionClass = new \ReflectionClass($class);
        $constructor = $reflectionClass->getConstructor();

        $parameters = $constructor->getParameters();

        $types = [];
        foreach ($parameters as $parameter) {
            if ($parameter->getType() != 'string') {
                $types[] = $this->build($parameter->getType());
            }
        }
        $this->definitions[$class]->setParameters($types);
        $this->definitions[$class]->setIsBuilt();
        return $this->definitions[$class]->getInstance();


    }

}