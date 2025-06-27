<?php

namespace App\Providers;

use App\Repositories\RoleRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\RoleRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
