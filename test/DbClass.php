<?php

namespace Test;

class DbClass
{

    public function __construct(
        private string $dbName
    )
    {
    }

    public function test()
    {
        echo $this->dbName . PHP_EOL;
    }

}