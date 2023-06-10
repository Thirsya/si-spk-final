<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilNormalisasiEntropy extends Model
{
    protected $table = 'hasil_normalisasi_entropy';

    protected $fillable = [
        'id_perhitungan',
        'nilai_normalisasi_aksesbilitas',
        'nilai_normalisasi_keamanan',
        'nilai_normalisasi_kenyamanan',
        'nilai_normalisasi_luas_bangunan',
        'nilai_normalisasi_luas_parkir',
        'nilai_normalisasi_keramaian',
        'nilai_normalisasi_kebersihan',
        'nilai_normalisasi_fasilitas',
        'nilai_normalisasi_jarak_dengan_pusat_kota',
        'nilai_normalisasi_harga',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'id_perhitungan');
    }
}
