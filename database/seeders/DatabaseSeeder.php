<?php

namespace Database\Seeders;

use App\Models\JumlahNormalisasiEntropy;
use App\Models\TabelBobotEntropy;
use App\Models\TabelNilaiEntropy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PerhitunganSeeder::class,
            PerhitunganKriteriaPerAlternatifSeeder::class,
            JumlahNormalisasiEntropySeeder::class,
            PerhitunganKriteriaPerAlternatifSeeder::class,
            TabelBobotEntropySeeder::class,
            TabelNilaiEntropySeeder::class,
            TabelTotalNilaiEntropySeeder::class,
        ]);
    }
}
