<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'order_max_quantity' => $this->order_max_quantity,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'stock_quantity' => $this->stock_quantity,
            'store' => new StoreResource($this->store)
        ];
    }
}
