<?php

namespace DI;

use DI\Definitions\Definition;
use DI\Definitions\DefinitionCollection;

class ContainerBuilder
{

    /**
     * Create new instance Container
     *
     * @param array $definitions
     * @return Container
     */
    public static function create(array $definitions): Container
    {
        $definitionCollection = new DefinitionCollection();

        foreach ($definitions as $definitionKey => $definitionValue) {
            if (is_string($definitionValue)) {
                $class = $definitionValue;
                $callable = null;
            } else {
                $class = $definitionKey;
                $callable = $definitionValue;
            }
            $definitionCollection->add($class, new Definition($class, $callable));
        }

        return new Container($definitionCollection);
    }

}