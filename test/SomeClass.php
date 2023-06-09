<?php

namespace Test;

class SomeClass
{

    public function __construct(
        private ServiceClass $service
    )
    {
    }

    public function test()
    {
        $this->service->test();
    }

}