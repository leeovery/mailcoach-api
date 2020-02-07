<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Leeovery\MailcoachApi;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Leeovery\MailcoachApi\Models\Contact;
use Leeovery\MailcoachApi\Listeners\MailcoachEventListener;

class MailcoachApiServiceProvider extends ServiceProvider
{
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
                __DIR__.'/../config/config.php' => config_path('mailcoach-api.php'),
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
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'mailcoach-api');
        Event::listen('Spatie\Mailcoach\Events\*', MailcoachEventListener::class);
    }
}
