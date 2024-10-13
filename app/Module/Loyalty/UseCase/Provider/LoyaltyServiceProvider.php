<?php

declare(strict_types=1);

namespace App\Module\Loyalty\UseCase\Provider;

use Illuminate\Support\ServiceProvider;

class LoyaltyServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(
            \App\Module\Loyalty\UseCase\Api\CancelLoyaltyPointsTransaction::class,
            \App\Module\Loyalty\UseCase\Service\CancelLoyaltyPointsTransaction::class,
        );
    }
}
