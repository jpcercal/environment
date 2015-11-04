<?php

namespace Cekurte\Environment;

use Cekurte\Environment\Resource\Resource;

class Environment
{
    /**
     * Constructor disabled
     */
    private function __construct()
    {

    }

    /**
     * Get value from environment
     *
     * @static
     * @param string $key
     *
     * @return mixed
     */
    public static function get($key)
    {
        return (new Resource(self::getEnvironmentVariable($key)))->process();
    }

    /**
     * Search the different places for environment variables and return first value found.
     *
     * @param string $name
     *
     * @return string
     */
    public static function getEnvironmentVariable($name)
    {
        switch (true) {
            case array_key_exists($name, $_ENV):
                return $_ENV[$name];
            case array_key_exists($name, $_SERVER):
                return $_SERVER[$name];
            default:
                $value = getenv($name);
                return $value === false ? null : $value; // switch getenv default to null
        }
    }
}
