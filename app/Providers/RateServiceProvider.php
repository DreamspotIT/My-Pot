<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class RateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $gold = Category::where('name', 'Gold')->first();
            $silver = Category::where('name', 'Silver')->first();

            $view->with('goldRate', $gold->rate_per_gram ?? null);
            $view->with('goldDate', $gold->rate_date ?? null);
            $view->with('silverRate', $silver->rate_per_gram ?? null);
            $view->with('silverDate', $silver->rate_date ?? null);
        });
    }

    public function register()
    {
        //
    }
}
