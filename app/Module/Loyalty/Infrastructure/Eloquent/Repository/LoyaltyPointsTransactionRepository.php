<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Infrastructure\Eloquent\Repository;

use App\Module\Loyalty\Infrastructure\Eloquent\Model\LoyaltyPointsTransaction;

class LoyaltyPointsTransactionRepository implements \App\Module\Loyalty\Domain\Api\LoyaltyPointsTransactionFinder
{
    /**
     * @param int $id
     * @return LoyaltyPointsTransaction|null
     */
    public function getById(
        int $id,
    ): ?LoyaltyPointsTransaction
    {
        return LoyaltyPointsTransaction::where('id', '=', $id)->first();
    }
}
