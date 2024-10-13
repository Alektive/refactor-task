<?php

declare(strict_types=1);

namespace App\Module\Loyalty\UseCase\Service;

use App\Module\Loyalty\Domain\Api\LoyaltyPointsTransaction;
use App\Module\Loyalty\Domain\Api\RawCancelLoyaltyPointsTransaction;

class CancelLoyaltyPointsTransaction implements \App\Module\Loyalty\UseCase\Api\CancelLoyaltyPointsTransaction
{
    public function __construct(
        private \App\Module\Loyalty\Domain\Api\CancelLoyaltyPointsTransaction $cancelLoyaltyPointsTransaction,
    )
    {
    }

    /**
     * @param LoyaltyPointsTransaction $loyaltyPointsTransaction
     * @param RawCancelLoyaltyPointsTransaction $rawCancelLoyaltyPointsTransaction
     * @return LoyaltyPointsTransaction
     * @throws \Throwable
     */
    public function do(
        LoyaltyPointsTransaction          $loyaltyPointsTransaction,
        RawCancelLoyaltyPointsTransaction $rawCancelLoyaltyPointsTransaction,
    ): LoyaltyPointsTransaction
    {
        return $this
            ->cancelLoyaltyPointsTransaction
            ->do(
                loyaltyPointsTransaction: $loyaltyPointsTransaction,
                rawCancelLoyaltyPointsTransaction: $rawCancelLoyaltyPointsTransaction,
            );
    }
}
