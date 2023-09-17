<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RyanChandler\FilamentUserResource\Resources\UserResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // UserResource::enablePasswordUpdates(function (): bool {
        //     return auth()->user()->email === "harikrushna@enstead.com";
        // });
        if(config('app.env') === 'production') {
            \URL::forceScheme('https');
        }
    }
}
