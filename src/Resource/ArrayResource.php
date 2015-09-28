<?php

namespace Cekurte\Environment\Resource;

use Cekurte\Environment\Resource\AbstractResource;
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

        $data = explode(',', trim(substr($resource, 1, -1)));

        $haystack = ['"', "'"];

        return array_map(function ($item) use ($haystack) {
            if (isset($item[0]) && in_array($item[0], $haystack)) {
                $item = substr($item, 1);
            }

            if (in_array(substr($item, strlen($item) - 1), $haystack)) {
                $item = substr($item, 0, -1);
            }
        }, $data);
    }
}
