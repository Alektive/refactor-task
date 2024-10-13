<?php

use Illuminate\Support\Facades\Route;
use App\Module\Loyalty\Network\Http\Controller\LoyaltyPointsController;

Route::prefix('api/loyaltyPoints')
    ->middleware(['auth:sanctum'])
    ->group(function () {
        Route::post('deposit', [LoyaltyPointsController::class, 'deposit']);
        Route::post('withdraw', [LoyaltyPointsController::class, 'withdraw']);
        Route::post('cancel', [LoyaltyPointsController::class, 'cancel']);
    });
