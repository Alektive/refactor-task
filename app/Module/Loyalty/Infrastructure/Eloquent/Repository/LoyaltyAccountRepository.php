<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Infrastructure\Eloquent\Repository;

use App\Module\Loyalty\Infrastructure\Eloquent\Model\LoyaltyAccount;

class LoyaltyAccountRepository implements \App\Module\Loyalty\Domain\Api\LoyaltyAccountFinder
{
    public function getById(
        int $id,
    ): ?LoyaltyAccount
    {
        return LoyaltyAccount::where('id', '=', $id)->first();
    }
}
