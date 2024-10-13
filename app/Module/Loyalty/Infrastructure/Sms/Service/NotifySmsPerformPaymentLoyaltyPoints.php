<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Infrastructure\Sms\Service;

use App\Module\Loyalty\Domain\Api\LoyaltyPointsTransaction;
use Illuminate\Support\Facades\Log;

class NotifySmsPerformPaymentLoyaltyPoints implements \App\Module\Loyalty\Domain\Api\NotifySmsPerformPaymentLoyaltyPoints
{
    /**
     * @param LoyaltyPointsTransaction $loyaltyPointsTransaction
     * @return bool
     * @throws \Throwable
     */
    public function do(
        LoyaltyPointsTransaction $loyaltyPointsTransaction,
    ): bool
    {
        Log::debug(sprintf('Start %s service.', __CLASS__));

        try {
            // TODO: Заглушка
            Log::info('Account successfully notified.', [
                'accountId' => $loyaltyPointsTransaction->getAccount()->getId(),
                'transactionId' => $loyaltyPointsTransaction->getId(),
            ]);
        } catch (\Throwable $exception) {
            Log::error('Failed send Email notification.', [
                'accountId' => $loyaltyPointsTransaction->getAccount()->getId(),
                'transactionId' => $loyaltyPointsTransaction->getId(),
                'exception' => $exception,
            ]);

            return false; // TODO: Не критично
        }

        Log::debug(sprintf('Finish %s service.', __CLASS__));

        return true;
    }
}
