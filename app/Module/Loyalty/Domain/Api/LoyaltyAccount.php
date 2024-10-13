<?php

namespace App\Module\Loyalty\Domain\Api;

interface LoyaltyAccount
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

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @virtual
     * @return float
     */
    public function getBalance(): float;

    /**
     * @return bool
     */
    public function isActive(): bool;

    /**
     * @virtual
     * @return bool
     */
    public function canNotifyEmail(): bool;

    /**
     * @virtual
     * @return bool
     */
    public function canNotifySms(): bool;
}
