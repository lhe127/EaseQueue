<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $fillable = ['staffID','name','password','position','department_id','counter_id','status'];
    protected $primaryKey = 'staffID';
    protected $keyType = 'string';

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function counter(){
        return $this->belongsTo(Counter::class);
    }
}
