<?php

namespace Cekurte\Environment\Resource;

use Cekurte\Environment\Resource\AbstractResource;
use Cekurte\Environment\Resource\ResourceInterface;

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
            throw new \RuntimeException('The resource type not is a json value');
        }

        $resource = json_decode($resource, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException(sprintf(
                'Error occurred while decoding the json string #%d "%s"',
                json_last_error(),
                json_last_error_msg()
            ));
        }

        return $resource;
    }
}
