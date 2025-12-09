<?php

namespace App\Providers;

use App\Traits\HasCustomIcons;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use HasCustomIcons;
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
        // self::registerIcons();
    }
}
