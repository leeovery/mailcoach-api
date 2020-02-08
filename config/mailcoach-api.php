<?php

use Spatie\Mailcoach\Http\App\Middleware\Authorize;
use Spatie\Mailcoach\Http\App\Middleware\Authenticate;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;
use Spatie\Mailcoach\Http\App\Middleware\SetMailcoachDefaults;

return [

    'webhooks'   => [

        'enabled' => env('MAILCOACH_API_WEBHOOK_ENABLED', false),

        'secret' => env('MAILCOACH_API_WEBHOOK_SECRET', 'this-is-meant-to-be-a-secret-dude'),

    ],

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