<?php

namespace Cekurte\Environment\Filter;

use Cekurte\Environment\Contract\FilterInterface;
use Cekurte\Environment\Filter\KeyRegexFilter;

class ValueRegexFilter extends KeyRegexFilter implements FilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function filter($data)
    {
        $callback = function ($value) {
            if (is_string($value)) {
                return preg_match($this->regex, $value);
            }
        };

        return array_filter(
            $data,
            $callback,
            ARRAY_FILTER_USE_BOTH
        );
    }
}
