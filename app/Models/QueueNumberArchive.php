<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueNumberArchive extends Model
{
    use HasFactory;

    // Define the table name if it does not follow Laravel's naming convention
    protected $table = 'queue_numbers_archive';

    // Define the fillable fields
    protected $fillable = [
        'department_id',
        'counter_id',
        'staffID',
        'queue_number',
        'is_served',
        'customer_id',
        'service_start_time',
        'service_end_time',
        'status',
        'processing_status',
    ];
}
