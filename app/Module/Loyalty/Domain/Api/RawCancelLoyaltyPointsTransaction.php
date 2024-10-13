<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Domain\Api;

class RawCancelLoyaltyPointsTransaction
{
    /**
     * @param string $cancel_reason
     */
    public function __construct(
        public string $cancel_reason,
    )
    {
    }
}
