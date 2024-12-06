<?php

namespace App\Providers;

use App\Models\contact;
use Illuminate\Support\Facades\View;
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
        //
        $newRequestsCount = Contact::where('status', 'Pending')->count();
        View::share('newRequestsCount', $newRequestsCount);
    }
}
