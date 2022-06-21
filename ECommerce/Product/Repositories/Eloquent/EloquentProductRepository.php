<?php

namespace ECommerce\Product\Repositories\Eloquent;

use ECommerce\Product\Product;
use ECommerce\Product\Repositories\Contracts\ProductRepositoryInterface;

class EloquentProductRepository implements ProductRepositoryInterface
{

    public function create($attributes)
    {
        return Product::query()->create($attributes);
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }

    public function update($id, $attributes)
    {
        $product = Product::query()->findOrFail($id);
        $product->fill($attributes)->save();
        return $product;
    }
}
