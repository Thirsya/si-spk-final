<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelNilaiEntropy extends Model
{
    use HasFactory;

    protected $table = 'tabel_nilai_entropies'; // Ganti 'nama_tabel' dengan nama tabel yang sesuai

    protected $fillable = [
        'hitung_id',
        'nilai_e_kriteria_1',
        'nilai_e_kriteria_2',
        'nilai_e_kriteria_3',
        'nilai_e_kriteria_4',
        'nilai_e_kriteria_5',
        'nilai_e_kriteria_6',
        'nilai_e_kriteria_7',
        'nilai_e_kriteria_8',
        'nilai_e_kriteria_9',
        'nilai_e_kriteria_10',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'hitung_id');
    }
}
