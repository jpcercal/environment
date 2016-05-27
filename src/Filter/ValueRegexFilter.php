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
        $regex = $this->regex;

        $callback = function ($value) use ($regex) {
            if (is_string($value)) {
                return preg_match($regex, $value);
            }
        };

        return array_filter($data, $callback);
    }
}
