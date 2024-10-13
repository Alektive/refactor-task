<?php

declare(strict_types=1);

namespace App\Module\Loyalty\UseCase\Service;

use App\Module\Loyalty\Domain\Api\LoyaltyPointsTransaction;

class CancelLoyaltyPointsTransaction implements \App\Module\Loyalty\UseCase\Api\CancelLoyaltyPointsTransaction
{
    /**
     * @param LoyaltyPointsTransaction $loyaltyPointsTransaction
     * @return LoyaltyPointsTransaction
     */
    public function do(
        LoyaltyPointsTransaction $loyaltyPointsTransaction,
    ): LoyaltyPointsTransaction
    {
        return $loyaltyPointsTransaction;
    }
}
