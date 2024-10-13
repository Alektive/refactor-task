<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Infrastructure\Eloquent\Service;

use App\Module\Loyalty\Domain\Api\LoyaltyAccount;
use App\Module\Loyalty\Domain\Api\RawPerformPaymentLoyaltyPoints;
use App\Module\Loyalty\Infrastructure\Eloquent\Model\LoyaltyPointsTransaction;
use Illuminate\Support\Facades\Log;

class DepositLoyaltyPointsAccount implements \App\Module\Loyalty\Domain\Api\DepositLoyaltyPointsAccount
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
    ): LoyaltyPointsTransaction
    {
        Log::debug(sprintf('Start %s service', __CLASS__));

        try {
            $transaction = LoyaltyPointsTransaction::performPaymentLoyaltyPoints(
                $loyaltyAccount->getId(),
                $rawPerformPaymentLoyaltyPoints->loyalty_points_rule,
                $rawPerformPaymentLoyaltyPoints->description,
                $rawPerformPaymentLoyaltyPoints->payment_id,
                $rawPerformPaymentLoyaltyPoints->payment_amount,
                $rawPerformPaymentLoyaltyPoints->payment_time,
            );

            Log::info($transaction);
        } catch (\Throwable $exception) {
            Log::critical('Failed to perform payment loyalty points transaction.', [
                'exception' => $exception,
            ]);

            throw $exception;
        }

        Log::debug(sprintf('Finish %s service', __CLASS__));

        return $transaction;
    }
}
