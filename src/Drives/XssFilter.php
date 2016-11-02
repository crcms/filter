<?php
/**
 * Xss过滤
 * User: simon
 * Date: 2016/9/21
 * Time: 13:59
 */

namespace CrCms\Filter\Drives;

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
    public function filter(string $var) : string
    {
        // TODO: Implement filter() method.

        return $this->xssClean($var);
    }


    /**
     * @param string $var
     * @return string
     */
    protected function xssClean(string $var) : string
    {
        return htmlspecialchars($var);
    }

}