<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Leeovery\MailcoachApi;

use Illuminate\Support\Str;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Leeovery\MailcoachApi\Models\Contact;
use Leeovery\MailcoachApi\Support\Triggers;
use Spatie\Mailcoach\Events\SubscribedEvent;
use Spatie\Mailcoach\Events\CampaignSentEvent;
use Spatie\Mailcoach\Events\UnsubscribedEvent;
use Spatie\Mailcoach\Events\CampaignOpenedEvent;
use Spatie\Mailcoach\Events\BounceRegisteredEvent;
use Spatie\Mailcoach\Events\CampaignMailSentEvent;
use Spatie\Mailcoach\Events\CampaignLinkClickedEvent;
use Spatie\Mailcoach\Events\ComplaintRegisteredEvent;
use Leeovery\MailcoachApi\Subscribers\WebhookSubscriber;
use Leeovery\MailcoachApi\Listeners\MailcoachEventListener;
use Spatie\Mailcoach\Events\UnconfirmedSubscriberCreatedEvent;

class MailcoachApiServiceProvider extends ServiceProvider
{
    public array $actionMap = [
        // This event will fire when a complaint has bounced hard.
        BounceRegisteredEvent::class             => 'hard-bounced',

        // This event will be fired when somebody clicks a link in a mail. This event will only be fired for campaigns that have click tracking enabled.
        CampaignLinkClickedEvent::class          => 'clicked',

        // This event will be fired after you've sent a campaign, and all mails are queued to be sent. Keep in mind that not all your subscribers will have gotten your mail when this event is fired.
        CampaignSentEvent::class                 => 'queued-to-be-sent',

        // This event will be fired when a mail has actually been sent to a single subscriber.
        CampaignMailSentEvent::class             => 'sent',

        // This event will be fired when somebody opens an email. Be aware that this event could be fired many times after sending a campaign to a email list with a large number of subscribers. This event will only be fired for campaigns that have open tracking enabled.
        CampaignOpenedEvent::class               => 'opened',

        // This event will fire when a complaint has been received about a sent mail. In many cases this means that the receiver marked it as spam.
        ComplaintRegisteredEvent::class          => 'marked-as-spam',

        // This event will be fired as soon as someone subscribes. If double opt-in is enabled on the email list someone is in the process of subscribing to, this event will be fired when the subscription is confirmed.
        SubscribedEvent::class                   => 'subscribes',

        // This event will fire after a new email address is added to an email list that requires confirmation.
        UnconfirmedSubscriberCreatedEvent::class => 'subscribes-with-confirmation',

        // This event will be fired as soon as someone unsubscribes.
        UnsubscribedEvent::class                 => 'unsubscribes',
    ];

    public function boot()
    {
        $this->bootPublishables()
             ->bootRoutes()
             ->bootViews();
    }

    protected function bootViews()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mailcoach-api');
    }

    protected function bootRoutes()
    {
        Route::macro('mailcoachApi', function (string $apiPrefix = 'api', string $webPrefix = '') {
            Route::model('contact', Contact::class);
            Passport::routes(null, ['prefix' => 'api/oauth']);

            Route::prefix($apiPrefix)
                 ->middleware(config('mailcoach-api.middleware.api'))
                 ->group(__DIR__.'/../routes/api.php');

            Route::prefix($webPrefix)
                 ->middleware(config('mailcoach-api.middleware.web'))
                 ->group(__DIR__.'/../routes/web.php');
        });

        return $this;
    }

    protected function bootPublishables()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/mailcoach'),
            ], 'mailcoach-api-views');

            $this->publishes([
                __DIR__.'/../config/mailcoach-api.php' => config_path('mailcoach-api.php'),
            ], 'mailcoach-api-config');

            $this->publishMigrationIfNeeded('create_mailcoach_api_tables');
        }

        return $this;
    }

    protected function publishMigrationIfNeeded($migrationName)
    {
        $timestamp = date('Y_m_d_His');
        $pathToMigration = collect($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(fn($path) => File::glob("{$path}*_{$migrationName}.php"))
            ->push($this->app->databasePath()."/migrations/{$timestamp}_{$migrationName}.php")
            ->first();

        $this->publishes([
            __DIR__.'/../database/migrations/create_mailcoach_api_tables.php.stub' => $pathToMigration,
        ], 'mailcoach-api-migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/mailcoach-api.php', 'mailcoach-api');

        $this->app->singleton(Triggers::class, function () {
            return new Triggers($this->actionMap);
        });

        Event::listen('Spatie\Mailcoach\Events\*', MailcoachEventListener::class);
        Event::subscribe(WebhookSubscriber::class);

        Str::macro('kebabToSentence', function ($value) {
            return Str::ucfirst(Str::lower(str_replace('-', ' ', $value)));
        });
    }
}
