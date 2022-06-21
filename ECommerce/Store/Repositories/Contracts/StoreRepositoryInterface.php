<?php

namespace ECommerce\Store\Repositories\Contracts;

interface StoreRepositoryInterface
{
    public function create(array $attributes);
    public function show(int $id);
    public function update(int $id, array $attributes);
    public function getStoresByIds(array $ids);
}
