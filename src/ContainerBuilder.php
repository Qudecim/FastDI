<?php

namespace DI;

use DI\Definitions\Definition;
use DI\Definitions\DefinitionCollection;
use DI\Exceptions\DefinitionNotFoundException;

class ContainerBuilder
{

    private DefinitionCollection $definitions;

    public function __construct(array $definitions)
    {
        $this->definitions = new DefinitionCollection();

        foreach ($definitions as $definitionKey => $definitionValue) {

            if (is_string($definitionValue)) {
                $class = $definitionValue;
                $callable = null;
            } else {
                $class = $definitionKey;
                $callable = $definitionValue;
            }

            $this->definitions->add($class, new Definition($class, $callable));
        }
    }

    /**
     * @throws \ReflectionException
     * @throws DefinitionNotFoundException
     */
    public function make(): Container
    {
        foreach ($this->definitions as $definition) {
            $this->buildDefinition($definition->getType());
        }

        return new Container($this->definitions);
    }

    /**
     * @throws \ReflectionException
     * @throws DefinitionNotFoundException
     */
    private function buildDefinition(string $class): object
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
                    $dependencies[] = $this->buildDefinition($parameter->getType());
                }
            }
        }

        $definition->setParameters($dependencies);

        return $definition->createInstance();
    }

}