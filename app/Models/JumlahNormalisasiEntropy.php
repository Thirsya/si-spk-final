<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JumlahNormalisasiEntropy extends Model
{
    protected $table = 'jumlah_normalisasi_entropies'; // Ganti 'nama_tabel' dengan nama tabel yang sesuai

    protected $fillable = [
        'hitung_id',
        'jumlah_kriteria_1',
        'jumlah_kriteria_2',
        'jumlah_kriteria_3',
        'jumlah_kriteria_4',
        'jumlah_kriteria_5',
        'jumlah_kriteria_6',
        'jumlah_kriteria_7',
        'jumlah_kriteria_8',
        'jumlah_kriteria_9',
        'jumlah_kriteria_10',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'hitung_id');
    }
}
