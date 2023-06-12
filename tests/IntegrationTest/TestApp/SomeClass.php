<?php

namespace TestApp;

class SomeClass
{

    public function __construct(
        private ServiceClass $service
    )
    {
    }

    public function test()
    {
        return $this->service->test();
    }

}