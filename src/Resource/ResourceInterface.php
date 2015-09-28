<?php

namespace Cekurte\Environment\Resource;

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
     */
    public function process();
}
