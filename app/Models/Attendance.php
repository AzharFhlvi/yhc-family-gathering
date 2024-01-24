<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendant_id',
        'attendant_type',
        'status',
    ];

    public function attendant()
    {
        return $this->morphTo();
    }

    public function scopeEmployee($query)
    {
        return $query->where('attendant_type', 'employee');
    }

    public function scopeFamily($query)
    {
        return $query->where('attendant_type', 'family');
    }
}
