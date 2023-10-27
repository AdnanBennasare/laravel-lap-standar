<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\pagination\paginator;
use App\Repositories\TypeHandicapRepository;
use App\Repositories\TypeHandicapRepositoryInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(TypeHandicapRepositoryInterface::class, TypeHandicapRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        paginator::useBootstrap();
    }
}


