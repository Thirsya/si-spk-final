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

        $nilaimaxbenefit = DB::table('nilai_max_tiap_alternatif_benefit')
            ->where('id_perhitungan', $request->perhitungan_id)
            ->get();


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

        $nilaimincost = DB::table('nilai_min_tiap_alternatif_cost')
            ->where('id_perhitungan', $request->perhitungan_id)
            ->get();

        //Membuat Hasil Normalisasi dengan membagi Nilai Max dan Min Tiap Kriteria Per Alternatif
        //Untuk Kriteria Benefit, Nilai Kriteria Per Alternatif dibagi Nilai Max
        //Untuk Kriteria Cost, Nilai Min dibagi Nilai Kriteria Per Alternatif

        $entropies = [];

        $maxValues = $nilaimaxbenefit->max();
        $minValues = $nilaimincost->min();

        foreach ($perhitunganKriteriaPerAlternatif as $data) {
            $entropies[] = [
                'id_perhitungan' => $request->perhitungan_id,
                'nilai_normalisasi_Ranking_Kelas' => $data->Ranking_Kelas / $maxValues->max_Ranking_Kelas,
                'nilai_normalisasi_Disiplin' => $data->Disiplin / $maxValues->max_Disiplin,
                'nilai_normalisasi_Kemampuan_Bahasa_Asing' => $data->Kemampuan_Bahasa_Asing / $maxValues->max_Kemampuan_Bahasa_Asing,
                'nilai_normalisasi_Hafalan_Rumus_Periodik' => $data->Hafalan_Rumus_Periodik / $maxValues->max_Hafalan_Rumus_Periodik,
                'nilai_normalisasi_Teliti_Unsur_Kimia' => $data->Teliti_Unsur_Kimia / $maxValues->max_Teliti_Unsur_Kimia,
                'nilai_normalisasi_Riwayat_Sanksi' =>  $minValues->min_Riwayat_Sanksi / $data->Riwayat_Sanksi,
                'nilai_normalisasi_Umur' =>  $minValues->min_Umur / $data->Umur,
                'nilai_normalisasi_Sering_Terlambat' => $minValues->min_Sering_Terlambat / $data->Sering_Terlambat,
                'nilai_normalisasi_Jumlah_Alpha' => $minValues->min_Jumlah_Alpha / $data->Jumlah_Alpha,
                'nilai_normalisasi_Presentasi_Kekalahan' => $minValues->min_Presentasi_Kekalahan / $data->Presentasi_Kekalahan,
            ];
        }

        // Simpan nilai entropy normalisasi ke dalam tabel "hasil_normalisasi_entropy"
        try {
            DB::table('hasil_normalisasi_entropy')->insert($entropies);
        } catch (\Exception $e) {
            // Handle error jika terjadi kesalahan saat menyimpan data
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.']);
        }

        // Mengambil data nilai entropy normalisasi
        $nilaiEntropyNormalisasi = DB::table('hasil_normalisasi_entropy')
            ->where('id_perhitungan', $request->perhitungan_id)
            ->get();

        //Membuat Jumlah Akhir Nilai Hasil Normalisasi Entropy dengan Menjumlahkan Nilai Seluruh Kolom
        $jumlahNormalisasi = [
            'id_perhitungan' => $request->perhitungan_id,
            'jumlah_normalisasi_Ranking_Kelas' => 0,
            'jumlah_normalisasi_Disiplin' => 0,
            'jumlah_normalisasi_Kemampuan_Bahasa_Asing' => 0,
            'jumlah_normalisasi_Hafalan_Rumus_Periodik' => 0,
            'jumlah_normalisasi_Teliti_Unsur_Kimia' => 0,
            'jumlah_normalisasi_Riwayat_Sanksi' => 0,
            'jumlah_normalisasi_Umur' => 0,
            'jumlah_normalisasi_Sering_Terlambat' => 0,
            'jumlah_normalisasi_Jumlah_Alpha' => 0,
            'jumlah_normalisasi_Presentasi_Kekalahan' => 0,
        ];

        foreach ($entropies as $data) {
            $jumlahNormalisasi['jumlah_normalisasi_Ranking_Kelas'] += $data['nilai_normalisasi_Ranking_Kelas'];
            $jumlahNormalisasi['jumlah_normalisasi_Disiplin'] += $data['nilai_normalisasi_Disiplin'];
            $jumlahNormalisasi['jumlah_normalisasi_Kemampuan_Bahasa_Asing'] += $data['nilai_normalisasi_Kemampuan_Bahasa_Asing'];
            $jumlahNormalisasi['jumlah_normalisasi_Hafalan_Rumus_Periodik'] += $data['nilai_normalisasi_Hafalan_Rumus_Periodik'];
            $jumlahNormalisasi['jumlah_normalisasi_Teliti_Unsur_Kimia'] += $data['nilai_normalisasi_Teliti_Unsur_Kimia'];
            $jumlahNormalisasi['jumlah_normalisasi_Riwayat_Sanksi'] += $data['nilai_normalisasi_Riwayat_Sanksi'];
            $jumlahNormalisasi['jumlah_normalisasi_Umur'] += $data['nilai_normalisasi_Umur'];
            $jumlahNormalisasi['jumlah_normalisasi_Sering_Terlambat'] += $data['nilai_normalisasi_Sering_Terlambat'];
            $jumlahNormalisasi['jumlah_normalisasi_Jumlah_Alpha'] += $data['nilai_normalisasi_Jumlah_Alpha'];
            $jumlahNormalisasi['jumlah_normalisasi_Presentasi_Kekalahan'] += $data['nilai_normalisasi_Presentasi_Kekalahan'];
        }

       // Simpan nilai jumlah entropy normalisasi ke dalam tabel "jumlah_normalisasi_entropies"
        try {
            DB::table('jumlah_normalisasi_entropies')->insert([$jumlahNormalisasi]);
        } catch (\Exception $e) {
            // Handle error jika terjadi kesalahan saat menyimpan data
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }

        $perhitunganJumlahNormalisasiEntropy = DB::table('jumlah_normalisasi_entropies')
        ->where('id_perhitungan', $request->perhitungan_id)
        ->get();


        // Lanjutkan dengan operasi lain yang diperlukan


        $response = [
            'perhitungans' => $perhitungans,
            'perhitunganKriteriaPerAlternatif' => $perhitunganKriteriaPerAlternatif,
            'nilaimaxbenefit' => $nilaimaxbenefit,
            'nilaimincost' => $nilaimincost,
            'nilaiEntropyNormalisasi' => $nilaiEntropyNormalisasi,
            'jumlahNilaiNormalisasi' => $perhitunganJumlahNormalisasiEntropy
        ];

        return response()->json($response);
    }
}
