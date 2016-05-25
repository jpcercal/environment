<?php

namespace Cekurte\Environment\Resource;

use Cekurte\Environment\Contract\ResourceInterface;
use Cekurte\Environment\Exception\ResourceException;

abstract class AbstractResource implements ResourceInterface
{
    /**
     * @var mixed
     */
    protected $resource;

    /**
     * Initialize
     */
    public function __construct($resource)
    {
        $this->setResource($resource);
    }

    /**
     * {@inheritdoc}
     */
    public function setResource($resource)
    {
        if (!is_string($resource)) {
            throw new ResourceException('The resource value must be a string.');
        }

        $this->resource = trim($resource);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getResource()
    {
        return $this->resource;
    }
}
