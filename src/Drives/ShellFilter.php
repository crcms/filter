<?php
/**
 * Shell过滤
 * User: simon
 * Date: 2016/9/21
 * Time: 15:19
 */

namespace CrCms\Filter\Drives;


use CrCms\Filter\FilterInterface;

class ShellFilter implements FilterInterface
{

    /**
     * @param string $var
     * @return string
     */
    public function filter(string $var) : string
    {
        // TODO: Implement filter() method.
        return escapeshellarg($var);
    }

}