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
                // retrieve item from the cache or store it forever if it does not exist
                return $this->rememberForever($key, fn() => ($model)::all())->pluck('name', 'id')->toArray();
            }
        );
    }
}
