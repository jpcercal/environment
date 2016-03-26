<?php

namespace Cekurte\Environment\Resource;

use Cekurte\Environment\Resource\AbstractResource;
use Cekurte\Environment\Resource\ResourceInterface;

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
            throw new \RuntimeException('The resource type not is a boolean value');
        }

        return $resource;
    }
}
