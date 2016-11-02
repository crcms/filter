<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/21
 * Time: 13:58
 */

namespace CrCms\Filter;


interface FilterInterface
{

    /**
     * @param string $var
     * @return string
     */
    public function filter(string $var) : string;

}