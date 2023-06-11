<?php

require './../vendor/autoload.php';

//$db = new \Test\DbClass('test');
//$repo = new \Test\RepositoryClass($db);
//$service  = new \Test\ServiceClass($repo);
//$some = new \Test\SomeClass($service);
//$some->test();

$definitions = [
    \Test\SomeClass::class,
    \Test\ServiceClass::class,
    \Test\RepositoryClass::class,
    \Test\DbClass::class => function () {
        return new \Test\DbClass('test');
    }
];
$arrayDefinitions = new DI\Definitions\ArrayDefinitions($definitions);
$container = new \DI\Container($arrayDefinitions);
$container->call(\Test\SomeClass::class, 'test', []);

