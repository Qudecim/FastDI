<?php

namespace DI\Proxy;

class ProxyInstance
{

    public function __construct(
        private string $class,
        private \Closure $creator
    )
    {
    }

    public function setParameters(array $parameters)
    {

    }

}