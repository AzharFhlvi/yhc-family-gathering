<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Family;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run(): void
    {
        // insert from all employee
        $employees = Employee::all();
        foreach ($employees as $employee) {
            DB::table('attendances')->insert([
                'attendant_id' => $employee->id,
                'attendant_type' => 'App\Models\Employee',
                'status' => 'unchecked',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // insert from all family
        $families = Family::all();
        foreach ($families as $family) {
            DB::table('attendances')->insert([
                'attendant_id' => $family->id,
                'attendant_type' => 'App\Models\Family',
                'status' => 'unchecked',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
