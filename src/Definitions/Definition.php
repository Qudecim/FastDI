<?php

namespace DI\Definitions;

class Definition
{

    private object $instance;
    private array $parameters;


    public function __construct(
        private string $class,
        private ?\Closure $creator
    )
    {
    }

    public function createInstance(): object
    {
        $this->instance = $this->factory();
        return $this->instance;
    }

    public function getInstance(): object
    {
        return $this->instance;
    }

    public function setInstance(object $instance): void
    {
        $this->instance = $instance;
    }

    public function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }

    public function hasInstance(): bool
    {
        return isset($this->instance);
    }

    private function factory(): object
    {
        if (is_null($this->creator)) {
            if (empty($this->parameters)) {
                return new $this->class();
            }
            return new $this->class(...$this->parameters);
        } else {
            return ($this->creator)();
        }
    }

}