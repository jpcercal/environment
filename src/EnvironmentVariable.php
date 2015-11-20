<?php

namespace Cekurte\Environment;

use Cekurte\Environment\Resource\Resource;

class EnvironmentVariable
{
    /**
     * Search the different places for environment variables and return first value found.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getEnvironmentVariable($name)
    {
        switch (true) {
            case array_key_exists($name, $_ENV):
                return $_ENV[$name];
            case array_key_exists($name, $_SERVER):
                return $_SERVER[$name];
            default:
                $value = getenv($name);
                return $value === false ? null : $value;
        }
    }

    /**
     * Get value from environment.
     *
     * @param string $key
     * @param mixed  $defaultValue
     *
     * @return mixed
     */
    public function get($key, $defaultValue = null)
    {
        $rawValue = $this->getEnvironmentVariable($key);

        if ($rawValue === null) {
            return $defaultValue;
        }

        return (new Resource($rawValue))->process();
    }
}
