<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave_category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title'
    ];

    public function leave()
    {
        return $this->hasMany(Leave::class);
    }
}
