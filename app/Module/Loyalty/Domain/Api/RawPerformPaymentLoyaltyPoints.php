<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Domain\Api;

class RawPerformPaymentLoyaltyPoints
{
    /**
     * @param int $loyalty_points_rule
     * @param string $description
     * @param int $payment_id
     * @param float $payment_amount
     * @param int $payment_time
     */
    public function __construct(
        public int $loyalty_points_rule,
        public string $description,
        public int    $payment_id,
        public float  $payment_amount,
        public int    $payment_time,
    )
    {
    }
}
