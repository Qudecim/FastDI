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

\DI\ContainerBuilder::create($definitions);
\DI\DI::call(\Example\SomeClass::class, 'test');
