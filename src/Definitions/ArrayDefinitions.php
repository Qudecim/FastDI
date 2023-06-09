<?php

namespace DI\Definitions;

class ArrayDefinitions implements DefinitionsInterface
{

    public function __construct(
        array $definitions
    )
    {

    }

    public function get(): array
    {
        return [];
    }

}