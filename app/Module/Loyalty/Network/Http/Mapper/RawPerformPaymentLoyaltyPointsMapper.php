<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Network\Http\Mapper;

use App\Module\Loyalty\Domain\Api\RawPerformPaymentLoyaltyPoints;
use App\Module\Loyalty\Network\Http\Api\NwkLoyaltyPointsTransactionDeposit;

/**
 * @internal
 */
final class RawPerformPaymentLoyaltyPointsMapper
{
    /**
     * @param NwkLoyaltyPointsTransactionDeposit $nwkLoyaltyPointsTransactionDeposit
     * @return RawPerformPaymentLoyaltyPoints
     */
    public function fromNwkLoyaltyPointsTransactionDeposit(
        NwkLoyaltyPointsTransactionDeposit $nwkLoyaltyPointsTransactionDeposit,
    ): RawPerformPaymentLoyaltyPoints
    {
        return new RawPerformPaymentLoyaltyPoints(
            loyalty_points_rule: $nwkLoyaltyPointsTransactionDeposit->loyalty_points_rule,
            description: $nwkLoyaltyPointsTransactionDeposit->description,
            payment_id: $nwkLoyaltyPointsTransactionDeposit->payment_id,
            payment_amount: $nwkLoyaltyPointsTransactionDeposit->payment_amount,
            payment_time: $nwkLoyaltyPointsTransactionDeposit->payment_time,
        );
    }
}
