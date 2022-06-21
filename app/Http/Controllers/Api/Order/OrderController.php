<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use ECommerce\Order\Library\OrderLibrary;
use ECommerce\Order\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderLibrary;

    public function __construct(
        OrderLibrary $orderLibrary
    )
    {
        $this->authorizeResource(Order::class, 'order');
        $this->orderLibrary = $orderLibrary;
    }

    public function store(Request $request)
    {
        $order = $this->orderLibrary->store($request->all());
        return response()->json(['message' => 'Order has been placed successfully.']);
    }
}
