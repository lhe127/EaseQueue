<?php

namespace App\Http\Middleware;

use App\Models\QueueSetting;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class RestrictAccessByTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $queueSetting = QueueSetting::first();
        $openTimeFrom = $queueSetting->open_time_from ?? '08:00';
        $openTimeTo = $queueSetting->open_time_to ?? '17:00';

        // Get current time
        $currentTime = Carbon::now()->format('H:i');

        // Check if current time is within allowed range
        if ($currentTime < $openTimeFrom || $currentTime > $openTimeTo) {
            return response()->view('Customer.closed', compact('openTimeFrom', 'openTimeTo'));
        }

        return $next($request);
    }
}
