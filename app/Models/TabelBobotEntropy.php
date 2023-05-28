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
        'bobot_entropy_1',
        'bobot_entropy_2',
        'bobot_entropy_3',
        'bobot_entropy_4',
        'bobot_entropy_5',
        'bobot_entropy_6',
        'bobot_entropy_7',
        'bobot_entropy_8',
        'bobot_entropy_9',
        'bobot_entropy_10',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'hitung_id');
    }
}
