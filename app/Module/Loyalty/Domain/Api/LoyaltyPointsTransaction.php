<?php

namespace App\Module\Loyalty\Domain\Api;

interface LoyaltyPointsTransaction
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @reference
     * @return LoyaltyAccount
     */
    public function getAccount(): LoyaltyAccount;

    /**
     * @return int
     */
    public function getPointsAmount(): int;

    /**
     * @return bool
     */
    public function isCanceled(): bool;
}
