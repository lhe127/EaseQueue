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

        View::composer('*', function ($view) {
            if (auth()->check() && auth()->user() instanceof \App\Models\Staff) {
                $staff = \App\Models\Staff::find(auth()->id());
                $lastViewedAt = $staff->viewed_at;
                $newNotificationsCount = \App\Models\Contact::where('staffID', auth()->id())
                    ->where('updated_at', '>', $lastViewedAt ?? now()->subDays(30))
                    ->whereIn('status', ['approved', 'rejected'])
                    ->count();
                $view->with('newNotificationsCount', $newNotificationsCount);
            }
        });
    }
}
