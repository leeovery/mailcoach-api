<?php

use Illuminate\Support\Facades\Route;
use Leeovery\MailcoachApi\Http\App\Controllers\ClientIndexController;
use Leeovery\MailcoachApi\Http\App\Controllers\WebhookEditController;
use Leeovery\MailcoachApi\Http\App\Controllers\ClientCreateController;
use Leeovery\MailcoachApi\Http\App\Controllers\WebhookIndexController;
use Leeovery\MailcoachApi\Http\App\Controllers\ClientDestroyController;
use Leeovery\MailcoachApi\Http\App\Controllers\WebhookCreateController;
use Leeovery\MailcoachApi\Http\App\Controllers\WebhookDestroyController;

Route::prefix('api')->group(function () {

    Route::prefix('clients')->group(function () {
        Route::get('/', '\\'.ClientIndexController::class)->name('mailcoach-api.clients');
        Route::post('/', '\\'.ClientCreateController::class)->name('mailcoach-api.clients.create');
        Route::delete('{client}', '\\'.ClientDestroyController::class)->name('mailcoach-api.clients.destroy');
    });

    Route::prefix('webhooks')->group(function () {
        Route::get('/', '\\'.WebhookIndexController::class)->name('mailcoach-api.webhooks');
        Route::post('/', '\\'.WebhookCreateController::class)->name('mailcoach-api.webhooks.create');
        Route::get('{webhook}/details', ['\\'.WebhookEditController::class, 'edit'])->name('mailcoach-api.webhooks.edit');
        Route::put('{webhook}/details', ['\\'.WebhookEditController::class, 'update']);
        Route::delete('{webhook}', '\\'.WebhookDestroyController::class)->name('mailcoach-api.webhooks.destroy');
    });

});