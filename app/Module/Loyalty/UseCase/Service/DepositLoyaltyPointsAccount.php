<?php

declare(strict_types=1);

namespace App\Module\Loyalty\UseCase\Service;

use App\Module\Loyalty\Domain\Api\LoyaltyAccount;
use App\Module\Loyalty\Domain\Api\LoyaltyPointsTransaction;
use App\Module\Loyalty\Domain\Api\RawPerformPaymentLoyaltyPoints;
use Illuminate\Support\Facades\Log;

class DepositLoyaltyPointsAccount implements \App\Module\Loyalty\UseCase\Api\DepositLoyaltyPointsAccount
{
    /**
     * @param LoyaltyAccount $loyaltyAccount
     * @param RawPerformPaymentLoyaltyPoints $rawPerformPaymentLoyaltyPoints
     * @return LoyaltyPointsTransaction
     */
    public function do(
        LoyaltyAccount                 $loyaltyAccount,
        RawPerformPaymentLoyaltyPoints $rawPerformPaymentLoyaltyPoints,
    ): LoyaltyPointsTransaction
    {
        try {
            throw new \LogicException('Not implemented');
        } catch (\Throwable $exception) {
            Log::critical('Failed to deposit loyalty points account: ' . $exception->getMessage(), [
                'exception' => $exception,
            ]);

            throw $exception;
        }
    }
}
