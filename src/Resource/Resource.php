<?php

namespace Cekurte\Environment\Resource;

use Cekurte\Environment\Resource\AbstractResource;
use Cekurte\Environment\Contract\ResourceInterface;

class Resource extends AbstractResource implements ResourceInterface
{
    /**
     * {@inheritdoc}
     */
    public function process()
    {
        $rawResource      = $this->getResource();
        $rawResourceLower = strtolower($rawResource);

        $resource = new UnknownResource($rawResource);

        if (in_array($rawResourceLower, ['false', 'true', 'yes', 'no', 'on', 'off'])) {
            $resource = new BooleanResource($rawResource);
        } elseif ($rawResourceLower === 'null') {
            $resource = new NullResource($rawResource);
        } elseif (is_numeric($rawResource)) {
            $resource = new NumericResource($rawResource);
        } elseif (is_string($rawResource) && isset($rawResource[0])) {
            if ($rawResource[0] === '[' && substr($rawResource, strlen($rawResource) - 1) === ']') {
                $resource = new ArrayResource($rawResource);
            } elseif ($rawResource[0] === '{' && substr($rawResource, strlen($rawResource) - 1) === '}') {
                $resource = new JsonResource($rawResource);
            }
        }

        return $resource->process();
    }
}
