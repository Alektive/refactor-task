<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Network\Http\Api;

final class NwkLoyaltyPointsTransactionCancel
{
    /**
     * @param int $transaction_id
     * @param string $cancellation_reason
     */
    public function __construct(
        public int    $transaction_id,
        public string $cancellation_reason,
    )
    {
    }
}
