<?php

namespace DI;

use DI\Definitions\ArrayDefinitions;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{

    public function __construct(
        ArrayDefinitions $arrayDefinitions
    )
    {
    }

    public function get(string $id): mixed
    {
        return [];
    }

    public function has(string $id): bool
    {
        return true;
    }

    public function call($callable, $parameters = [])
    {

    }

}