<?php

namespace Cekurte\Environment\Resource;

use Cekurte\Environment\Contract\ResourceInterface;
use Cekurte\Environment\Exception\ResourceException;
use Cekurte\Environment\Resource\AbstractResource;

class JsonResource extends AbstractResource implements ResourceInterface
{
    /**
     * {@inheritdoc}
     */
    public function process()
    {
        $resource = $this->getResource();

        if (!is_string($resource) ||
            !isset($resource[0])  ||
            $resource[0] !== '{'  ||
            substr($resource, strlen($resource) - 1) !== '}') {
            throw new ResourceException('The resource type is not a json value.');
        }

        $resource = json_decode($resource, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ResourceException(sprintf(
                'Error occurred while decoding the json string #%d',
                json_last_error()
            ));
        }

        return $resource;
    }
}
