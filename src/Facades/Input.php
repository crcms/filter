<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/21
 * Time: 15:04
 */

namespace CrCms\Filter\Facades;


use Illuminate\Support\Facades\Facade;

class Input extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'input';
    }

}