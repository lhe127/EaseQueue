<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsStaff
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->is_admin) {
            return $next($request);
        }

        return redirect('/no-access'); // Redirect to admin home if not staff
    }
}