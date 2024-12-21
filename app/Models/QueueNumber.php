<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueNumber extends Model
{
    use HasFactory;
    protected $fillable = ['department_id', 'counter_id', 'queue_number', 'is_served', 'customer_id','staffID','service_start_time','service_end_time','status','processing_status',];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($queueNumber) {
            if (empty($queueNumber->status)) {
                $queueNumber->status = 'active'; // 设置默认值
            }
        });
    }


    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function counter()
    {
        return $this->belongsTo(Counter::class);
    }
    
    public function staff(){
        return $this->hasOne(Staff::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
