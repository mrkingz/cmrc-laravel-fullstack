<?php

namespace App\Providers;

// use App\Http\Classes\VerificationCode;
use Illuminate\Support\ServiceProvider;
use App\Http\Classes\ChangePasswordToken;

class ChangePasswordServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
     protected $defer = true;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ChangePasswordToken::class, function ($app) {
            return new ChangePasswordToken($app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ChangePasswordToken::class];
    }
}
