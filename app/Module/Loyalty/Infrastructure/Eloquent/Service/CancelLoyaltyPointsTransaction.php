<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Infrastructure\Eloquent\Service;

use App\Module\Loyalty\Domain\Api\RawCancelLoyaltyPointsTransaction;
use App\Module\Loyalty\Domain\Api\LoyaltyPointsTransaction;
use Illuminate\Support\Facades\Log;

final class CancelLoyaltyPointsTransaction implements \App\Module\Loyalty\Domain\Api\CancelLoyaltyPointsTransaction
{
    /**
     * @param LoyaltyPointsTransaction $loyaltyPointsTransaction
     * @param RawCancelLoyaltyPointsTransaction $rawCancelLoyaltyPointsTransaction
     * @return LoyaltyPointsTransaction
     */
    public function do(
        LoyaltyPointsTransaction          $loyaltyPointsTransaction,
        RawCancelLoyaltyPointsTransaction $rawCancelLoyaltyPointsTransaction,
    ): LoyaltyPointsTransaction
    {
        Log::debug(sprintf('Start %s service.', __CLASS__));

        try {
            if (!($loyaltyPointsTransaction instanceof \App\Module\Loyalty\Infrastructure\Eloquent\Model\LoyaltyPointsTransaction)) {
                throw new \LogicException('Unexpected LoyaltyPointsTransaction');
            }

            $loyaltyPointsTransaction->canceled = time();
            $loyaltyPointsTransaction->cancellation_reason = $rawCancelLoyaltyPointsTransaction->cancel_reason;
            $loyaltyPointsTransaction->save();

        } catch (\Throwable $exception) {
            Log::critical('Failed to cancel LoyaltyPointsTransaction', [
                'exception' => $exception,
            ]);

            throw $exception;
        }

        Log::debug(sprintf('Finish %s service.', __CLASS__));

        return $loyaltyPointsTransaction;
    }
}
