<?php

namespace TestApp;

class RepositoryClass
{

    public function __construct(
        public DbClass $db
    )
    {

    }

    public function test()
    {
        return $this->db->test();
    }

}