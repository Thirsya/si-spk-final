<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerhitunganKriteriaPerAlternatif;
use App\Models\NilaiMaxTiapAlternatifBenefit;
use App\Models\NilaiMinTiapAlternatifCost;
use App\Models\NormalisaiMoora;
use App\Models\OptimasiMoora;
use App\Models\Perhitungan;
use App\Models\TabelBobotEntropy;
use App\Models\TabelHistory;
use App\Models\TabelTotalNilaiEntropy;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class ApiHistoryController extends Controller
{
    public function index()
    {
        $tabelHistories = TabelHistory::join('perhitungan', 'tabel_histories.id_perhitungan', '=', 'perhitungan.id')
            ->select('tabel_histories.id as historyid', 'perhitungan.id as id_perhitungan', 'perhitungan.judul_perhitungan', 'perhitungan.waktu_perhitungan')
            ->get();

        return response()->json($tabelHistories);
    }

    public function show($idPerhitungan)
    {
        $perhitungan = TabelHistory::join('perhitungan', 'tabel_histories.id_perhitungan', '=', 'perhitungan.id')
            ->select('tabel_histories.id as historyid', 'perhitungan.judul_perhitungan', 'perhitungan.waktu_perhitungan')
            ->where('tabel_histories.id', $idPerhitungan)
            ->first();

        $perhitungan_kriteria_per_alternatif = DB::table('perhitungan_kriteria_per_alternatif')
            ->where('id_perhitungan', $idPerhitungan)
            ->get();
        // $perhitunganKriteriaPerAlternatif[] = $perhitunganKriteriaPerAlternatifData;

        $nilaimaxbenefit = DB::table('nilai_max_tiap_alternatif_benefit')
            ->where('id_perhitungan', $idPerhitungan)
            ->get();

        $nilaimincost = DB::table('nilai_min_tiap_alternatif_cost')
            ->where('id_perhitungan', $idPerhitungan)
            ->get();

        $nilaiEntropyNormalisasi = DB::table('hasil_normalisasi_entropy')
            ->where('id_perhitungan', $idPerhitungan)
            ->get();

        $jumlahNilaiNormalisasi = DB::table('jumlah_normalisasi_entropies')
            ->where('id_perhitungan', $idPerhitungan)
            ->get();

        $nilaiEntropy = DB::table('tabel_nilai_entropies')
            ->where('id_perhitungan', $idPerhitungan)
            ->get();

        $TabelTotalNilaiEntropy = DB::table('tabel_total_nilai_entropies')
            ->where('hitung_id', $idPerhitungan)
            ->get();

        $TabelTotalBobotEntropy = DB::table('tabel_bobot_entropies')
            ->where('hitung_id', $idPerhitungan)
            ->get();

        $NilaiNormalisasiMoora = DB::table('normalisasi_moora')
            ->where('id_perhitungan', $idPerhitungan)
            ->get();

        $NilaiOptimasiMoora = DB::table('optimasi_moora')
            ->where('id_perhitungan', $idPerhitungan)
            ->get();

        $NilairankingFinals = DB::table('ranking_finals')
            ->where('id_perhitungan', $idPerhitungan)
            ->get();


        $tabelHistory = TabelHistory::select(
            'id_perhitungan',
            'id_kriteria_per_alternatif',
            'id_nilai_max_benefit',
            'id_nilai_min_cost',
            'id_hasil_normalisasi_entropy',
            'id_jumlah_normalisasi_entropy',
            'id_nilai_entropy_e',
            'id_total_nilai_entropy',
            'id_bobot_entropy',
            'id_normalisasi_moora',
            'id_optimasi_moora',
            'id_ranking_final',
        )
            ->where('id_perhitungan', $idPerhitungan)
            ->get();


        $response = [
            'tabelHistory' => [],
            'perhitungan' => (object)$perhitungan,
            'perhitungan_kriteria_per_alternatif' => $perhitungan_kriteria_per_alternatif,
            'perhitungan_total' => [
                'headers' => [],
                'original' => [
                    'nilaimaxbenefit' => $nilaimaxbenefit,
                    'nilaimincost' => $nilaimincost,
                    'nilaiEntropyNormalisasi' => $nilaiEntropyNormalisasi,
                    'jumlahNilaiNormalisasi' => $jumlahNilaiNormalisasi,
                    'nilaiEntropy' => $nilaiEntropy,
                    'TabelTotalNilaiEntropy' => $TabelTotalNilaiEntropy,
                    'TabelTotalBobotEntropy' => $TabelTotalBobotEntropy,
                    'NilaiNormalisasiMoora' => $NilaiNormalisasiMoora,
                    'NilaiOptimasiMoora' => $NilaiOptimasiMoora,
                    'NilairankingFinals' => $NilairankingFinals,
                ],
                'exception' => null,
            ],
        ];



        if ($tabelHistory) {
            return response()->json($response);
        } else {
            return response()->json(['message' => 'TabelHistory not found'], Response::HTTP_NOT_FOUND);
        }
    }
}
