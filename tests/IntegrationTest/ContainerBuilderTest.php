<?php

namespace IntegrationTest;

use DI\ContainerBuilder;

class ContainerBuilderTest extends \PHPUnit\Framework\TestCase
{

    public function test_has()
    {
        \DI\ContainerBuilder::create(["foo"]);

        self::assertTrue(\DI\DI::has("foo"));
    }

}