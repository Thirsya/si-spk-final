<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilNormalisasiEntropy extends Model
{
    protected $table = 'hasil_normalisasi_entropy';

    protected $fillable = [
        'id_perhitungan',
        'nilai_normalisasi_Ranking_Kelas',
        'nilai_normalisasi_Disiplin',
        'nilai_normalisasi_Kemampuan_Bahasa_Asing',
        'nilai_normalisasi_Hafalan_Rumus_Periodik',
        'nilai_normalisasi_Teliti_Unsur_Kimia',
        'nilai_normalisasi_Riwayat_Sanksi',
        'nilai_normalisasi_Umur',
        'nilai_normalisasi_Sering_Terlambat',
        'nilai_normalisasi_Jumlah_Alpha',
        'nilai_normalisasi_Presentasi_Kekalahan',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'id_perhitungan');
    }
}
