<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Network\Http\Api;

final class NwkLoyaltyPointsTransactionWithdraw
{
    /**
     * Nwk DTO constructor.
     *
     * @param int $account_id
     * @param string $account_type
     * @param string $description
     * @param int $points_amount
     */
    public function __construct(
        public int    $account_id,
        public string $account_type,
        public string $description,
        public int    $points_amount,
    )
    {
    }
}
