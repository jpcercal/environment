<?php

namespace Cekurte\Environment;

use Cekurte\Environment\Resource\ArrayResource;
use Cekurte\Environment\Resource\BooleanResource;
use Cekurte\Environment\Resource\JsonResource;
use Cekurte\Environment\Resource\NullResource;
use Cekurte\Environment\Resource\NumericResource;
use Cekurte\Environment\Resource\UnknownResource;

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
        $env      = getenv($key);
        $envLower = strtolower($env);
        $resource = new UnknownResource($env);

        if (in_array($envLower, ['true', 'false'])) {
            $resource = new BooleanResource($env);
        } elseif ($envLower === 'null') {
            $resource = new NullResource($env);
        } elseif (is_numeric($env)) {
            $resource = new NumericResource($env);
        } elseif (is_string($env) && isset($env[0]) && $env[0] === '[') {
            $resource = new ArrayResource($env);
        } elseif (is_string($env) && isset($env[0]) && $env[0] === '{') {
            $resource = new JsonResource($env);
        }

        return $resource->process();
    }
}
