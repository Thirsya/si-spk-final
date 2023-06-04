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
        'nilai_e_kriteria_Ranking_Kelas',
        'nilai_e_kriteria_Disiplin',
        'nilai_e_kriteria_Kemampuan_Bahasa_Asing',
        'nilai_e_kriteria_Hafalan_Rumus_Periodik',
        'nilai_e_kriteria_Teliti_Unsur_Kimia',
        'nilai_e_kriteria_Riwayat_Sanksi',
        'nilai_e_kriteria_Umur',
        'nilai_e_kriteria_Sering_Terlambat',
        'nilai_e_kriteria_Jumlah_Alpha',
        'nilai_e_kriteria_Presentasi_Kekalahan',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'hitung_id');
    }
}
