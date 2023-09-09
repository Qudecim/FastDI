<?php

namespace DI;

use DI\Definitions\DefinitionCollection;

class DI
{

    private static $instance = null;

    private function __construct() {
    }

    protected function __clone() {
    }

    /**
     * @param DefinitionCollection $definitions
     * @return void
     */
    public static function make(DefinitionCollection $definitions) {
        self::$instance = new Container($definitions);
    }

    /**
     * @param string $id
     * @return object
     */
    public static function get(string $id): object {
        return self::$instance->get($id);
    }

    /**
     * @param string $id
     * @return bool
     */
    public static function has(string $id): bool {
        return self::$instance->has($id);
    }

    /**
     * @param string $class
     * @param string $callable
     * @return mixed
     */
    public static function call(string $class, string $callable): mixed {
        return self::$instance->call($class, $callable);
    }
}