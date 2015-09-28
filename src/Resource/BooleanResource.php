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
        $resource = strtolower($this->getResource());

        if (!in_array($resource, ['false', 'true'])) {
            throw new \RuntimeException('The resource type not is a boolean value');
        }

        return $resource === 'false' ? false : true;
    }
}
