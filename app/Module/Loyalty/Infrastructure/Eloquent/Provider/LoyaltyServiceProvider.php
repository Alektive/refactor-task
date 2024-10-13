<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Infrastructure\Eloquent\Provider;

use Illuminate\Support\ServiceProvider;

class LoyaltyServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->app->bind(
            \App\Module\Loyalty\Domain\Api\LoyaltyAccountFinder::class,
            \App\Module\Loyalty\Infrastructure\Eloquent\Repository\LoyaltyAccountRepository::class,
        );
        $this->app->bind(
            \App\Module\Loyalty\Domain\Api\LoyaltyPointsTransactionFinder::class,
            \App\Module\Loyalty\Infrastructure\Eloquent\Repository\LoyaltyPointsTransactionRepository::class,
        );
        $this->app->bind(
            \App\Module\Loyalty\Domain\Api\CancelLoyaltyPointsTransaction::class,
            \App\Module\Loyalty\Infrastructure\Eloquent\Service\CancelLoyaltyPointsTransaction::class,
        );
        $this->app->bind(
            \App\Module\Loyalty\Domain\Api\DepositLoyaltyPointsAccount::class,
            \App\Module\Loyalty\Infrastructure\Eloquent\Service\DepositLoyaltyPointsAccount::class,
        );
        $this->app->bind(
            \App\Module\Loyalty\Domain\Api\WithdrawLoyaltyPointsAccount::class,
            \App\Module\Loyalty\Infrastructure\Eloquent\Service\WithdrawLoyaltyPointsAccount::class,
        );
    }
}
