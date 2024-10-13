<?php

declare(strict_types=1);

namespace App\Module\Loyalty\UseCase\Service;

use App\Module\Loyalty\Domain\Api\LoyaltyAccount;
use App\Module\Loyalty\Domain\Api\LoyaltyPointsTransaction;
use App\Module\Loyalty\Domain\Api\NotifyEmailPerformPaymentLoyaltyPoints;
use App\Module\Loyalty\Domain\Api\NotifySmsPerformPaymentLoyaltyPoints;
use App\Module\Loyalty\Domain\Api\RawPerformPaymentLoyaltyPoints;
use Illuminate\Support\Facades\Log;

class DepositLoyaltyPointsAccount implements \App\Module\Loyalty\UseCase\Api\DepositLoyaltyPointsAccount
{
    public function __construct(
        private \App\Module\Loyalty\Domain\Api\DepositLoyaltyPointsAccount $depositLoyaltyPointsAccount,
        private NotifyEmailPerformPaymentLoyaltyPoints $notifyEmailPerformPaymentLoyaltyPoints,
        private NotifySmsPerformPaymentLoyaltyPoints $notifySmsPerformPaymentLoyaltyPoints,
    )
    {
    }

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
        try {
            $transaction = $this
                ->depositLoyaltyPointsAccount
                ->do($loyaltyAccount, $rawPerformPaymentLoyaltyPoints);

            // notify
            if ($loyaltyAccount->canNotifyEmail()) {
                $this
                    ->notifyEmailPerformPaymentLoyaltyPoints
                    ->do($transaction);
            }
            if ($loyaltyAccount->canNotifySms()) {
                $this
                    ->notifySmsPerformPaymentLoyaltyPoints
                    ->do($transaction);
            }
        } catch (\Throwable $exception) {
            Log::critical('Failed to deposit loyalty points account: ' . $exception->getMessage(), [
                'exception' => $exception,
            ]);

            throw $exception;
        }

        return $transaction;
    }
}
