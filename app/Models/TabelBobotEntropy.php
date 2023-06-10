<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelBobotEntropy extends Model
{
    use HasFactory;

    protected $table = 'tabel_bobot_entropies'; // Ganti 'nama_tabel' dengan nama tabel yang sesuai

    protected $fillable = [
        'hitung_id',
        'bobot_entropy_aksesbilitas',
        'bobot_entropy_keamanan',
        'bobot_entropy_kenyamanan',
        'bobot_entropy_luas_bangunan',
        'bobot_entropy_luas_parkir',
        'bobot_entropy_keramaian',
        'bobot_entropy_kebersihan',
        'bobot_entropy_fasilitas',
        'bobot_entropy_jarak_dengan_pusat_kota',
        'bobot_entropy_harga',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'hitung_id');
    }
}
