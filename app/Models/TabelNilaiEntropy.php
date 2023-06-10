<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelNilaiEntropy extends Model
{
    use HasFactory;

    protected $table = 'tabel_nilai_entropies'; // Ganti 'nama_tabel' dengan nama tabel yang sesuai

    protected $fillable = [
        'id_perhitungan',
        'nilai_e_kriteria_aksesbilitas',
        'nilai_e_kriteria_keamanan',
        'nilai_e_kriteria_kenyamanan',
        'nilai_e_kriteria_luas_bangunan',
        'nilai_e_kriteria_luas_parkir',
        'nilai_e_kriteria_keramaian',
        'nilai_e_kriteria_kebersihan',
        'nilai_e_kriteria_fasilitas',
        'nilai_e_kriteria_jarak_dengan_pusat_kota',
        'nilai_e_kriteria_harga',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'hitung_id');
    }
}
