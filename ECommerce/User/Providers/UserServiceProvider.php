<?php

namespace ECommerce\User\Providers;

use ECommerce\User\Repositories\Contracts\UserRepositoryInterface;
use ECommerce\User\Repositories\Eloquent\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserRepositoryInterface::class, function () {
            return new EloquentUserRepository();
        });
    }

    public function boot()
    {
    }
}
