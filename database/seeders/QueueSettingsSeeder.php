<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QueueSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('queue_settings')->insert([
            'queue_limit' => 100, 
            'limit_of_call' => 3, 
            'notification_time' => '08:00', 
            'open_time_from' => '08:00', 
            'open_time_to' => '18:00', 
            'created_at' => now(), 
            'updated_at' => now(),
        ]);
    }
}
