<?php

namespace ECommerce\Store;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'vat_included',
        'shipping_cost',
        'user_id',
    ];
}
