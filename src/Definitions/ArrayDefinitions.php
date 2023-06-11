<?php

namespace DI\Definitions;

class ArrayDefinitions implements DefinitionsInterface
{

    public function __construct(
        private array $definitions
    )
    {

    }

    public function get(): array
    {
        return $this->definitions;
    }

}