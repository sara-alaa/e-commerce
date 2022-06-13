<?php

namespace ECommerce\User\Repositories\Eloquent;

use App\Models\User;
use Carbon\Carbon;
use ECommerce\User\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository implements UserRepositoryInterface
{

    public function create($attributes)
    {
        $attributes['password'] = Hash::make($attributes['password']);
        $attributes['email_verified_at'] = Carbon::now();
        $user = User::query()->create($attributes);
        $user->assignRole($attributes['role']);
        return $user;
    }
}
