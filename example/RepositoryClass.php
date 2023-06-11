<?php

namespace Example;

class RepositoryClass
{

    public function __construct(
        public DbClass $db
    )
    {

    }

    public function test()
    {
        $this->db->test();
    }

}