<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Infrastructure\Mail\Service;

use App\Module\Loyalty\Infrastructure\Mail\Model\LoyaltyPointsReceived;
use App\Module\Loyalty\Domain\Api\LoyaltyPointsTransaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyEmailPerformPaymentLoyaltyPoints implements \App\Module\Loyalty\Domain\Api\NotifyEmailPerformPaymentLoyaltyPoints
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
            $account = $loyaltyPointsTransaction->getAccount();
            Mail::to($account)
                ->send(new LoyaltyPointsReceived($loyaltyPointsTransaction->getPointsAmount(), $account));
            Log::info('Account successfully notified.');
        } catch (\Throwable $exception) {
            Log::error('Failed send Email notification.', [
                'exception' => $exception,
            ]);

            return false; // TODO: Не критично
        }

        Log::debug(sprintf('Finish %s service.', __CLASS__));

        return true;
    }
}
