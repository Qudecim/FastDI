<?php

namespace TestApp;

class DbClass
{

    public function __construct(
        private string $dbName
    )
    {
    }

    public function test()
    {
        return $this->dbName;
    }

}