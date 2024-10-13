<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Infrastructure\Sms\Provider;

use Illuminate\Support\ServiceProvider;

final class LoyaltySmsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(
            \App\Module\Loyalty\Domain\Api\NotifySmsPerformPaymentLoyaltyPoints::class,
            \App\Module\Loyalty\Infrastructure\Sms\Service\NotifySmsPerformPaymentLoyaltyPoints::class,
        );
    }
}
