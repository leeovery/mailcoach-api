<?php

use Spatie\Mailcoach\Http\App\Middleware\Authorize;
use Spatie\Mailcoach\Http\App\Middleware\Authenticate;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;
use Spatie\Mailcoach\Http\App\Middleware\SetMailcoachDefaults;

return [

    'webhooks'   => [

        'enabled' => env('MAILCOACH_API_WEBHOOK_ENABLED', false),

        // can be full url with domain or just uri for current domain/site.
        // http://mailbox.pointsbox.test/mailcoach-api/webhook/{event}
        'url'     => 'mailcoach-api/webhook',

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