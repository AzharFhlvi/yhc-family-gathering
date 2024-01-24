<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;
use App\Models\Family;
use App\Models\Unit;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'name',
        'height',
        'position',
    ];    

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function getUnitNameAttribute()
    {
        return $this->unit->name;
    }

    public function families()
    {
        return $this->hasMany(Family::class);
    }

    public function attendances()
    {
        return $this->morphMany(Attendance::class, 'attendant');
    }
}
