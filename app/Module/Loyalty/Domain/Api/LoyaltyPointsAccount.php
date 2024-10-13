<?php

namespace App\Module\Loyalty\Domain\Api;

interface LoyaltyPointsAccount
{
    /** @var string[] */
    public const ALLOWED_TYPES = [
        self::TYPE_CARD,
        self::TYPE_EMAIL,
        self::TYPE_PHONE,
    ];

    /** @var string */
    public const TYPE_CARD = 'card';

    /** @var string */
    public const TYPE_EMAIL = 'email';

    /** @var string */
    public const TYPE_PHONE = 'phone';
}
