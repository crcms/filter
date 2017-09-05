<?php

namespace CrCms\Filter;

interface FilterInterface
{
    /**
     * @param string $var
     * @return string
     */
    public function filter(string $var): string;
}