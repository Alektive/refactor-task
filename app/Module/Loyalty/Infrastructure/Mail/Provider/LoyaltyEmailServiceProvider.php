<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Infrastructure\Mail\Provider;

use Illuminate\Support\ServiceProvider;

class LoyaltyEmailServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(
            \App\Module\Loyalty\Domain\Api\NotifyEmailPerformPaymentLoyaltyPoints::class,
            \App\Module\Loyalty\Infrastructure\Mail\Service\NotifyEmailPerformPaymentLoyaltyPoints::class,
        );
    }
}
