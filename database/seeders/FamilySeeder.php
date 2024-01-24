<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run(): void
    {
        // insert family on employee that id is 3
        DB::table('families')->insert([
            'employee_id' => 3,
            'name' => 'Taufik Hidayat',
            'height' => 100,
            'relation' => 'pasangan',
        ]);
        DB::table('families')->insert([
            'employee_id' => 3,
            'name' => 'Nadia Zahira',
            'height' => 80,
            'relation' => 'pasangan',
        ]);
    }
}
