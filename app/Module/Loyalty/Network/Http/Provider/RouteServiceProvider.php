<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Network\Http\Provider;

use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends \App\Providers\RouteServiceProvider
{
    /**
     * Автозагрузка всех маршрутов (routes) для текущего модуля.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->routes(function () {
            foreach (module_route_files('Loyalty') as $filepath) {
                Route::middleware(basename($filepath, '.php'))
                    ->group($filepath);
            }
        });
    }
}
