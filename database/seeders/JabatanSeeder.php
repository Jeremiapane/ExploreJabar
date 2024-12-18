<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatans')->insert([
            ['nama' => 'Kepala Dinas'],
            ['nama' => 'Kasubag TU'],
            ['nama' => 'Kepala Bidang Industri Pariwisata'],
            ['nama' => 'Staf Humas'],
            ['nama' => 'Staf Industri Pariwisata'],
        ]);
    }
}
