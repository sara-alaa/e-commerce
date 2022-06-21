<?php

namespace ECommerce\Product\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function create(array $attributes);
    public function show(int $id);
    public function update(int $id, array $attributes);
    public function findOrFail(int $id);
}
