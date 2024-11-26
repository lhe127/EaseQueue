<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckQueueOpenHours
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
        $queueSetting = DB::table('queue_settings')->first();
        if($queueSetting) {
            $openTimeFrom = Carbon::createFromFormat('H:i',$queueSetting->open_time_from);
            $openTimeTo = Carbon::createFromFormat('H:i',$queueSetting->open_time_to);
            $currentTime = Carbon::now();

            if(!$currentTime->between($openTimeFrom, $openTimeTo)) {
                session(['queue_closed' => true]);
            }
        }

        return $next($request);
    }
}
