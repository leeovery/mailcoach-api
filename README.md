# Mailcoach API

This is an opinionated API add-on to Spatie's [Mailcoach](https://mailcoach.app/) app.

It provides a limited set of endpoints for managing Mailcoach over an API. It also provides some UI for managing your API clients for auth, and webhook management.

## Installation

To use this package you should first purchase and install Mailcoach from Spatie into a new or existing Laravel app. Alternatively you can install the Mailcoach standalone app.

Once that's done you can install this package alongside Mailcoach.

You can install the package via composer:

```bash
composer require leeovery/mailcoach-api
```

### Prepare Database:
Publish migrations...
``` bash
php artisan vendor:publish  --tag=mailcoach-api-migrations
```
... & migrate.
``` bash
php artisan migrate
```

### Add Route Macro

Add the following line to your RouteServiceProvider `map` method:

```php 
$apiPrefix = 'api';
$webPrefix = '';
Route::mailcoachApi($apiPrefix, $webPrefix);
```

The params passed in are the defaults so if you're happy with those then feel free to leave them out. On the other hand, you need to change the prefix, you can do so by changing what you pass into the macro.

### Publish Views:
``` bash
php artisan vendor:publish  --tag=mailcoach-api-views
```

### Publish Config:
``` bash
php artisan vendor:publish  --tag=mailcoach-api-config
```

In the config file that's published you can edit the middleware for both the web routes and the api routes.

You can also setup the webhook secret in this file. I recommend using an env var to set this up and keep it secret as it ensures your webhook endpoint(s) stay secure.

### Setup Auth

Setup Laravel Passport for machine-to-machine auth, as per the Passport instructions:
``` bash
php artisan passport:client --client
```

If you should now be able to see the new menu options in Mailcoach, namely `API Clients` & `Webhooks`.

To allow access using the API you will need to create yourself a new API Client. Once that's done you will then have a ClientID (which is an int) and a Client Secret. Both of these will be required to authenticate with the API.

To get actual access to the API from your client you will need to obtain an access_token. To do this, from the client app you will need to do a POST request to [your-api-url]/api/oauth/token with the following post body:

```php
grant_type:client_credentials
client_id:{your-client-id}
client_secret:{your-client-secret}
```

This should be obtained prior to each API session / request, as they don't last forever.

To get an idea you can run the following in your terminal to get the `access_token`:

```bash 
curl -I -H ‘Content-Type: application/x-www-form-urlencoded’ -X POST ‘{your-api-url}/api/oauth/token' -d ‘grant_type=client_credentials&client_id={your-client-id}&client_secret={your-client-secret}’
```

## Usage

### Consider...

This API makes a few assumptions which are important to understand.

The main one is that it considers a subscriber of a certain email, no matter which list they are on, to be the same person. Mailcoach has the concept that each `Subscriber` belongs to one `EmailLst`. A person can subscribe to multiple lists, but they will result in multiple `Subscriber` records being created for them.

This package introduces a `Contact` entity, which will group `Subscriber` records, based on the email, and will keep the email, names, and other meta info consolidated across all their `Subscriber` records.

#### Example:
Consider the user `lee@example.com` is subscribed to 3 lists, and unsubscrbed from 1 list.

A `GET` request to `/contact/lee@example.com` would result in the following response data:

```json5
{
    "data": {
        "email": "lee@example.com",
        "first_name": "Lee",
        "last_name": "Overy",
        "extra_attributes": {
            "full_name": "Lee Overy"
        },
        "subscribed_to": [
            {
                "list_id": 1,
                "subscription_id": 1,
                "subscribed_at": "2020-02-09T12:31:40.000000Z"
            },
            {
                "list_id": 2,
                "subscription_id": 2,
                "subscribed_at": "2020-02-09T12:31:40.000000Z"
            }
        ],
        "unsubscribed_from": [
            {
                "list_id": 3,
                "subscription_id": 3,
                "subscribed_at": "2020-02-09T12:31:40.000000Z",
                "unsubscribed_at": "2020-02-09T12:31:57.000000Z"
            }
        ]
    }
}
 ```

