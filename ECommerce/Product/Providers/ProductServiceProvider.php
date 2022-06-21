<?php

namespace ECommerce\Product\Providers;

use ECommerce\Product\Repositories\Contracts\ProductRepositoryInterface;
use ECommerce\Product\Repositories\Eloquent\EloquentProductRepository;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ProductRepositoryInterface::class, function () {
            return new EloquentProductRepository();
        });
    }

    public function boot()
    {
    }
}
