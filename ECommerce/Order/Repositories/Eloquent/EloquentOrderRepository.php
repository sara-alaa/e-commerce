<?php

namespace ECommerce\Order\Repositories\Eloquent;

use ECommerce\Order\Order;
use ECommerce\Order\Repositories\Contracts\OrderRepositoryInterface;

class EloquentOrderRepository implements OrderRepositoryInterface
{

    public function create($attributes)
    {
        return Order::query()->create($attributes);
    }
}
