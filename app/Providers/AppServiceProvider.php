<?php

namespace App\Providers;

use App\Repositories\UserRepository\EloquentUserRepository;
use App\Repositories\UserRepository\UserRepositoryInterface;
use App\Services\IpstackService;
use App\Services\OpenWeatherService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);

        $this->app->singleton('OpenWeatherService', function ($app) {
            return new OpenWeatherService(env('OPEN_WEATHER_API_KEY'));
        });

        $this->app->singleton('IpstackService', function ($app) {
            return new IpstackService(env('IPSTACK_API_KEY'));
        });
    }
}
