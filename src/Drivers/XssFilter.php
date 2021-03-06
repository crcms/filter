<?php

namespace CrCms\Filter\Drivers;

use CrCms\Filter\FilterInterface;

class XssFilter implements FilterInterface
{
    /**
     * @var null
     */
    protected $config = null;

    /**
     * XssFilter constructor.
     * @param null $config
     */
    public function __construct($config = null)
    {
        $this->config = $config;
    }

    /**
     * @param string $var
     * @return string
     */
    public function filter(string $var): string
    {
        return $this->xssClean($var);
    }

    /**
     * @param string $var
     * @return string
     */
    protected function xssClean(string $var): string
    {
        return htmlspecialchars($var);
    }
}