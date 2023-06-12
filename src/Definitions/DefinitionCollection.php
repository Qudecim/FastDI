<?php

namespace DI\Definitions;

use Traversable;

class DefinitionCollection implements \IteratorAggregate, \Countable
{

    private array $definitions = [];

    public function add(string $id, Definition $definition): void
    {
        $this->definitions[$id] = $definition;
    }

    public function get(string $id): Definition
    {
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