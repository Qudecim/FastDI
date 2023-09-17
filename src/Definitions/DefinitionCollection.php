<?php

namespace DI\Definitions;

use DI\Exceptions\DefinitionNotFoundException;
use Traversable;

class DefinitionCollection implements \IteratorAggregate, \Countable
{

    private array $definitions = [];

    public function add(string $id, Definition $definition): void
    {
        $this->definitions[$id] = $definition;
    }

    /**
     * @throws DefinitionNotFoundException
     */
    public function get(string $id): Definition
    {
        if (!$this->has($id)) {
            throw new DefinitionNotFoundException('Not found ' . $id);
        }
        return $this->definitions[$id];
    }

    public function has(string $id): bool
    {
        return isset($this->definitions[$id]);
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->definitions);
    }

    public function count(): int
    {
        return count($this->definitions);
    }
}