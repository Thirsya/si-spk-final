<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptimasiMoora extends Model
{
    protected $table = 'optimasi_moora';

    protected $fillable = [
        'id_perhitungan',
        'nama_siswa',
        'nilai_kriteria_1',
        'nilai_kriteria_2',
        'nilai_kriteria_3',
        'nilai_kriteria_4',
        'nilai_kriteria_5',
        'nilai_kriteria_6',
        'nilai_kriteria_7',
        'nilai_kriteria_8',
        'nilai_kriteria_9',
        'nilai_kriteria_10',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'id_perhitungan');
    }
}
