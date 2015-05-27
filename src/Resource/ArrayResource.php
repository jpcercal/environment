<?php

namespace Cekurte\Environment\Resource;

use Cekurte\Environment\Contract\ResourceInterface;
use Cekurte\Environment\Exception\ResourceException;
use Cekurte\Environment\Resource\AbstractResource;
use Cekurte\Environment\Resource\Resource;

class ArrayResource extends AbstractResource implements ResourceInterface
{
    /**
     * Remove char at start or end position of a string.
     *
     * @param  string            $string
     * @param  string|null|array $charStart
     * @param  string|null|array $charEnd
     *
     * @return string
     */
    protected function removeChar($string, $charStart = null, $charEnd = null)
    {
        if (!is_null($charStart) && (is_string($charStart) || is_array($charStart))) {
            if (is_string($charStart)) {
                $charStart = [$charStart];
            }

            foreach ($charStart as $char) {
                if (substr($string, 0, 1) === $char) {
                    $string = substr($string, 1);
                }
            }
        }

        if (!is_null($charEnd) && (is_string($charEnd) || is_array($charEnd))) {
            if (is_string($charEnd)) {
                $charEnd = [$charEnd];
            }

            foreach ($charEnd as $char) {
                if (substr($string, -1) === $char) {
                    $string = substr($string, 0, -1);
                }
            }
        }

        return $string;
    }

    /**
     * Handle error and throw a new ResourceException.
     *
     * @param  int    $type
     * @param  string $message
     * @param  string $file
     * @param  int    $line
     *
     * @throws ResourceException
     */
    protected function handleError($type, $message, $file, $line)
    {
        throw new ResourceException(sprintf(
            '%s: "%s" in %s on line %d',
            $type,
            $message,
            $file,
            $line
        ));
    }

    /**
     * Checks if the current item is serialized.
     *
     * @param  string $item
     *
     * @return bool
     */
    protected function itemIsSerialized($item)
    {
        return strpos($item, 'a:') === 0 || strpos($item, 's:') === 0;
    }

    /**
     * Filter the items.
     *
     * @param  array $items
     *
     * @return array
     */
    protected function filterItems(array $items)
    {
        $data = [];

        foreach ($items as $item) {
            $item = trim($item);

            if (empty($item)) {
                continue;
            }

            $item = $this->removeChar($item, '[', ']');

            if ($this->itemIsSerialized($item)) {
                $data[] = unserialize($item);
                continue;
            }

            if (strpos($item, '=>') !== false) {
                $element = explode('=>', $item);
                $element[0] = trim($element[0]);
                $element[1] = trim($element[1]);

                $key = $this->removeChar($element[0], ['"', "'"], ['"', "'"]);
                $val = $this->removeChar($element[1], ['"', "'"], ['"', "'"]);

                $data[$key] = $val;
            } else {
                $data[] = $this->removeChar($item, ['"', "'"], ['"', "'"]);
            }
        }

        return $data;
    }

    /**
     * Parse a string that represents an array statement to create an array data.
     *
     * @param  string $data
     *
     * @return array
     */
    protected function parseArray($data)
    {
        $pattern = '/(\[[^\[\]]*\])/';

        set_error_handler([__CLASS__, 'handleError']);

        while (true) {
            if (!preg_match($pattern, $data, $matches) > 0) {
                break;
            }

            $stringMatches = trim($matches[0]);

            $items = explode(',', $stringMatches);

            $currentData = $this->filterItems($items);


            $data = str_replace($stringMatches, serialize($currentData), $data);
        }

        $result = unserialize($data);

        restore_error_handler();

        return $result;
    }

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
            throw new ResourceException('The resource type is not an array value.');
        }

        $data = $this->parseArray($resource);

        array_walk_recursive($data, function (&$item) {
            $item = (new Resource($item))->process();
        });

        return $data;
    }
}
