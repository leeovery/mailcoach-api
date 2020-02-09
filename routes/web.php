<?php

use Illuminate\Support\Facades\Route;
use Leeovery\MailcoachApi\Http\App\Controllers\Clients\ClientIndexController;
use Leeovery\MailcoachApi\Http\App\Controllers\Webhooks\EditWebhookController;
use Leeovery\MailcoachApi\Http\App\Controllers\Clients\CreateClientController;
use Leeovery\MailcoachApi\Http\App\Controllers\Webhooks\WebhookIndexController;
use Leeovery\MailcoachApi\Http\App\Controllers\Clients\DestroyClientController;
use Leeovery\MailcoachApi\Http\App\Controllers\Webhooks\CreateWebhookController;
use Leeovery\MailcoachApi\Http\App\Controllers\Webhooks\DestroyWebhookController;
use Leeovery\MailcoachApi\Http\App\Controllers\Webhooks\ActivateWebhookController;
use Leeovery\MailcoachApi\Http\App\Controllers\Webhooks\WebhookEventLogController;
use Leeovery\MailcoachApi\Http\App\Controllers\Webhooks\DeactivateWebhookController;

Route::prefix('api')->group(function () {

    Route::prefix('clients')->group(function () {

        Route::get('/', '\\'.ClientIndexController::class)->name('mailcoach-api.clients');
        Route::post('/', '\\'.CreateClientController::class)->name('mailcoach-api.clients.create');
        Route::delete('{client}', '\\'.DestroyClientController::class)->name('mailcoach-api.clients.delete');

    });

    Route::prefix('webhooks')->group(function () {

        Route::get('/', '\\'.WebhookIndexController::class)->name('mailcoach-api.webhooks');
        Route::post('/', '\\'.CreateWebhookController::class)->name('mailcoach-api.webhooks.create');

        Route::prefix('{webhook}')->group(function () {

            Route::get('details', ['\\'.EditWebhookController::class, 'edit'])->name('mailcoach-api.webhooks.edit');
            Route::put('details', ['\\'.EditWebhookController::class, 'update']);
            Route::get('event-log', '\\'.WebhookEventLogController::class)->name('mailcoach-api.webhooks.event-log');
            Route::put('deactivate', '\\'.DeactivateWebhookController::class)
                 ->name('mailcoach-api.webhooks.deactivate');
            Route::put('activate', '\\'.ActivateWebhookController::class)->name('mailcoach-api.webhooks.activate');
            Route::delete('/', '\\'.DestroyWebhookController::class)->name('mailcoach-api.webhooks.delete');

        });
    });

});