<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'name',
        'height',
        'relation',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function getEmployeeNameAttribute()
    {
        return $this->employee->name;
    }

    public function attendances()
    {
        return $this->morphMany(Attendance::class, 'attendant');
    }

    public function attendance()
    {
        return $this->morphOne(Attendance::class, 'attendant');
    }
}
