<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptimasiMoora extends Model
{
    protected $table = 'optimasi_moora';

    protected $fillable = [
        'id_perhitungan',
        'nama_restoran',
        'nilai_optimasi_moora_aksesbilitas',
        'nilai_optimasi_moora_keamanan',
        'nilai_optimasi_moora_kenyamanan',
        'nilai_optimasi_moora_luas_bangunan',
        'nilai_optimasi_moora_luas_parkir',
        'nilai_optimasi_moora_keramaian',
        'nilai_optimasi_moora_kebersihan',
        'nilai_optimasi_moora_fasilitas',
        'nilai_optimasi_moora_jarak_dengan_pusat_kota',
        'nilai_optimasi_moora_harga',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'id_perhitungan');
    }
}