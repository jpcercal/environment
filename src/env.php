<?php

namespace Cekurte\Environment;

use Cekurte\Environment\Environment;

if (!function_exists('Cekurte\Environment\env')) {
    /**
     * Get value from environment.
     *
     * @param string $key
     * @param mixed  $defaultValue
     *
     * @return mixed
     *
     * @deprecated
     */
    function env($name, $default = null)
    {
        return Environment::get($name, $default);
    }
}
