<?php

require './../vendor/autoload.php';

$definitions = [
    \Example\SomeClass::class,
    \Example\ServiceClass::class,
    \Example\RepositoryClass::class,
    \Example\DbClass::class => function () {
        return new \Example\DbClass('test');
    }
];

$containerBuilder = new \DI\ContainerBuilder($definitions);
$container = $containerBuilder->make();
$object = $container->get(\Example\SomeClass::class);
$object->test();

