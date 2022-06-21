<?php

namespace ECommerce\Product;

use ECommerce\Store\Store;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'order_max_quantity',
        'price',
        'quantity',
        'stock_quantity',
        'store_id'
    ];

    public $translatable = ['name', 'description'];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
