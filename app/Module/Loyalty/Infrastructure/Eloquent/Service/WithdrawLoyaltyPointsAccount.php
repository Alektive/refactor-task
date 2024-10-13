<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Infrastructure\Eloquent\Service;

use App\Module\Loyalty\Domain\Api\LoyaltyAccount;
use App\Module\Loyalty\Domain\Api\RawWithdrawLoyaltyPoints;
use App\Module\Loyalty\Infrastructure\Eloquent\Model\LoyaltyPointsTransaction;
use Illuminate\Support\Facades\Log;

class WithdrawLoyaltyPointsAccount implements \App\Module\Loyalty\Domain\Api\WithdrawLoyaltyPointsAccount
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
    ): LoyaltyPointsTransaction
    {
        Log::debug(sprintf('Start %s service', __CLASS__));

        try {
            $transaction = LoyaltyPointsTransaction::withdrawLoyaltyPoints(
                $loyaltyAccount->getId(),
                $rawWithdrawLoyaltyPoints->points_amount,
                $rawWithdrawLoyaltyPoints->description,
            );

            Log::info($transaction);
        } catch (\Throwable $exception) {
            Log::critical('Failed to withdraw loyalty points account', ['exception' => $exception]);
            throw $exception;
        }

        Log::debug(sprintf('Finish %s service', __CLASS__));

        return $transaction;
    }
}
