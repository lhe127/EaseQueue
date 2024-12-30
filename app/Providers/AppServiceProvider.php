<?php

namespace App\Providers;

use App\Models\Contact;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
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

        URL::forceScheme('https');
    
        $newRequestsCount = Contact::where('status', 'Pending')->count();
        View::share('newRequestsCount', $newRequestsCount);

        View::composer('*', function ($view) {
            // Check if the user is authenticated and is an instance of Staff
            if (auth()->check() && auth()->user() instanceof \App\Models\Staff) {
                // Retrieve the authenticated staff user
                $staff = \App\Models\Staff::find(auth()->id());

                // Check if the staff exists before accessing properties like 'viewed_at'
                if ($staff) {

                    $staffPhoto = $staff->photo ?? 'default.jpg'; // Default image if no photo is set
                    $view->with('staffPhoto', $staffPhoto);

                    // Get the last viewed timestamp, defaulting to now() if not set
                    $lastViewedAt = $staff->viewed_at ?? now()->subDays(30);

                    // Count new notifications based on the last viewed time and the condition on 'status'
                    $newNotificationsCount = \App\Models\Contact::where('staffID', auth()->id())
                        ->where('updated_at', '>', $lastViewedAt)
                        ->whereIn('status', ['approved', 'rejected'])
                        ->count();

                    // Pass the count of new notifications to the view
                    $view->with('newNotificationsCount', $newNotificationsCount);
                }
            }
        });
    }
}
