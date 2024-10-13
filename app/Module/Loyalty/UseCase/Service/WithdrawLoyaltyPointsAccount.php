<?php

declare(strict_types=1);

namespace App\Module\Loyalty\UseCase\Service;

use App\Module\Loyalty\Domain\Api\LoyaltyAccount;
use App\Module\Loyalty\Domain\Api\LoyaltyPointsTransaction;
use App\Module\Loyalty\Domain\Api\RawWithdrawLoyaltyPoints;
use Illuminate\Support\Facades\Log;

final class WithdrawLoyaltyPointsAccount implements \App\Module\Loyalty\UseCase\Api\WithdrawLoyaltyPointsAccount
{
    public function __construct(
        private \App\Module\Loyalty\Domain\Api\WithdrawLoyaltyPointsAccount $withdrawLoyaltyPointsAccount,
    )
    {
    }

    /**
     * @param LoyaltyAccount $loyaltyAccount
     * @param RawWithdrawLoyaltyPoints $rawWithdrawLoyaltyPoints
     * @return LoyaltyPointsTransaction
     * @throws \Throwable
     */
    public function do(
        LoyaltyAccount $loyaltyAccount,
        RawWithdrawLoyaltyPoints $rawWithdrawLoyaltyPoints,
    ): LoyaltyPointsTransaction
    {
        try {
            if ($loyaltyAccount->getBalance() < $rawWithdrawLoyaltyPoints->points_amount) {
                throw new \LogicException('Insufficient funds: ' . $rawWithdrawLoyaltyPoints->points_amount);
            }

            $transaction = $this
                ->withdrawLoyaltyPointsAccount
                ->do($loyaltyAccount, $rawWithdrawLoyaltyPoints);
        } catch (\Throwable $exception) {
            Log::critical('Failed withdraw loyalty points account: ' . $exception->getMessage(), [
                'exception' => $exception,
            ]);

            throw $exception;
        }

        return $transaction;
    }
}
