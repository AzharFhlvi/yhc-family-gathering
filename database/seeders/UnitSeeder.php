<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run(): void
    {
        $units = [
            'PENGURUS YHC',
            'PIMPINAN YHC',
            'BIDANG SOSIAL, KEAGAMAAN DAN KEPEMUDAAN',
            'Business & Communication Training Institute (BCTI)',
            'DIGITALIZ',
            'HAFECS',
            'HRP',
            'WETLAND BOX',
            'WETLAND SQUARE',
            'KB-TKIT An-Nur',
            'SDIT An-Nur',
            'SMPIT An-Nur',
            'PT. Pengembangan Inovasi Pengajaran',
            'PT. Cipta Daya Inovasi',
            'SEKRETARIAT YHC',
            'Kediamaan Bapak Zulfikar & Ibu NIla',
            'POLHAS',
            'SMP-SMA GIBS',
        ];

        // Insert units without parent_id
        foreach ($units as $unit) {
            DB::table('units')->insert([
                'name' => $unit,
            ]);
        }
    }
}
