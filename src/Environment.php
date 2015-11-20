<?php

namespace Cekurte\Environment;

use Cekurte\Environment\EnvironmentVariable;

class Environment
{
    /**
     * @var EnvironmentVariable|null
     */
    private static $instance;

    /**
     * @return EnvironmentVariable
     */
    private static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new EnvironmentVariable();
        }

        return self::$instance;
    }

    /**
     * Get value from environment.
     *
     * @static
     *
     * @param string $key
     * @param mixed  $defaultValue
     *
     * @return mixed
     */
    public static function get($name, $defaultValue = null)
    {
        return self::getInstance()->get($name, $defaultValue);
    }
}
