<?php

namespace App\Http\Controllers\Api\Store;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use ECommerce\Product\Library\ProductLibrary;
use ECommerce\Product\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productLibrary;

    public function __construct(
        ProductLibrary $productLibrary
    )
    {
        $this->authorizeResource(Product::class, 'product', ['except'=>['show']]);
        $this->productLibrary = $productLibrary;
    }

    public function store(Request $request)
    {
        $product = $this->productLibrary->store($request->all());
        return response()->json(new ProductResource($product));
    }

    public function update(Product $product, Request $request)
    {
        $product = $this->productLibrary->update($product->id, $request->all());
        return response()->json(new ProductResource($product));
    }

    public function show(Product $product)
    {
        $product = $this->productLibrary->show($product->id);
        return response()->json(new ProductResource($product));
    }
}
