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
            ->select('tabel_histories.id as historyid', 'perhitungan.judul_perhitungan', 'perhitungan.waktu_perhitungan')
            ->get();

        return response()->json($tabelHistories);
    }

    public function show($idPerhitungan)
    {
        $perhitunganKriteriaPerAlternatifData = DB::table('perhitungan_kriteria_per_alternatif')
            ->where('id', $idPerhitungan)
            ->get();

        $nilaimaxbenefitData = DB::table('nilai_max_tiap_alternatif_benefit')
            ->where('id', $idPerhitungan)
            ->get();

        $nilaimincostData = DB::table('nilai_min_tiap_alternatif_cost')
            ->where('id', $idPerhitungan)
            ->get();

        $nilaiEntropyNormalisasiData = DB::table('hasil_normalisasi_entropy')
            ->where('id', $idPerhitungan)
            ->get();

        $perhitunganJumlahNormalisasiEntropyData = DB::table('jumlah_normalisasi_entropies')
            ->where('id', $idPerhitungan)
            ->get();

        $perhitunganNilaiEntropyData = DB::table('tabel_nilai_entropies')
            ->where('id', $idPerhitungan)
            ->get();

        $TabelTotalNilaiEntropyData = DB::table('tabel_total_nilai_entropies')
            ->where('id', $idPerhitungan)
            ->get();

        $TabelTotalBobotEntropyData = DB::table('tabel_bobot_entropies')
            ->where('id', $idPerhitungan)
            ->get();

        $NilaiNormalisasiMooraData = DB::table('normalisasi_moora')
            ->where('id', $idPerhitungan)
            ->get();

        $NilaiOptimasiMooraData = DB::table('optimasi_moora')
            ->where('id', $idPerhitungan)
            ->get();

        $NilairankingFinalsData = DB::table('ranking_finals')
            ->where('id', $idPerhitungan)
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
            'id_ranking_final',)
        ->where('id_perhitungan', $idPerhitungan)
        ->get();

        $response = [
            'tabelHistory' => $tabelHistory,
            'perhitunganKriteriaPerAlternatifData' => $perhitunganKriteriaPerAlternatifData,
            'nilaimaxbenefitData' => $nilaimaxbenefitData,
            'nilaimincostData' => $nilaimincostData,
            'nilaiEntropyNormalisasiData' => $nilaiEntropyNormalisasiData,
            'perhitunganJumlahNormalisasiEntropyData' => $perhitunganJumlahNormalisasiEntropyData,
            'perhitunganNilaiEntropyData' => $perhitunganNilaiEntropyData,
            'TabelTotalNilaiEntropyData' => $TabelTotalNilaiEntropyData,
            'TabelTotalBobotEntropyData' => $TabelTotalBobotEntropyData,
            'NilaiNormalisasiMooraData' => $NilaiNormalisasiMooraData,
            'NilaiOptimasiMooraData' => $NilaiOptimasiMooraData,
            'NilairankingFinalsData' => $NilairankingFinalsData,
        ];



        if ($tabelHistory) {
            return response()->json($response);
        } else {
            return response()->json(['message' => 'TabelHistory not found'], Response::HTTP_NOT_FOUND);
        }
    }
}
