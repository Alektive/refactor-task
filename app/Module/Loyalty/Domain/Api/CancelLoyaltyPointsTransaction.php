<?php

namespace App\Module\Loyalty\Domain\Api;

interface CancelLoyaltyPointsTransaction
{
    /**
     * @param LoyaltyPointsTransaction $loyaltyPointsTransaction
     * @param RawCancelLoyaltyPointsTransaction $rawCancelLoyaltyPointsTransaction
     * @return LoyaltyPointsTransaction
     * @throws \Throwable
     */
    public function do(
        LoyaltyPointsTransaction          $loyaltyPointsTransaction,
        RawCancelLoyaltyPointsTransaction $rawCancelLoyaltyPointsTransaction,
    ): LoyaltyPointsTransaction;
}
