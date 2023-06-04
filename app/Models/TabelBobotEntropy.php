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
        'bobot_entropy_Ranking_Kelas',
        'bobot_entropy_Disiplin',
        'bobot_entropy_Kemampuan_Bahasa_Asing',
        'bobot_entropy_Hafalan_Rumus_Periodik',
        'bobot_entropy_Teliti_Unsur_Kimia',
        'bobot_entropy_Riwayat_Sanksi',
        'bobot_entropy_Umur',
        'bobot_entropy_Sering_Terlambat',
        'bobot_entropy_Jumlah_Alpha',
        'bobot_entropy_Presentasi_Kekalahan',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'hitung_id');
    }
}