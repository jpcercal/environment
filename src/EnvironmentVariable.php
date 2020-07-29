<?php

namespace Cekurte\Environment;

use Cekurte\Environment\Contract\FilterInterface;
use Cekurte\Environment\Exception\Exception;
use Cekurte\Environment\Exception\FilterException;
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
     * Get a merge of environment variables $_ENV and $_SERVER.
     *
     * @return array
     */
    protected function getEnvironmentVariables()
    {
        return array_merge($_ENV, $_SERVER, getenv());
    }

    /**
     * Given the $rawValue this method will convert it to a
     * value using the correct resource type.
     *
     * @param  mixed $rawValue
     * @param  mixed $defaultValue
     *
     * @return mixed
     */
    protected function getValue($rawValue, $defaultValue = null)
    {
        if ($rawValue === null) {
            return $defaultValue;
        }

        try {
            return (new Resource($rawValue))->process();
        } catch (Exception $e) {
            // ...
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

        return $this->getValue($rawValue, $defaultValue);
    }

    /**
     * Get all environment variables from $_ENV and $_SERVER.
     *
     * @param  array $filters an array of filters or an empty array
     *
     * @throws \Cekurte\Environment\Exception\FilterException
     *
     * @return array
     */
    public function getAll(array $filters = [])
    {
        $vars = $this->getEnvironmentVariables();

        foreach ($filters as $filter) {
            if (!$filter instanceof FilterInterface) {
                throw new FilterException(sprintf(
                    '%s %s %s',
                    'The $filters param must be an array',
                    'and your values must be an instance of',
                    '\Cekurte\Environment\Contract\FilterInterface'
                ));
            }

            $vars = $filter->filter($vars);
        }

        $callback = function ($rawValue) {
            return $this->getValue($rawValue);
        };

        return array_map($callback, $vars);
    }
}
