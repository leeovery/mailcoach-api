<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Leeovery\MailcoachApi;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Event;
use Leeovery\MailcoachApi\Models\Contact;
use Leeovery\MailcoachApi\Listeners\MailcoachEventListener;
use Leeovery\MailcoachApi\Listeners\MailcoachEventSubscriber;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class MailcoachApiServiceProvider extends EventServiceProvider
{
    public function boot()
    {
        parent::boot();

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
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/mailcoach'),
        ], 'mailcoach-api-views');

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('mailcoach-api.php'),
        ], 'mailcoach-api-config');

        $this->publishMigrationIfNeeded('add_email_index_to_subscribers_table');

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
            __DIR__.'/../database/migrations/add_email_index_to_subscribers_table.php.stub' => $pathToMigration,
        ], 'mailcoach-api-migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'mailcoach-api');
        Event::subscribe(new MailcoachEventSubscriber);
    }
}
