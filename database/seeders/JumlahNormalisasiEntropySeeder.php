<?php

namespace Database\Seeders;

use App\Models\JumlahNormalisasiEntropy;
use Illuminate\Database\Seeder;

class JumlahNormalisasiEntropySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JumlahNormalisasiEntropy::create([
            'hitung_id' => 1,
            'jumlah_normalisasi_Ranking_Kelas' => 2.5,
            'jumlah_normalisasi_Disiplin' => 3.8,
            'jumlah_normalisasi_Kemampuan_Bahasa_Asing' => 4.2,
            'jumlah_normalisasi_Hafalan_Rumus_Periodik' => 1.9,
            'jumlah_normalisasi_Teliti_Unsur_Kimia' => 3.6,
            'jumlah_normalisasi_Riwayat_Sanksi' => 2.1,
            'jumlah_normalisasi_Umur' => 4.7,
            'jumlah_normalisasi_Sering_Terlambat' => 3.3,
            'jumlah_normalisasi_Jumlah_Alpha' => 2.8,
            'jumlah_normalisasi_Presentasi_Kekalahan' => 3.9,
        ]);
    }
}
