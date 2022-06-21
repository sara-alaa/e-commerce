<?php

namespace ECommerce\Store\Providers;

use ECommerce\Store\Repositories\Contracts\StoreRepositoryInterface;
use ECommerce\Store\Repositories\Eloquent\EloquentStoreRepository;
use Illuminate\Support\ServiceProvider;

class StoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(StoreRepositoryInterface::class, function () {
            return new EloquentStoreRepository();
        });
    }

    public function boot()
    {
    }
}
