<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift_assign extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'shift_id',
        'month',
        'weekend'
    ];

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
