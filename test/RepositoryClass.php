<?php

namespace Test;

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