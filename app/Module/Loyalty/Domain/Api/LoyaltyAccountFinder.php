<?php

namespace App\Module\Loyalty\Domain\Api;

interface LoyaltyAccountFinder
{
    /**
     * @param int $id
     * @return LoyaltyAccount|null
     */
    public function getById(
        int $id,
    ): ?LoyaltyAccount;
}
