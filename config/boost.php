<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Boost App Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to display the name of the application within the UI
    | or in other locations. Of course, you're free to change the value.
    |
    */

    'name' => env('BOOST_APP_NAME', env('APP_NAME')),

    /*
    |--------------------------------------------------------------------------
    | Boost Domain Name
    |--------------------------------------------------------------------------
    |
    | This value is the "domain name" associated with your application. This
    | can be used to prevent Boost's internal routes from being registered
    | on subdomains which do not need to handle by your application.
    |
    */

    'domain' => env('BOOST_DOMAIN_NAME', null),

    'ports' => [443, 80],

    /*
    |--------------------------------------------------------------------------
    | Boost Ignored Path
    |--------------------------------------------------------------------------
    |
    | This value is an array of the path's that Boost has to ignore it.
    | This can be used to prevent Boost's internal routes from being
    | registered on path's which do not need to handle by your application.
    |
    */

    'excepts' => [],
];
