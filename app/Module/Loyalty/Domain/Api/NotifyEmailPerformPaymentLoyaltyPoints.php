<?php

namespace App\Module\Loyalty\Domain\Api;

interface NotifyEmailPerformPaymentLoyaltyPoints
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
