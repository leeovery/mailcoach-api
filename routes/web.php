<?php

use Illuminate\Support\Facades\Route;
use Leeovery\MailcoachApi\Http\App\Controllers\ClientIndexController;
use Leeovery\MailcoachApi\Http\App\Controllers\EditWebhookController;
use Leeovery\MailcoachApi\Http\App\Controllers\CreateClientController;
use Leeovery\MailcoachApi\Http\App\Controllers\WebhookIndexController;
use Leeovery\MailcoachApi\Http\App\Controllers\DestroyClientController;
use Leeovery\MailcoachApi\Http\App\Controllers\CreateWebhookController;
use Leeovery\MailcoachApi\Http\App\Controllers\DestroyWebhookController;
use Leeovery\MailcoachApi\Http\App\Controllers\ActivateWebhookController;
use Leeovery\MailcoachApi\Http\App\Controllers\DeactivateWebhookController;

Route::prefix('api')->group(function () {

    Route::prefix('clients')->group(function () {
        Route::get('/', '\\'.ClientIndexController::class)->name('mailcoach-api.clients');
        Route::post('/', '\\'.CreateClientController::class)->name('mailcoach-api.clients.create');
        Route::delete('{client}', '\\'.DestroyClientController::class)->name('mailcoach-api.clients.delete');
    });

    Route::prefix('webhooks')->group(function () {
        Route::get('/', '\\'.WebhookIndexController::class)->name('mailcoach-api.webhooks');
        Route::post('/', '\\'.CreateWebhookController::class)->name('mailcoach-api.webhooks.create');
        Route::get('{webhook}/details', ['\\'.EditWebhookController::class, 'edit'])
             ->name('mailcoach-api.webhooks.edit');
        Route::put('{webhook}/details', ['\\'.EditWebhookController::class, 'update']);

        Route::put('{webhook}/deactivate', '\\'.DeactivateWebhookController::class)->name('mailcoach-api.webhooks.deactivate');
        Route::put('{webhook}/activate', '\\'.ActivateWebhookController::class)->name('mailcoach-api.webhooks.activate');


        Route::delete('{webhook}', '\\'.DestroyWebhookController::class)->name('mailcoach-api.webhooks.delete');
    });

});