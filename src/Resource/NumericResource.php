<?php

namespace Cekurte\Environment\Resource;

use Cekurte\Environment\Resource\AbstractResource;
use Cekurte\Environment\Resource\ResourceInterface;

class NumericResource extends AbstractResource implements ResourceInterface
{
    /**
     * {@inheritdoc}
     */
    public function process()
    {
        $resource = $this->getResource();

        if (!is_numeric($resource)) {
            throw new \RuntimeException('The resource type not is a numeric value');
        }

        return is_int($resource) ? (int) $resource : (float) $resource;
    }
}
