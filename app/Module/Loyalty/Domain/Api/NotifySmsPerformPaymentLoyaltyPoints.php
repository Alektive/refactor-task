<?php

namespace App\Module\Loyalty\Domain\Api;

interface NotifySmsPerformPaymentLoyaltyPoints
{
    /**
     * Execute service action.
     *
     * @param LoyaltyPointsTransaction $loyaltyPointsTransaction
     * @return bool
     * @throws \Throwable
     */
    public function do(
        LoyaltyPointsTransaction $loyaltyPointsTransaction,
    ): bool;
}
