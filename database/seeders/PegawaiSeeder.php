<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = 'dummy/dummy.png';

        DB::table('pegawais')->insert([
            [
                'nama' => 'Suryaningsih, S.S.,M.P.Par',
                'email' => 'kasubagtu@disparbud.com',
                'password' => bcrypt('password123'),
                'jabatan_id' => 2,
                'foto' => $filePath,
            ],
            [
                'nama' => 'BAGUSTHIRA EVAN PRATAMA, S.Ikom ',
                'email' => 'humas@disparbud.com',
                'password' => bcrypt('password123'),
                'jabatan_id' => 4,
                'foto' => $filePath,
            ],
        ]);
    }
}
