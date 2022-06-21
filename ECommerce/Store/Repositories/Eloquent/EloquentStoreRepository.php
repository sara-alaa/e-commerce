<?php

namespace ECommerce\Store\Repositories\Eloquent;

use ECommerce\Store\Repositories\Contracts\StoreRepositoryInterface;
use ECommerce\Store\Store;

class EloquentStoreRepository implements StoreRepositoryInterface
{

    public function create($attributes)
    {
        return Store::query()->create($attributes);
    }

    public function show($id)
    {
        return Store::findOrFail($id);
    }

    public function update($id, $attributes)
    {
        $store = Store::query()->findOrFail($id);
        $store->fill($attributes)->save();
        return $store;
    }
}
