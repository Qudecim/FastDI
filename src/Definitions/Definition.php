<?php

namespace DI\Definitions;

use DI\Proxy\ProxyInstance;

class Definition
{

    private ProxyInstance $instance;
    private string $class;
    private bool $isBuilt = false;

    public function __construct(string $class, \Closure $creator)
    {
        $this->instance = new ProxyInstance($class, $creator);
    }

    public function getInstance(): ProxyInstance
    {
        return $this->instance;
    }

    public function setParameters(array $parameters): void
    {
        $this->instance->setParameters($parameters);
    }

    public function setIsBuilt(bool $isBuilt): void
    {
        $this->isBuilt = $isBuilt;
    }

    public function getIsBuilt(): bool
    {
        return $this->isBuilt;
    }

}