<?php

namespace Cekurte\Environment\Resource;

use Cekurte\Environment\Contract\ResourceInterface;
use Cekurte\Environment\Exception\ResourceException;
use Cekurte\Environment\Resource\AbstractResource;

class NumericResource extends AbstractResource implements ResourceInterface
{
    /**
     * {@inheritdoc}
     */
    public function process()
    {
        $resource = $this->getResource();

        if (!is_numeric($resource)) {
            throw new ResourceException('The resource type is not a numeric value.');
        }

        return $resource + 0;
    }
}
