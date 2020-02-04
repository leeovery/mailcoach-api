<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Leeovery\MailcoachApi;

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
            Route::prefix($apiPrefix)
                 ->middleware('api')
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

            if (! class_exists('AddEmailIndexToSubscribersTable')) {
                $this->publishes([
                    __DIR__.'/../database/migrations/add_email_index_to_subscribers_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_add_email_index_to_subscribers_table.php'),
                ], 'mailcoach-api-migrations');
            }
        }

        return $this;
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'mailcoach-api');
    }
}
