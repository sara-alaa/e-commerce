<?php

namespace ECommerce\Order\Repositories\Contracts;

interface OrderRepositoryInterface
{
    public function create(array $attributes);
}
