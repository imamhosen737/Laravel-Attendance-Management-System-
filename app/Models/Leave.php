<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'category_id',
        'date',
        'status'
    ];

    public function leave_category()
    {
        return $this->belongsTo(Leave_category::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
