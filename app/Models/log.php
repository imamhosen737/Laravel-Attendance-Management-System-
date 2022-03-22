<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'punch_time',
        'device_id',
        'type'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
