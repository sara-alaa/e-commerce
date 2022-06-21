<?php

namespace ECommerce\Order\Library;

use App\Enums\OrderStatus;
use ECommerce\Order\OrderDetails;
use ECommerce\Order\Repositories\Contracts\OrderRepositoryInterface;
use ECommerce\Order\Support\Validation\OrderValidator;
use ECommerce\Product\Repositories\Contracts\ProductRepositoryInterface;
use ECommerce\Store\Repositories\Contracts\StoreRepositoryInterface;

class OrderLibrary
{
    public $orderRepository;
    public $orderValidator;
    public $productRepository;
    public $storeRepository;

    public function __construct(OrderRepositoryInterface $orderRepository,
                                OrderValidator $orderValidator,
                                ProductRepositoryInterface $productRepository,
                                StoreRepositoryInterface $storeRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderValidator = $orderValidator;
        $this->productRepository = $productRepository;
        $this->storeRepository = $storeRepository;
    }

    public function store($attributes)
    {
        $attributes = $this->formatAndValidateAttributes($attributes);
        $products = $attributes['products'];
        $priceDetails = $this->calculateProductsPrice($products);
        $data = array();
        $data['user_id'] = auth()->id();
        $data['total'] = $priceDetails['total'];
        $data['subtotal'] = $priceDetails['subtotal'];
        $order = $this->orderRepository->create($data);
        $order->setStatus(OrderStatus::PLACED);
        $this->insertOrderDetails($products, $order);
        return $order;
    }

    protected function formatAndValidateAttributes($attributes)
    {
        $this->orderValidator->validate($attributes);
        return $attributes;
    }

    protected function calculateProductsPrice($products)
    {
        $subtotal = 0;
        $vats = 0;
        $storeIds  = array();
        foreach($products as $product) {
            $productModel = $this->productRepository->findOrFail($product['id']);
            $price = $productModel->price * $product['quantity'];
            $subtotal += $price;
            array_push($storeIds, $productModel->store_id);
            $vats += $this->calculateVats($productModel->store, $price);
        }
        $shippingCost = $this->calculateShippingCost(array_unique($storeIds));
        $total = $subtotal + $shippingCost + $vats;
        return [
            'subtotal' => $subtotal,
            'total' => $total
        ];
    }

    protected function calculateShippingCost($storeIds)
    {
        $shippingCost = $this->storeRepository
                        ->getStoresByIds($storeIds)
                        ->pluck('shipping_cost')
                        ->sum();
        return $shippingCost;
    }

    protected function calculateVats($store, $price)
    {
        $vats = 0;
        if (!$store->vat_included) {
            $vats +=($price * 14) /100;
        }
        return $vats;
    }

    protected function getSingleProductPrice($productId, $quantity)
    {
        $product = $this->productRepository->findOrFail($productId);
        return $product->price * $quantity;
    }

    protected function insertOrderDetails($products, $order)
    {
        $orderDetails = array();
        foreach ($products as $index => $product) {
            $productId = $product['id'];
            $quantity = $product['quantity'];
            $price = $this->getSingleProductPrice($productId, $quantity);
            $orderDetails[$index] = new OrderDetails([
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $price
            ]);
        }
        $order->ordersDetails()->saveMany($orderDetails);
    }
}
