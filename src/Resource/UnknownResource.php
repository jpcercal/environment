<?php

namespace Cekurte\Environment\Resource;

use Cekurte\Environment\Resource\AbstractResource;
use Cekurte\Environment\Contract\ResourceInterface;

class UnknownResource extends AbstractResource implements ResourceInterface
{
    /**
     * {@inheritdoc}
     */
    public function process()
    {
        return $this->getResource();
    }
}
