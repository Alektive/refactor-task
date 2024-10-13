<?php

namespace App\Module\Loyalty\UseCase\Api;

use App\Module\Loyalty\Domain\Api\LoyaltyAccount;
use App\Module\Loyalty\Domain\Api\LoyaltyPointsTransaction;
use App\Module\Loyalty\Domain\Api\RawPerformPaymentLoyaltyPoints;

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
