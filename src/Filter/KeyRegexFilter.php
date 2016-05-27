<?php

namespace Cekurte\Environment\Filter;

use Cekurte\Environment\Contract\FilterInterface;
use Cekurte\Environment\Exception\FilterException;

class KeyRegexFilter implements FilterInterface
{
    /**
     * @var string
     */
    protected $regex;

    /**
     * @param  string $regex
     *
     * @throws FilterException
     */
    public function __construct($regex)
    {
        set_error_handler(function ($type, $message, $file, $line) {
            throw new FilterException(sprintf(
                '%s: "%s" in %s on line %d',
                $type,
                $message,
                $file,
                $line
            ));
        });

        preg_match($regex, null);

        restore_error_handler();

        $this->regex = $regex;
    }

    /**
     * {@inheritdoc}
     */
    public function filter($data)
    {
        $regex = $this->regex;

        $callback = function ($item, $key) use ($regex, &$data) {
            if (!preg_match($regex, $key)) {
                unset($data[$key]);
            }
        };

        array_walk($data, $callback);

        return $data;
    }
}
