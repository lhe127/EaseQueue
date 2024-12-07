<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueNumber extends Model
{
    use HasFactory;
    protected $fillable = ['department_id', 'counter_id', 'queue_number', 'is_served', 'customer_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function counter()
    {
        return $this->belongsTo(Counter::class);
    }
}
