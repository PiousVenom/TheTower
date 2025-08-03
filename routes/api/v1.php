<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\BackgroundSkinController;
use App\Http\Controllers\Api\V1\GuardianController;
use App\Http\Controllers\Api\V1\LabController;
use App\Http\Controllers\Api\V1\MenuController;
use App\Http\Controllers\Api\V1\ProfileBannerController;
use App\Http\Controllers\Api\V1\RelicController;
use App\Http\Controllers\Api\V1\SongController;
use App\Http\Controllers\Api\V1\TowerSkinController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->middleware('api')
    ->name('api.v1.')
    ->group(static function (): void {
        Route::apiResource('background-skins', BackgroundSkinController::class)->only(['index', 'show']);
        Route::apiResource('tower-skins', TowerSkinController::class)->only(['index', 'show']);
        Route::apiResource('songs', SongController::class)->only(['index', 'show']);
        Route::apiResource('relics', RelicController::class)->only(['index', 'show']);
        Route::apiResource('guardians', GuardianController::class)->only(['index', 'show']);
        Route::apiResource('menus', MenuController::class)->only(['index', 'show']);
        Route::apiResource('profile-banners', ProfileBannerController::class)->only(['index', 'show']);
        Route::apiResource('labs', LabController::class)->only(['index', 'show']);
    });
