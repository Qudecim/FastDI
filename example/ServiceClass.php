<?php

namespace Example;

class ServiceClass
{

    public function __construct(
        public RepositoryClass $repositoryClass
    )
    {}

    public function test()
    {
        $this->repositoryClass->test();
    }

}