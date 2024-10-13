<?php

namespace App\Module\Loyalty\Domain\Api;

interface LoyaltyPointsTransactionFinder
{
    /**
     * @param int $id
     * @return LoyaltyPointsTransaction|null
     */
    public function getById(
        int $id,
    ): ?LoyaltyPointsTransaction;
}
