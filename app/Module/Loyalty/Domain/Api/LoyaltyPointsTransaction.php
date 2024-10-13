<?php

namespace App\Module\Loyalty\Domain\Api;

interface LoyaltyPointsTransaction
{
    /**
     * @return bool
     */
    public function isCanceled(): bool;
}
