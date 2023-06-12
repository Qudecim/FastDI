<?php

namespace TestApp;

class ServiceClass
{

    public function __construct(
        public RepositoryClass $repositoryClass
    )
    {}

    public function test()
    {
        return $this->repositoryClass->test();
    }

}