<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // Determine the guard from route middleware
            $guard = $this->getGuardFromRoute($request);

            // Redirect based on the guard
            return match ($guard) {
                'customer' => route('customerLogin.page'),
                default => route('login'),
            };
        }
    }

    /**
     * Get the guard being used from the route middleware.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    private function getGuardFromRoute($request)
    {
        foreach ($request->route()->middleware() as $middleware) {
            if (str_starts_with($middleware, 'auth:')) {
                return explode(':', $middleware)[1]; // Extract guard name
            }
        }

        return null;
    }
}