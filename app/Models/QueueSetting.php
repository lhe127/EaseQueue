<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueSetting extends Model
{
    use HasFactory;
    protected $fillable = ['queue_limit','limit_of_call','notification_time','open_time_from','open_time_to'];
    
}
