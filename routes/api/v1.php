<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\BackgroundSkinController;
use App\Http\Controllers\Api\V1\BonusCategoryController;
use App\Http\Controllers\Api\V1\BonusTypeController;
use App\Http\Controllers\Api\V1\GuardianController;
use App\Http\Controllers\Api\V1\MenuController;
use App\Http\Controllers\Api\V1\ProfileBannerController;
use App\Http\Controllers\Api\V1\RelicController;
use App\Http\Controllers\Api\V1\SongController;
use App\Http\Controllers\Api\V1\TierController;
use App\Http\Controllers\Api\V1\TowerSkinController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->middleware('api')
    ->name('api.v1.')
    ->group(static function (): void {
        Route::apiResource('tiers', TierController::class);
        Route::apiResource('bonus-categories', BonusCategoryController::class);
        Route::apiResource('bonus-types', BonusTypeController::class);
        Route::apiResource('background-skins', BackgroundSkinController::class);
        Route::apiResource('tower-skins', TowerSkinController::class);
        Route::apiResource('songs', SongController::class);
        Route::apiResource('relics', RelicController::class);
        Route::apiResource('guardians', GuardianController::class);
        Route::apiResource('menus', MenuController::class);
        Route::apiResource('profile-banners', ProfileBannerController::class);
    });
