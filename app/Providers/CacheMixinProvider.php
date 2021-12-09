<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CacheMixinProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Cache::macro('getOrSet',
            function (string $key, string $model) {
                return $this->rememberForever($key, fn() => ($model)::all())->pluck('name', 'id')->toArray();
            }
        );
    }
}
