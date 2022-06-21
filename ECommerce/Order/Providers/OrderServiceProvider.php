<?php

namespace ECommerce\Order\Providers;

use ECommerce\Order\Repositories\Contracts\OrderRepositoryInterface;
use ECommerce\Order\Repositories\Eloquent\EloquentOrderRepository;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(OrderRepositoryInterface::class, function () {
            return new EloquentOrderRepository();
        });
    }

    public function boot()
    {
        Relation::morphMap([
            'order' => 'ECommerce\Order\Order',
            'order_details' => 'ECommerce\Order\OrderDetails'
        ]);
    }
}
