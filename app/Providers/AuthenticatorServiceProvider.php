<?php

namespace App\Providers;

use App\Services\Authenticator\AuthenticatorService;
use App\Services\Authenticator\Services\Authenticator;
use App\Services\User\UserService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class AuthenticatorServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->singleton(AuthenticatorService::class, function(){
            return new Authenticator(
                $this->app->make(UserService::class)
            );
        });
    }

    public function provides()
    {
        return [AuthenticatorService::class];
    }
}
