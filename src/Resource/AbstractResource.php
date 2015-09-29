<?php

namespace Cekurte\Environment\Resource;

use Cekurte\Environment\Resource\ResourceInterface;

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
