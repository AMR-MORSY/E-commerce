<?php

namespace App\Providers;

use App\Models\Product;
use App\Events\OrderPlaced;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use App\Listeners\SendOrderDetailsEmail;


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
         Product::observe(ProductObserver::class);
        

        
        Event::listen(
            OrderPlaced::class,
            SendOrderDetailsEmail::class
        );
    }
}
