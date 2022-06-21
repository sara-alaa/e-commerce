<?php

namespace ECommerce\Store;

use App\Models\User;
use ECommerce\Product\Product;
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

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
