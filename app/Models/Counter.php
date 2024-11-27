<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;
    protected $fillable = ['name','department_id'];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function staff(){
        return $this->hasOne(Staff::class);
    }

    public function queueNumbers()
    {
        return $this->hasMany(QueueNumber::class);
    }
}
