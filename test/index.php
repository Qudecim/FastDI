<?php

require './vendor/autoload.php';



$service  = new \Test\ServiceClass();
$some = new \Test\SomeClass($service);
$some->test();

$definitions = [];
$arrayDefinitions = new DI\Definitions\ArrayDefinitions($definitions);
$container = new \DI\Container($arrayDefinitions);

