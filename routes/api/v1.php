<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\BackgroundSkinController;
use App\Http\Controllers\Api\V1\BonusCategoryController;
use App\Http\Controllers\Api\V1\BonusTypeController;
use App\Http\Controllers\Api\V1\GuardianController;
use App\Http\Controllers\Api\V1\MenuController;
use App\Http\Controllers\Api\V1\ProfileBannerController;
use App\Http\Controllers\Api\V1\RelicBonusController;
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

        //        // Pivot (single bonus per relic for now)
        //        Route::apiResource('relics.bonus', RelicBonusController::class)
        //            ->shallow(); // gives routes like DELETE /relic-bonus/{id}
        //
        //        // routes/api/v1.php (add just below the relic apiResource)
        //        Route::patch('relics/{relic}/restore',          // PATCH /api/v1/relics/1/restore
        //            [RelicController::class, 'restore'])
        //            ->withTrashed()                           // ← allow model binding on trashed rows
        //            ->name('api.v1.relics.restore');
    });
