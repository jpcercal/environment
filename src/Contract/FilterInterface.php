<?php

namespace Cekurte\Environment\Contract;

interface FilterInterface
{
    /**
     * Filter data to get only filtered data
     *
     * @param array $data
     *
     * @return array
     */
    public function filter($data);
}
