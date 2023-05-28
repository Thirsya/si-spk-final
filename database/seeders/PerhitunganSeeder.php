<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Perhitungan;

class PerhitunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perhitungan::create([
            'judul_perhitungan' => 'Perhitungan 1',
            'waktu_perhitungan' => now(),
        ]);

        Perhitungan::create([
            'judul_perhitungan' => 'Perhitungan 2',
            'waktu_perhitungan' => now(),
        ]);
    }
}
