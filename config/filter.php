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
        'xss' => CrCms\Filter\Drivers\XssFilter::class,
        'shell' => CrCms\Filter\Drivers\ShellFilter::class,
    ]
];