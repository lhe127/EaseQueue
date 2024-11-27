<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['name','description'];

    public function counter(){
        return $this->hasMany(Counter::class);
    }

    public function staff(){
        return $this->hasMany(Staff::class);
    }

    public function queueNumbers()
    {
        return $this->hasMany(QueueNumber::class);
    }
}
