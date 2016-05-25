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

    /**
     * Get all environment variables from $_ENV and $_SERVER.
     *
     * @static
     *
     * @param  array $filters an array of filters or an empty array
     *
     * @throws \Cekurte\Environment\Exception\FilterException
     *
     * @return array
     */
    public static function getAll(array $filters = [])
    {
        return self::getInstance()->getAll($filters);
    }
}
