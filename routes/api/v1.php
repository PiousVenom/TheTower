<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\BackgroundSkinController;
use App\Http\Controllers\Api\V1\BonusCategoryController;
use App\Http\Controllers\Api\V1\BonusTypeController;
use App\Http\Controllers\Api\V1\RelicBonusController;
use App\Http\Controllers\Api\V1\RelicController;
use App\Http\Controllers\Api\V1\TierController;
use App\Http\Controllers\Api\V1\TowerSkinController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->middleware('api')          // default API middleware group
    ->name('api.v1.')            // route names like api.v1.relics.index
    ->group(static function (): void {
        // Lookup tables
        Route::apiResource('tiers', TierController::class);
        Route::apiResource('bonus-categories', BonusCategoryController::class);
        Route::apiResource('bonus-types', BonusTypeController::class);
        Route::apiResource('background-skins', BackgroundSkinController::class);
        Route::apiResource('tower-skins', TowerSkinController::class);

        // Main resource
        Route::apiResource('relics', RelicController::class);

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
