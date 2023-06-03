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
                'nama_siswa' => 'Dummy ' . ($i + 1),
                'Ranking_Kelas' => rand(70, 100) / 10,
                'Disiplin' => rand(70, 100) / 10,
                'Kemampuan_Bahasa_Asing' => rand(70, 100) / 10,
                'Hafalan_Rumus_Periodik' => rand(70, 100) / 10,
                'Teliti_Unsur_Kimia' => rand(70, 100) / 10,
                'Riwayat_Sanksi' => rand(70, 100) / 10,
                'Umur' => rand(70, 100) / 10,
                'Sering_Terlambat' => rand(70, 100) / 10,
                'Jumlah_Alpha' => rand(70, 100) / 10,
                'Presentasi_Kekalahan' => rand(70, 100) / 10,
            ]);
        }

    }
}
