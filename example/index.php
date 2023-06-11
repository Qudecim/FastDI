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

$container = \DI\ContainerBuilder::create($definitions);
$container->call(\Example\SomeClass::class, 'test', []);

