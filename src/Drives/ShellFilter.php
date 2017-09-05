<?php

namespace CrCms\Filter\Drives;

use CrCms\Filter\FilterInterface;

class ShellFilter implements FilterInterface
{
    /**
     * @param string $var
     * @return string
     */
    public function filter(string $var): string
    {
        return escapeshellarg($var);
    }
}