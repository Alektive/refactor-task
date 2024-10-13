<?php

namespace App\Module\Loyalty\UseCase\Api;

use App\Module\Loyalty\Domain\Api\LoyaltyAccount;
use App\Module\Loyalty\Domain\Api\LoyaltyPointsTransaction;
use App\Module\Loyalty\Domain\Api\RawWithdrawLoyaltyPoints;

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
