<?php

namespace IntegrationTest;

use DI\ContainerBuilder;

class ContainerBuilderTest extends \PHPUnit\Framework\TestCase
{

    public function test_has()
    {
        $container = ContainerBuilder::create([
            "foo"
        ]);

        self::assertTrue($container->has('foo'));
    }

}