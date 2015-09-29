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
        return (new Resource(getenv($key)))->process();
    }
}
