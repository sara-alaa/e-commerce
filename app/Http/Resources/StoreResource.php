<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'vat_included' => $this->vat_included,
            'shipping_cost' => $this->shipping_cost,
        ];
    }
}