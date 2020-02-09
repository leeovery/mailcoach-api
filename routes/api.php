<?php

use Illuminate\Support\Facades\Route;
use Leeovery\MailcoachApi\Http\Api\Controllers\ListController;
use Leeovery\MailcoachApi\Http\Api\Controllers\ContactController;
use Leeovery\MailcoachApi\Http\Api\Controllers\CampaignController;

Route::apiResource('list', ListController::class)->only(['index', 'show']);
Route::apiResource('contact', ContactController::class)->only(['store', 'show', 'update']);
Route::apiResource('campaign', CampaignController::class)->only(['store']);