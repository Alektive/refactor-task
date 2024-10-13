<?php

return [
    App\Module\Loyalty\Network\Http\Provider\RouteServiceProvider::class,
    App\Module\Loyalty\Infrastructure\Eloquent\Provider\LoyaltyServiceProvider::class,
    App\Module\Loyalty\Infrastructure\Mail\Provider\LoyaltyEmailServiceProvider::class,
    App\Module\Loyalty\Infrastructure\Sms\Provider\LoyaltySmsServiceProvider::class,
    App\Module\Loyalty\UseCase\Provider\LoyaltyServiceProvider::class,
];
