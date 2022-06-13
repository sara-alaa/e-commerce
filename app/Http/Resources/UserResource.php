<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'role' => $this->whenLoaded('roles', function () {
                return $this->roles->first()->name;
            }),
            'email' => $this->email,
        ];
    }
}