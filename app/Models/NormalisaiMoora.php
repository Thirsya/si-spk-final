<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NormalisaiMoora extends Model
{
    protected $table = 'normalisasi_moora';

    protected $fillable = [
        'id_perhitungan',
        'nilai_normalisasi_moora_aksesbilitas',
        'nilai_normalisasi_moora_keamanan',
        'nilai_normalisasi_moora_kenyamanan',
        'nilai_normalisasi_moora_luas_bangunan',
        'nilai_normalisasi_moora_luas_parkir',
        'nilai_normalisasi_moora_keramaian',
        'nilai_normalisasi_moora_kebersihan',
        'nilai_normalisasi_moora_fasilitas',
        'nilai_normalisasi_moora_jarak_dengan_pusat_kota',
        'nilai_normalisasi_moora_harga',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'id_perhitungan');
    }
}
