<?php

use Laravel\Passport\Http\Middleware\CheckClientCredentials;

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
        ],

    ],

];