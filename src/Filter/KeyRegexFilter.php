<?php

namespace Cekurte\Environment\Filter;

use Cekurte\Environment\Contract\FilterInterface;

class KeyRegexFilter implements FilterInterface
{
    /**
     * @var string
     */
    protected $regex;

    /**
     * @param string $regex
     */
    public function __construct($regex)
    {
        $this->regex = $regex;
    }

    /**
     * {@inheritdoc}
     */
    public function filter($data)
    {
        $callback = function ($key) {
            return preg_match($this->regex, $key);
        };

        return array_filter(
            $data,
            $callback,
            ARRAY_FILTER_USE_KEY
        );
    }
}
