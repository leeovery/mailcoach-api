<?php

use Spatie\Mailcoach\Http\App\Middleware\Authorize;
use Spatie\Mailcoach\Http\App\Middleware\Authenticate;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;
use Spatie\Mailcoach\Http\App\Middleware\SetMailcoachDefaults;

return [

    /*
    *  These middleware will be assigned to every Mailcoach API route, giving you the chance
    *  to add your own middleware to this stack or override any of the existing middleware.
    */
    'middleware' => [

        'api' => [
            'api',
            CheckClientCredentials::class,
        ],

        'web' => [
            'web',
            Authenticate::class,
            Authorize::class,
            SetMailcoachDefaults::class,
        ],

    ],

];