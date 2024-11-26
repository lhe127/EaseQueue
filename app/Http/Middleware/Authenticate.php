<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    // Redirect to the desired login page when authentication fails.
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login'); // Replace 'login' with your desired route name
        }
    }
}