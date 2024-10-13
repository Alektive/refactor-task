<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Network\Http\Mapper;

use App\Module\Loyalty\Domain\Api\RawWithdrawLoyaltyPoints;
use App\Module\Loyalty\Network\Http\Api\NwkLoyaltyPointsTransactionWithdraw;

class RawWithdrawLoyaltyPointsMapper
{
    public function fromNwkLoyaltyPointsTransactionWithdraw(
        NwkLoyaltyPointsTransactionWithdraw $nwkLoyaltyPointsTransactionWithdraw,
    ): RawWithdrawLoyaltyPoints
    {
        return new RawWithdrawLoyaltyPoints(
            points_amount: $nwkLoyaltyPointsTransactionWithdraw->points_amount,
            description: $nwkLoyaltyPointsTransactionWithdraw->description,
        );
    }
}
