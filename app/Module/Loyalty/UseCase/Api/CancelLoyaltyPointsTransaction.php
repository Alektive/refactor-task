<?php

namespace App\Module\Loyalty\UseCase\Api;

use App\Module\Loyalty\Domain\Api\LoyaltyPointsTransaction;

interface CancelLoyaltyPointsTransaction
{
    /**
     * Execute service action.
     *
     * @param LoyaltyPointsTransaction $loyaltyPointsTransaction
     * @return LoyaltyPointsTransaction
     * @throws \Throwable
     */
    public function do(
        LoyaltyPointsTransaction $loyaltyPointsTransaction,
    ): LoyaltyPointsTransaction;
}
