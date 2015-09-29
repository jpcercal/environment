<?php

namespace Cekurte\Environment\Resource;

use Cekurte\Environment\Resource\AbstractResource;
use Cekurte\Environment\Resource\Resource;
use Cekurte\Environment\Resource\ResourceInterface;

class ArrayResource extends AbstractResource implements ResourceInterface
{
    /**
     * {@inheritdoc}
     */
    public function process()
    {
        $resource = $this->getResource();

        if (!is_string($resource) ||
            !isset($resource[0])  ||
            $resource[0] !== '['  ||
            substr($resource, strlen($resource) - 1) !== ']') {
            throw new \RuntimeException('The resource type not is a array value');
        }

        $data = @eval(sprintf('return %s;', $this->getResource()));

        $lastError = error_get_last();

        if (!empty($lastError)) {
            throw new \UnexpectedValueException(sprintf(
                '%s: %s in %s on line %d',
                $lastError['type'],
                $lastError['message'],
                $lastError['file'],
                $lastError['line']
            ));
        }

        array_walk_recursive($data, function (&$item) {
            $item = (new Resource($item))->process();
        });

        return $data;
    }
}
