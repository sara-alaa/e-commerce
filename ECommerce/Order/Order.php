<?php

namespace ECommerce\Order;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;

class Order extends Model
{
    use HasStatuses;

    protected $fillable = [
        'subtotal',
        'total',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ordersDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }
}
