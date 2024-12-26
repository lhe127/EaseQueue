<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class Staff extends Authenticatable
{
    use HasFactory;
    protected $table = 'staff';
    protected $fillable = ['staffID','name','email','password','department_id','counter_id','status', 'is_admin', 'viewed_at'];
    protected $primaryKey = 'staffID';
    protected $keyType = 'string';

    protected $hidden = [
        'password', 'remember_token', // Ensure sensitive fields are hidden
    ];
    
    public function department(){
        return $this->belongsTo(Department::class,'department_id', 'id');
    }

    public function counter(){
        return $this->belongsTo(Counter::class, 'counter_id', 'id');
    }
}
