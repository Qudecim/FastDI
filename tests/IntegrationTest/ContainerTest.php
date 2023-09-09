<?php

namespace IntegrationTest;

class ContainerTest extends \PHPUnit\Framework\TestCase
{

     public function test_work()
     {
         $value = 'test_ok';

         $definitions = [
             \TestApp\SomeClass::class,
             \TestApp\ServiceClass::class,
             \TestApp\RepositoryClass::class,
             \TestApp\DbClass::class => function () use ($value) {
                 return new \TestApp\DbClass($value);
             }
         ];

         \DI\ContainerBuilder::create($definitions);
         $result = \DI\DI::call(\TestApp\SomeClass::class, 'test');

         self::assertEquals($value, $result);
     }

}