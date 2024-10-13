<?php

namespace App\Module\Loyalty\Domain\Api;

interface DepositLoyaltyPointsAccount
{
    /**
     * @param LoyaltyAccount $loyaltyAccount
     * @param RawPerformPaymentLoyaltyPoints $rawPerformPaymentLoyaltyPoints
     * @return LoyaltyPointsTransaction
     * @throws \Throwable
     */
    public function do(
        LoyaltyAccount                 $loyaltyAccount,
        RawPerformPaymentLoyaltyPoints $rawPerformPaymentLoyaltyPoints,
    ): LoyaltyPointsTransaction;
}
