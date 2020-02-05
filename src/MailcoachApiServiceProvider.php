<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Leeovery\MailcoachApi;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Leeovery\MailcoachApi\Models\Contact;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class MailcoachApiServiceProvider extends EventServiceProvider
{
    // protected $listen = [];

    public function boot()
    {
        parent::boot();

        $this->bootPublishables()
             ->bootRoutes();
    }

    protected function bootRoutes()
    {
        Route::macro('mailcoachApi', function (string $apiPrefix = 'api') {
            Route::model('contact', Contact::class);
            Passport::routes(null, ['prefix' => 'api/oauth']);
            Route::prefix($apiPrefix)
                 ->middleware(config('mailcoach-api.middleware'))
                 ->group(__DIR__.'/../routes/api.php');
        });

        return $this;
    }

    protected function bootPublishables()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('mailcoach-api.php'),
            ], 'mailcoach-api-config');

            $this->publishMigrationIfNeeded('add_email_index_to_subscribers_table');
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
            __DIR__.'/../database/migrations/add_email_index_to_subscribers_table.php.stub' => $pathToMigration,
        ], 'mailcoach-api-migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'mailcoach-api');
    }
}
