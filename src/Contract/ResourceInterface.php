<?php

namespace Cekurte\Environment\Contract;

use Cekurte\Environment\Exception\ResourceException;

interface ResourceInterface
{
    /**
     * Set the resource
     *
     * @param mixed $resource
     *
     * @return ResourceInterface
     */
    public function setResource($resource);

    /**
     * Get the resource
     *
     * @return mixed
     */
    public function getResource();

    /**
     * @return mixed
     *
     * @throws ResourceException
     */
    public function process();
}
