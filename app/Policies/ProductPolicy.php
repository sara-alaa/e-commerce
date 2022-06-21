<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;
use ECommerce\Product\Product;
use ECommerce\Store\Store;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function create(User $user)
    {
        $storeId = request('store_id');
        $store = Store::findOrFail($storeId);
        if ($user->roles->first()->name === UserRole::MERCHANT && $store->user_id == $user->id) {
            return true;
        }  
    }

    public function update(User $user, Product $product)
    {
        return $user->id == $product->store->user_id;
    }
}
