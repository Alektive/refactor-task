<?php

use Illuminate\Support\Facades\Route;
use App\Module\Loyalty\Network\Http\Controller;

Route::prefix('api/loyaltyPoints')
//    ->middleware(['auth:sanctum'])
    ->group(function () {
        Route::post('deposit', Controller\LoyaltyPointsDepositController::class);
        Route::post('withdraw', Controller\LoyaltyPointsWithdrawController::class);
        Route::post('cancel', Controller\LoyaltyPointsCancelController::class);
    });
