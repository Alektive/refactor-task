<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Domain\Api;

class RawWithdrawLoyaltyPoints
{
    /**
     * @param int $points_amount
     * @param string $description
     */
    public function __construct(
        public int    $points_amount,
        public string $description,
    )
    {
    }
}
