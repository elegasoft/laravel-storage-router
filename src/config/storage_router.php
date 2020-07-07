<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Public File URL Path
    |--------------------------------------------------------------------------
    |
    | Here you may specify the route prefix that should be used by the
    | application to determine if the request is intended to serve
    | files to the public .
    |
    */

    'url'  => 'storage',

    /*
    |--------------------------------------------------------------------------
    | Public Filesystem
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem that should
    | be used by the application to retrieve public files.
    |
    */
    'disk' => 'public',

    /*
    |--------------------------------------------------------------------------
    | Authorization Class
    |--------------------------------------------------------------------------
    |
    | Here you may specify the class that should be called by the
    | application to authorize access to any public file.
    |
    */

    'gate' => null,

];