<?php

namespace App\Http\Controllers;

use App\Models\QueueSetting;
use Illuminate\Http\Request;

class QueueSettingController extends Controller
{
    //
    public function show()
    {
        $queueSetting = QueueSetting::first();
        return view('Admin.Setting.settingQueue', compact('queueSetting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'queue_limit' => 'required|integer|min:0',
            'limit_of_call' => 'required|integer|min:5',
            'notification_hour' => 'required|integer|between:0,23',
            'notification_minute' => 'required|integer|between:0,55',
            'open_hour_from' => 'required|integer|between:0,23',
            'open_minute_from' => 'required|integer|between:0,55',
            'open_hour_to' => 'required|integer|between:0,23',
            'open_minute_to' => 'required|integer|between:0,55',
        ]);

        QueueSetting::updateOrCreate(
            ['id' => 1],
            [
                'queue_limit' => $request->input('queue_limit'),
                'limit_of_call' => $request->input('limit_of_call'),
                'notification_time' => $request->input('notification_hour') . ':' . str_pad($request->input('notification_minute'), 2, '0', STR_PAD_LEFT),
                'open_time_from' => $request->input('open_hour_from') . ':' . str_pad($request->input('open_minute_from'), 2, '0', STR_PAD_LEFT),
                'open_time_to' => $request->input('open_hour_to') . ':' . str_pad($request->input('open_minute_to'), 2, '0', STR_PAD_LEFT),
            ]
        );


        return redirect()->route('adminSetQueue');
    }
}
