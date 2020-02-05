<?php

use Illuminate\Support\Facades\Route;
use Leeovery\MailcoachApi\Http\App\Controllers\IndexApiClientController;
use LeeOvery\MailcoachApi\Http\App\Controllers\CreateApiClientController;
use Leeovery\MailcoachApi\Http\App\Controllers\DestroyApiClientController;

Route::prefix('settings')->group(function () {
    Route::prefix('api-clients')->name('api-clients.')->group(function () {
        Route::get('/', IndexApiClientController::class)->name('index');
        Route::post('/', CreateApiClientController::class)->name('create');
        Route::delete('{client}', DestroyApiClientController::class)->name('destroy');
    });
});