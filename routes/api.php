<?php

use Illuminate\Support\Facades\Route;
use Leeovery\MailcoachApi\Http\Controllers\ListController;
use Leeovery\MailcoachApi\Http\Controllers\ContactController;
use Leeovery\MailcoachApi\Http\Controllers\CampaignController;

Route::apiResource('list', ListController::class)->only(['index', 'show']);
Route::apiResource('contact', ContactController::class)->except(['index', 'destroy']);
Route::apiResource('campaign', CampaignController::class)->except(['destroy']);