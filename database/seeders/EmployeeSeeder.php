<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run(): void
    {
        $employees = [
            // PENGURUS YHC
            [1, 'Nila Susanti', 'Ketua Umum'],
            [1, 'Syamsuridzal', 'Ketua'],
            [1, 'Nina Richi Tresy Putri', 'Sekretaris Umum'],
            [1, 'Yani Hadiyani', 'Bendahara'],

            // PIMPINAN YHC
            [2, 'Dr. Zulfikar Alimuddin', 'Direktur Eksekutif'],
            [2, 'Prof Sutarto Hadi', 'Director of Partnership'],
            [2, 'Hairansyah, SH MH', 'Direktor of Relationship & Dev'],

            // BIDANG SOSIAL, KEAGAMAAN DAN KEPEMUDAAN
            [3, 'Ardi Setiawan', 'Koordinator Program Sosial & Keagamaan'],
        ];

        foreach ($employees as $employee) {
            DB::table('employees')->insert([
                'unit_id' => $employee[0],
                'name' => $employee[1],
                'position' => $employee[2],
                'height' => 100,
            ]);
        }
    }
}
