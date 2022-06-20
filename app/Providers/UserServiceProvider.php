<?php

namespace App\Providers;

use App\Services\User\Services\Company;
use App\Services\User\Services\CompanyService;
use App\Services\User\Services\User;
use App\Services\User\UserService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->singleton(UserService::class, function(){
            return new User(
                $this->app->make(CompanyService::class)
            );
        });

        $this->app->singleton(CompanyService::class, function(){
            return new Company();
        });
    }

    public function provides()
    {
        return [UserService::class];
    }
}
