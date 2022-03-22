<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_id',
        'name',
        'email',
        'phone',
        'address',
        'photo',
        'designation',
        'department'
    ];

    public function log()
    {
        return $this->hasMany(log::class);
    }
    public function shift_assign()
    {
        return $this->hasMany(Shift_assign::class);
    }
    public function leave()
    {
        return $this->hasMany(Leave::class);
    }
}
