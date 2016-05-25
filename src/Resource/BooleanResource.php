<?php

namespace Cekurte\Environment\Resource;

use Cekurte\Environment\Contract\ResourceInterface;
use Cekurte\Environment\Exception\ResourceException;
use Cekurte\Environment\Resource\AbstractResource;

class BooleanResource extends AbstractResource implements ResourceInterface
{
    /**
     * {@inheritdoc}
     */
    public function process()
    {
        $resource = filter_var(
            strtolower($this->getResource()),
            FILTER_VALIDATE_BOOLEAN,
            FILTER_NULL_ON_FAILURE
        );

        if (is_null($resource)) {
            throw new ResourceException('The resource type is not a boolean value.');
        }

        return $resource;
    }
}
