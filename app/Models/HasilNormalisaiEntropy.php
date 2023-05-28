<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilNormalisaiEntropy extends Model
{
    protected $table = 'normalisasi_entropy';

    protected $fillable = [
        'id_perhitungan',
        'nilai_normalisasi_kriteria_1',
        'nilai_normalisasi_kriteria_2',
        'nilai_normalisasi_kriteria_3',
        'nilai_normalisasi_kriteria_4',
        'nilai_normalisasi_kriteria_5',
        'nilai_normalisasi_kriteria_6',
        'nilai_normalisasi_kriteria_7',
        'nilai_normalisasi_kriteria_8',
        'nilai_normalisasi_kriteria_9',
        'nilai_normalisasi_kriteria_10',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'id_perhitungan');
    }
}
