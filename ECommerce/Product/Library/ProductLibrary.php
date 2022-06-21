<?php

namespace ECommerce\Product\Library;

use ECommerce\Product\Repositories\Contracts\ProductRepositoryInterface;
use ECommerce\Product\Support\Validation\ProductValidator;

class ProductLibrary
{
    public $productRepository;
    public $productValidator;

    public function __construct(ProductRepositoryInterface $productRepository,
                                ProductValidator $productValidator
    )
    {
        $this->productRepository = $productRepository;
        $this->productValidator = $productValidator;
    }

    public function store($attributes)
    {
        $attributes = $this->formatAndValidateAttributes($attributes);
        $attributes['stock_quantity'] = $attributes['quantity'];
        $product = $this->productRepository->create($attributes);
        return $product;
    }

    public function show($productId)
    {
        return $this->productRepository->show($productId);
    }

    public function update($productId, $attributes)
    {
        $attributes = $this->formatAndValidateUpdateAttributes($attributes, $productId);
        $product = $this->productRepository->update($productId, $attributes);
        return $product;
    }

    protected function formatAndValidateAttributes($attributes)
    {
        $this->productValidator->validate($attributes);
        return $attributes;
    }

    protected function formatAndValidateUpdateAttributes($attributes, $id)
    {
        $this->productValidator->updateValidate($attributes, $id);
        return $attributes;
    }
}
