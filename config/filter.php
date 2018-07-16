<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Default filter driver
    |--------------------------------------------------------------------------
    |
    */

    'default' => 'xss',

    /*
    |--------------------------------------------------------------------------
    | Supported filter drivers
    |--------------------------------------------------------------------------
    |
    | XSS:  XssFilter
    | Shell: ShellFilter
    |
    */

    'drivers'=>[
        'xss' => CrCms\Filter\Drives\XssFilter::class,
        'shell' => CrCms\Filter\Drives\ShellFilter::class,
    ]
];