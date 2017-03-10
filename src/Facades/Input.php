<?php
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