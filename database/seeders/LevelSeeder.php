<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            ['description' => 'admin'],
            ['description' => 'manajer operasional'],
            ['description' => 'staff operasional'],
            ['description' => 'manager marketing'],
            ['description' => 'staff marketing'],
            ['description' => 'staff penjualan'],
            ['description' => 'pemandu wisata'],
            ['description' => 'wisatawan'],
        ];

        DB::table('level')->insert($levels);
    }
}
