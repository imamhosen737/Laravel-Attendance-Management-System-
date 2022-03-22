<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'in_time',
        'out_time'
    ];
    public function shift_assign()
    {
        return $this->hasMany(Shift_assign::class);
    }
}
