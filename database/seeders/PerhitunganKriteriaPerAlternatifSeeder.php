<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PerhitunganKriteriaPerAlternatif;

class PerhitunganKriteriaPerAlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            PerhitunganKriteriaPerAlternatif::create([
                'id_perhitungan' => 1,
                'nama_restoran' => 'Dummy ' . ($i + 1),
                'aksesbilitas' => rand(70, 100) / 10,
                'keamanan' => rand(70, 100) / 10,
                'kenyamanan' => rand(70, 100) / 10,
                'luas_bangunan' => rand(70, 100) / 10,
                'luas_parkir' => rand(70, 100) / 10,
                'keramaian' => rand(70, 100) / 10,
                'kebersihan' => rand(70, 100) / 10,
                'fasilitas' => rand(70, 100) / 10,
                'jarak_dengan_pusat_kota' => rand(70, 100) / 10,
                'harga' => rand(70, 100) / 10,
            ]);
        }

    }
}
