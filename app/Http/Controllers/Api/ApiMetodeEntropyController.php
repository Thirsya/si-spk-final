<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerhitunganKriteriaPerAlternatif;
use App\Models\NilaiMaxTiapAlternatifBenefit;
use App\Models\NilaiMinTiapAlternatifCost;

use Illuminate\Support\Facades\DB;


class ApiMetodeEntropyController extends Controller
{
    public function PerhitunganTotal(Request $request)
    {
        $perhitunganID = $request->perhitungan_id;
        $perhitungans = DB::table('perhitungan')
            ->where('id', $request->perhitungan_id)
            ->get();
        $perhitunganKriteriaPerAlternatif = DB::table('perhitungan_kriteria_per_alternatif')
            ->where('id_perhitungan', $request->perhitungan_id)
            ->get();

        // $perhitunganKriteriaPerAlternatif = PerhitunganKriteriaPerAlternatif::all();
        // $nilaimaxbenefit = NilaiMaxTiapAlternatifBenefit::all();

        DB::beginTransaction();

        //Mengambil Nilai Max Benefit
        try {
            // Inisialisasi array kosong untuk menyimpan nilai terbesar per kolom
            $highestValues = [];

            // Tentukan daftar kolom yang ingin diambil
            $kolomYangDiambil = ['Ranking_Kelas', 'Disiplin', 'Kemampuan_Bahasa_Asing', 'Hafalan_Rumus_Periodik', 'Teliti_Unsur_Kimia'];

            // Looping untuk mengambil nilai terbesar per kolom
            foreach ($perhitunganKriteriaPerAlternatif as $data) {
                foreach ($kolomYangDiambil as $kolom) {
                    $value = $data->$kolom;

                    if (!isset($highestValues[$kolom]) || $value > $highestValues[$kolom]) {
                        // Mengupdate nilai terbesar per kolom
                        $highestValues[$kolom] = $value;
                    }
                }
            }

            // Menyimpan nilai terbesar ke dalam tabel "nilai_max_tiap_alternatif_benefit"
            $nilaiMaxTiapAlternatifBenefit = new NilaiMaxTiapAlternatifBenefit([
                'id_perhitungan' => $perhitunganID, // Ganti dengan nilai ID perhitungan yang sesuai
                'max_Ranking_Kelas' => $highestValues['Ranking_Kelas'],
                'max_Disiplin' => $highestValues['Disiplin'],
                'max_Kemampuan_Bahasa_Asing' => $highestValues['Kemampuan_Bahasa_Asing'],
                'max_Hafalan_Rumus_Periodik' => $highestValues['Hafalan_Rumus_Periodik'],
                'max_Teliti_Unsur_Kimia' => $highestValues['Teliti_Unsur_Kimia'],
            ]);

            $nilaiMaxTiapAlternatifBenefit->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // Handle error jika terjadi kesalahan saat menyimpan data
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.']);
        }


        //Mengambil Nilai Min Cost
        try {
            // Inisialisasi array kosong untuk menyimpan nilai terkecil per kolom
            $lowestValues = [];

            // Tentukan daftar kolom yang ingin diambil
            $kolomYangDiambil = ['Riwayat_Sanksi', 'Umur', 'Sering_Terlambat', 'Jumlah_Alpha', 'Presentasi_Kekalahan'];

            // Looping untuk mengambil nilai terkecil per kolom
            foreach ($perhitunganKriteriaPerAlternatif as $data) {
                foreach ($kolomYangDiambil as $kolom) {
                    $value = $data->$kolom;

                    if (!isset($lowestValues[$kolom]) || $value < $lowestValues[$kolom]) {
                        // Mengupdate nilai terkecil per kolom
                        $lowestValues[$kolom] = $value;
                    }
                }
            }

            // Menyimpan nilai terkecil ke dalam tabel "nilai_min_tiap_alternatif"
            $nilaiMinTiapAlternatifCost = new NilaiMinTiapAlternatifCost([
                'id_perhitungan' => $perhitunganID, // Ganti dengan nilai ID perhitungan yang sesuai
                'min_Riwayat_Sanksi' => $lowestValues['Riwayat_Sanksi'],
                'min_Umur' => $lowestValues['Umur'],
                'min_Sering_Terlambat' => $lowestValues['Sering_Terlambat'],
                'min_Jumlah_Alpha' => $lowestValues['Jumlah_Alpha'],
                'min_Presentasi_Kekalahan' => $lowestValues['Presentasi_Kekalahan'],
            ]);

            $nilaiMinTiapAlternatifCost->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // Handle error jika terjadi kesalahan saat menyimpan data
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.']);
        }

        //Membagi Tiap Nilai Kriteria Per Alternatif dengan Nilai Max Benefit
        






        //Menampilkan Nilai Max dan Min
        $nilaimaxbenefit = DB::table('nilai_max_tiap_alternatif_benefit')
            ->where('id_perhitungan', $request->perhitungan_id)
            ->get();

        $nilaimincost = DB::table('nilai_min_tiap_alternatif_cost')
            ->where('id_perhitungan', $request->perhitungan_id)
            ->get();

        $response = [
            'perhitungans' => $perhitungans,
            'perhitunganKriteriaPerAlternatif' => $perhitunganKriteriaPerAlternatif,
            'nilaimaxbenefit' => $nilaimaxbenefit,
            'nilaimincost' => $nilaimincost
        ];

        return response()->json($response);
    }
}