The important thing to take away from this, is that if you want to keep `Subscriber` records of the **same email address** independent across `EmailLists`, you might need to fork this package and make some changes. Or do a PR and let's chat :)

### Endpoints
This package provides a limited number of endpoints, which you can easily see by running `php artisan route:list` from the app dir in your terminal.

But in a nutshell it provides:

#### GET /list
 - Get all lists.
#### GET /list/{listId}
 - Get a list by list primary ID.
 
#### GET /contact/{email}
 - Get a contact
#### POST /contact
 - Create a contact and subscribe to one or more lists
 - FormRequest rules for reference:
 ```php 
[
    'email'        => 'required|email:rfc,dns',
    'list_ids'     => 'required|array',
    'list_ids.*'   => ['required', 'integer', new Exists(EmailList::class, 'id')],
    'attributes'   => 'nullable|array',
    'attributes.*' => 'string', 
]
```
#### PATCH /contact
 - Update a contacts name and/or email
 - Add / remove extra meta info
 - Add / remove from 1 or more lists
 - Unsubscribe from all
 - Resubscribe to all
  - FormRequest rules for reference:
  ```php 
 [
    'email'                       => 'sometimes|email:rfc,dns',
    'unsubscribe_from_list_ids'   => 'sometimes|array',
    'unsubscribe_from_list_ids.*' => ['sometimes', 'integer', new Exists(EmailList::class, 'id')],
    'resubscribe_to_list_ids'     => 'sometimes|array',
    'resubscribe_to_list_ids.*'   => ['sometimes', 'integer', new Exists(EmailList::class, 'id')],
    'attributes'                  => 'sometimes|nullable|array',
    'attributes.*'                => 'sometimes|nullable|string',
    'unsubscribe_all'             => 'sometimes|accepted|must_be_different:resubscribe_all',
    'resubscribe_all'             => 'sometimes|accepted|must_be_different:unsubscribe_all',
];
 ```
#### POST /campaign
 - Create a new campaign with html content (recommend using a Mailable and calling `render` to produce the html)
 - Can schedule to send in the future
 - Omitting scheduled date will result in the campaign sending immdiately
 - FormRequest rules for reference:
 ```php 
 [
    'name'         => ['required', 'alpha_dash', new Unique(Campaign::class, 'name')],
    'subject'      => 'required|string',
    'content'      => 'required|string',
    'list_id'      => ['required', 'integer', new Exists(EmailList::class, 'id')],
    'from_email'   => 'sometimes|email:rfc,dns',
    'from_name'    => 'sometimes|string',
    'scheduled_at' => 'sometimes|nullable|date_format:Y-m-d H:i',
];
```

## Webhooks

We use the awesome [Laravel Webhook Server](https://github.com/spatie/laravel-webhook-server) for provide webhook support.

If you want to change some of the defaults, you can publish teh config file from that package and tweak away. This package simply uses the defaults so anything you change will take effect.

To receive the webhooks this package dispatches you should use the matching client package: [Laravel Webhook Client](https://github.com/spatie/laravel-webhook-client).

### Get Familiar:
Easiest way to get familiar with this is to check webhook the UI. Go ahead and create a new Webhook and you will see how it works.

Essentially, any time a Mailcoach event occurs, we will intercept it, check if any webhooks are configured for that event, and if so, go ahead and fire them.

This way your client app can be notified when a subscriber unsubscribes, or marks an email you send as spam etc.

On the whole, anything triggered via the API wont result in a webhook being fired. The exception to this is sending a campaign via the API - that will trigger events and therefore webhooks. However, updating contacts usually won't - unless I missed something. To be safe, it would be wise to code an awareness for the potential of feedback loops when using the API and webhooks.

### Final note:
If you're unsure of how this will work for you, the best thing to do is **check the code**.

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email me@leeovery.com instead of using the issue tracker.

## Credits

- [Lee Overy](https://github.com/leeovery)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).