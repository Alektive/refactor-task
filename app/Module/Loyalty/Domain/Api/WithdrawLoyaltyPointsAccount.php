<?php

namespace App\Module\Loyalty\Domain\Api;

interface WithdrawLoyaltyPointsAccount
{
    /**
     * @param LoyaltyAccount $loyaltyAccount
     * @param RawWithdrawLoyaltyPoints $rawWithdrawLoyaltyPoints
     * @return LoyaltyPointsTransaction
     * @throws \Throwable
     */
    public function do(
        LoyaltyAccount           $loyaltyAccount,
        RawWithdrawLoyaltyPoints $rawWithdrawLoyaltyPoints,
    ): LoyaltyPointsTransaction;
}
