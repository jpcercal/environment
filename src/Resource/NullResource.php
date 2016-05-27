<?php

namespace Cekurte\Environment\Resource;

use Cekurte\Environment\Contract\ResourceInterface;
use Cekurte\Environment\Exception\ResourceException;
use Cekurte\Environment\Resource\AbstractResource;

class NullResource extends AbstractResource implements ResourceInterface
{
    /**
     * {@inheritdoc}
     */
    public function process()
    {
        $resource = strtolower($this->getResource());

        if ($resource !== 'null') {
            throw new ResourceException('The resource type is not a null value.');
        }

        return null;
    }
}
