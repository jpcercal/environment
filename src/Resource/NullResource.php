<?php

namespace Cekurte\Environment\Resource;

use Cekurte\Environment\Resource\AbstractResource;
use Cekurte\Environment\Resource\ResourceInterface;

class NullResource extends AbstractResource implements ResourceInterface
{
    /**
     * {@inheritdoc}
     */
    public function process()
    {
        $resource = strtolower($this->getResource());

        if ($resource !== 'null') {
            throw new \RuntimeException('The resource type not is a null value');
        }

        return null;
    }
}
