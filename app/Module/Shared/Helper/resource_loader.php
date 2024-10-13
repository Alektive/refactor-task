<?php

if (!function_exists('module_route_files')) {
    /**
     * Возвращает коллекцию файлов с HTTP маршрутами (routes).
     *
     * @param ...$modules
     * @return string[]
     */
    function module_route_files(
        ...$modules,
    ): array
    {
        $routes = [];
        foreach ($modules as $m) {
            if (is_dir(base_path('app/Module/' . $m . '/Resource/routes'))) {
                $routes += glob(base_path('app/Module/' . $m . '/Resource/routes/*.php'));
            }
        }

        return $routes;
    }
}

if (!function_exists('module_providers')) {
    /**
     * Возвращает коллекцию классов-провайдеров для указанного модуля.
     *
     * @param ...$modules
     * @return string[]
     */
    function module_providers(
        ...$modules,
    ): array
    {
        $providers = [];
        foreach ($modules as $m) {
            if (is_file(base_path('app/Module/' . $m . '/Resource/config/providers.php'))) {
                $providers += require base_path('app/Module/' . $m . '/Resource/config/providers.php');
            }
        }

        return $providers;
    }
}
