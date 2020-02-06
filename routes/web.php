<?php

use Illuminate\Support\Facades\Route;
use Leeovery\MailcoachApi\Http\App\Controllers\IndexApiClientController;
use Leeovery\MailcoachApi\Http\App\Controllers\CreateApiClientController;
use Leeovery\MailcoachApi\Http\App\Controllers\DestroyApiClientController;

Route::prefix('settings/api-clients')->group(function () {
    Route::get('/', '\\'.IndexApiClientController::class)->name('mailcoach-api.clients');
    Route::post('/', '\\'.CreateApiClientController::class)->name('mailcoach-api.clients.create');
    Route::delete('{client}', '\\'.DestroyApiClientController::class)->name('mailcoach-api.clients.destroy');
});