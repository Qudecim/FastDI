<?php

namespace DI;

use DI\Definitions\DefinitionCollection;
use DI\Exceptions\DefinitionNotFoundException;
use Psr\Container\ContainerInterface;

readonly class Container implements ContainerInterface
{

    public function __construct(
        private DefinitionCollection $definitions
    )
    {
    }

    /**
     * @throws DefinitionNotFoundException
     */
    public function get(string $id): object
    {
        return $this->definitions->get($id)->getInstance();
    }

    public function has(string $id): bool
    {
        return $this->definitions->has($id);
    }

}