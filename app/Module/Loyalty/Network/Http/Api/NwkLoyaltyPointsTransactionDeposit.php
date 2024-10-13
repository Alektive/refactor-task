<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Network\Http\Api;

final class NwkLoyaltyPointsTransactionDeposit
{
    /**
     * @param int $account_id
     * @param string $account_type
     * @param int   $loyalty_points_rule
     * @param string $description
     * @param int $payment_id
     * @param float $payment_amount
     * @param int $payment_time
     */
    public function __construct(
        public int    $account_id,
        public string $account_type,
        public int    $loyalty_points_rule,
        public string $description,
        public int    $payment_id,
        public float  $payment_amount,
        public int    $payment_time,
    )
    {
    }
}
