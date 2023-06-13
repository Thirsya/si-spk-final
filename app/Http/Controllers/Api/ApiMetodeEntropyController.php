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
use Illuminate\Support\Facades\DB;


class ApiMetodeEntropyController extends Controller
{
    public function PerhitunganTotal($id_perhitungan)
    {
        $perhitunganID = $id_perhitungan;
        $perhitungans = DB::table('perhitungan')
            ->where('id', $id_perhitungan)
            ->get();
        $perhitunganKriteriaPerAlternatif = DB::table('perhitungan_kriteria_per_alternatif')
            ->where('id_perhitungan', $id_perhitungan)
            ->get();


        DB::beginTransaction();

        //Mengambil Nilai Max Benefit
        try {
            // Inisialisasi array kosong untuk menyimpan nilai terbesar per kolom
            $highestValues = [];

            // Tentukan daftar kolom yang ingin diambil
            $kolomYangDiambil = [
                'aksesbilitas',
                'keamanan',
                'kenyamanan',
                'luas_bangunan',
                'luas_parkir',
                'keramaian',
                'kebersihan',
                'fasilitas'
            ];

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
                'max_aksesbilitas' => $highestValues['aksesbilitas'],
                'max_keamanan' => $highestValues['keamanan'],
                'max_kenyamanan' => $highestValues['kenyamanan'],
                'max_luas_bangunan' => $highestValues['luas_bangunan'],
                'max_luas_parkir' => $highestValues['luas_parkir'],
                'max_keramaian' => $highestValues['keramaian'],
                'max_kebersihan' => $highestValues['kebersihan'],
                'max_fasilitas' => $highestValues['fasilitas'],
            ]);

            // dd($nilaiMaxTiapAlternatifBenefit);
            $nilaiMaxTiapAlternatifBenefit->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // Handle error jika terjadi kesalahan saat menyimpan data
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.']);
        }

        $nilaimaxbenefit = DB::table('nilai_max_tiap_alternatif_benefit')
            ->where('id_perhitungan', $id_perhitungan)
            ->get();
        //Mengambil Nilai Min Cost
        try {
            // Inisialisasi array kosong untuk menyimpan nilai terkecil per kolom
            $lowestValues = [];

            // Tentukan daftar kolom yang ingin diambil
            $kolomYangDiambil = [
                'jarak_dengan_pusat_kota',
                'harga'
            ];

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
                'min_jarak_dengan_pusat_kota' => $lowestValues['jarak_dengan_pusat_kota'],
                'min_harga' => $lowestValues['harga'],
            ]);
            // dd($nilaiMinTiapAlternatifCost);
            $nilaiMinTiapAlternatifCost->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // Handle error jika terjadi kesalahan saat menyimpan data
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.']);
        }

        $nilaimincost = DB::table('nilai_min_tiap_alternatif_cost')
            ->where('id_perhitungan', $id_perhitungan)
            ->get();

        //Membuat Hasil Normalisasi dengan membagi Nilai Max dan Min Tiap Kriteria Per Alternatif
        //Untuk Kriteria Benefit, Nilai Kriteria Per Alternatif dibagi Nilai Max
        //Untuk Kriteria Cost, Nilai Min dibagi Nilai Kriteria Per Alternatif

        $entropies = [];

        $maxValues = $nilaimaxbenefit->max();
        $minValues = $nilaimincost->min();

        foreach ($perhitunganKriteriaPerAlternatif as $data) {
            $entropies[] = [
                'id_perhitungan' => $id_perhitungan,
                'nilai_normalisasi_aksesbilitas' => $data->aksesbilitas / $maxValues->max_aksesbilitas,
                'nilai_normalisasi_keamanan' => $data->keamanan / $maxValues->max_keamanan,
                'nilai_normalisasi_kenyamanan' => $data->kenyamanan / $maxValues->max_kenyamanan,
                'nilai_normalisasi_luas_bangunan' => $data->luas_bangunan / $maxValues->max_luas_bangunan,
                'nilai_normalisasi_luas_parkir' => $data->luas_parkir / $maxValues->max_luas_parkir,
                'nilai_normalisasi_keramaian' =>  $data->keramaian / $maxValues->max_keramaian,
                'nilai_normalisasi_kebersihan' =>  $data->kebersihan / $maxValues->max_kebersihan,
                'nilai_normalisasi_fasilitas' => $data->fasilitas / $maxValues->max_fasilitas,
                'nilai_normalisasi_jarak_dengan_pusat_kota' =>
                $minValues->min_jarak_dengan_pusat_kota / $data->jarak_dengan_pusat_kota,
                'nilai_normalisasi_harga' => $minValues->min_harga / $data->harga,
            ];
        }
        // dd($entropies);
        // Simpan nilai entropy normalisasi ke dalam tabel "hasil_normalisasi_entropy"
        try {
            DB::table('hasil_normalisasi_entropy')->insert($entropies);
        } catch (\Exception $e) {
            // Handle error jika terjadi kesalahan saat menyimpan data
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.']);
        }

        // Mengambil data nilai entropy normalisasi
        $nilaiEntropyNormalisasi = DB::table('hasil_normalisasi_entropy')
            ->where('id_perhitungan', $id_perhitungan)
            ->get();

        //Membuat Jumlah Akhir Nilai Hasil Normalisasi Entropy dengan Menjumlahkan Nilai Seluruh Kolom
        $jumlahNormalisasi = [
            'id_perhitungan' => $id_perhitungan,
            'jumlah_normalisasi_aksesbilitas' => 0,
            'jumlah_normalisasi_keamanan' => 0,
            'jumlah_normalisasi_kenyamanan' => 0,
            'jumlah_normalisasi_luas_bangunan' => 0,
            'jumlah_normalisasi_luas_parkir' => 0,
            'jumlah_normalisasi_keramaian' => 0,
            'jumlah_normalisasi_kebersihan' => 0,
            'jumlah_normalisasi_fasilitas' => 0,
            'jumlah_normalisasi_jarak_dengan_pusat_kota' => 0,
            'jumlah_normalisasi_harga' => 0,
        ];

        foreach ($entropies as $data) {
            $jumlahNormalisasi['jumlah_normalisasi_aksesbilitas'] += $data['nilai_normalisasi_aksesbilitas'];
            $jumlahNormalisasi['jumlah_normalisasi_keamanan'] += $data['nilai_normalisasi_keamanan'];
            $jumlahNormalisasi['jumlah_normalisasi_kenyamanan'] += $data['nilai_normalisasi_kenyamanan'];
            $jumlahNormalisasi['jumlah_normalisasi_luas_bangunan'] += $data['nilai_normalisasi_luas_bangunan'];
            $jumlahNormalisasi['jumlah_normalisasi_luas_parkir'] += $data['nilai_normalisasi_luas_parkir'];
            $jumlahNormalisasi['jumlah_normalisasi_keramaian'] += $data['nilai_normalisasi_keramaian'];
            $jumlahNormalisasi['jumlah_normalisasi_kebersihan'] += $data['nilai_normalisasi_kebersihan'];
            $jumlahNormalisasi['jumlah_normalisasi_fasilitas'] += $data['nilai_normalisasi_fasilitas'];
            $jumlahNormalisasi['jumlah_normalisasi_jarak_dengan_pusat_kota'] += $data['nilai_normalisasi_jarak_dengan_pusat_kota'];
            $jumlahNormalisasi['jumlah_normalisasi_harga'] += $data['nilai_normalisasi_harga'];
        }
        // dd($jumlahNormalisasi);
        // Simpan nilai jumlah entropy normalisasi ke dalam tabel "jumlah_normalisasi_entropies"
        try {
            DB::table('jumlah_normalisasi_entropies')->insert([$jumlahNormalisasi]);
        } catch (\Exception $e) {
            // Handle error jika terjadi kesalahan saat menyimpan data
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }

        $perhitunganJumlahNormalisasiEntropy = DB::table('jumlah_normalisasi_entropies')
            ->where('id_perhitungan', $id_perhitungan)
            ->get();


        // Perhitungan Pencarian Nilai Entropy
        // Menghitung Nilai ln dengan Membagi Jumlah Alternatif
        $jumlahAlternatif = $perhitunganKriteriaPerAlternatif->count();

        $hasilLn = log($jumlahAlternatif);

        // Mencari Nilai K
        $hasilNilaiK = 1 / $hasilLn;

        // Perhitungan Pencarian Nilai Entropy Tiap Kriteria
        $nilaiEntropi = [];

        $nilaiTotal = [
            'nilaiTotal_aksesbilitas' => 0,
            'nilaiTotal_keamanan' => 0,
            'nilaiTotal_kenyamanan' => 0,
            'nilaiTotal_luas_bangunan' => 0,
            'nilaiTotal_luas_parkir' => 0,
            'nilaiTotal_keramaian' => 0,
            'nilaiTotal_kebersihan' => 0,
            'nilaiTotal_fasilitas' => 0,
            'nilaiTotal_jarak_dengan_pusat_kota' => 0,
            'nilaiTotal_harga' => 0,
        ];

        foreach ($nilaiEntropyNormalisasi as $data) {
            $nilai_e_kriteria_aksesbilitas = ($data->nilai_normalisasi_aksesbilitas / $jumlahNormalisasi['jumlah_normalisasi_aksesbilitas']) * log($data->nilai_normalisasi_aksesbilitas / $jumlahNormalisasi['jumlah_normalisasi_aksesbilitas']);
            $nilai_e_kriteria_keamanan = ($data->nilai_normalisasi_keamanan / $jumlahNormalisasi['jumlah_normalisasi_keamanan']) * log($data->nilai_normalisasi_keamanan / $jumlahNormalisasi['jumlah_normalisasi_keamanan']);
            $nilai_e_kriteria_kenyamanan = ($data->nilai_normalisasi_kenyamanan / $jumlahNormalisasi['jumlah_normalisasi_kenyamanan']) * log($data->nilai_normalisasi_kenyamanan / $jumlahNormalisasi['jumlah_normalisasi_kenyamanan']);
            $nilai_e_kriteria_luas_bangunan = ($data->nilai_normalisasi_luas_bangunan / $jumlahNormalisasi['jumlah_normalisasi_luas_bangunan']) * log($data->nilai_normalisasi_luas_bangunan / $jumlahNormalisasi['jumlah_normalisasi_luas_bangunan']);
            $nilai_e_kriteria_luas_parkir = ($data->nilai_normalisasi_luas_parkir / $jumlahNormalisasi['jumlah_normalisasi_luas_parkir']) * log($data->nilai_normalisasi_luas_parkir / $jumlahNormalisasi['jumlah_normalisasi_luas_parkir']);
            $nilai_e_kriteria_keramaian = ($data->nilai_normalisasi_keramaian / $jumlahNormalisasi['jumlah_normalisasi_keramaian']) * log($data->nilai_normalisasi_keramaian / $jumlahNormalisasi['jumlah_normalisasi_keramaian']);
            $nilai_e_kriteria_kebersihan = ($data->nilai_normalisasi_kebersihan / $jumlahNormalisasi['jumlah_normalisasi_kebersihan']) * log($data->nilai_normalisasi_kebersihan / $jumlahNormalisasi['jumlah_normalisasi_kebersihan']);
            $nilai_e_kriteria_fasilitas = ($data->nilai_normalisasi_fasilitas / $jumlahNormalisasi['jumlah_normalisasi_fasilitas']) * log($data->nilai_normalisasi_fasilitas / $jumlahNormalisasi['jumlah_normalisasi_fasilitas']);
            $nilai_e_kriteria_jarak_dengan_pusat_kota = ($data->nilai_normalisasi_jarak_dengan_pusat_kota / $jumlahNormalisasi['jumlah_normalisasi_jarak_dengan_pusat_kota']) * log($data->nilai_normalisasi_jarak_dengan_pusat_kota / $jumlahNormalisasi['jumlah_normalisasi_jarak_dengan_pusat_kota']);
            $nilai_e_kriteria_harga = ($data->nilai_normalisasi_harga / $jumlahNormalisasi['jumlah_normalisasi_harga']) * log($data->nilai_normalisasi_harga / $jumlahNormalisasi['jumlah_normalisasi_harga']);

            $nilaiTotal['nilaiTotal_aksesbilitas'] += $nilai_e_kriteria_aksesbilitas;
            $nilaiTotal['nilaiTotal_keamanan'] += $nilai_e_kriteria_keamanan;
            $nilaiTotal['nilaiTotal_kenyamanan'] += $nilai_e_kriteria_kenyamanan;
            $nilaiTotal['nilaiTotal_luas_bangunan'] += $nilai_e_kriteria_luas_bangunan;
            $nilaiTotal['nilaiTotal_luas_parkir'] += $nilai_e_kriteria_luas_parkir;
            $nilaiTotal['nilaiTotal_keramaian'] += $nilai_e_kriteria_keramaian;
            $nilaiTotal['nilaiTotal_kebersihan'] += $nilai_e_kriteria_kebersihan;
            $nilaiTotal['nilaiTotal_fasilitas'] += $nilai_e_kriteria_fasilitas;
            $nilaiTotal['nilaiTotal_jarak_dengan_pusat_kota'] += $nilai_e_kriteria_jarak_dengan_pusat_kota;
            $nilaiTotal['nilaiTotal_harga'] += $nilai_e_kriteria_harga;
        }
        // Tambahkan total nilai dan dikali dengan hasilNilaiK ke dalam array $nilaiEntropi
        $nilaiEntropi[] = [
            'id_perhitungan' => $id_perhitungan,
            'nilai_e_kriteria_aksesbilitas' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_aksesbilitas'],
            'nilai_e_kriteria_keamanan' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_keamanan'],
            'nilai_e_kriteria_kenyamanan' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_kenyamanan'],
            'nilai_e_kriteria_luas_bangunan' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_luas_bangunan'],
            'nilai_e_kriteria_luas_parkir' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_luas_parkir'],
            'nilai_e_kriteria_keramaian' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_keramaian'],
            'nilai_e_kriteria_kebersihan' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_kebersihan'],
            'nilai_e_kriteria_fasilitas' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_fasilitas'],
            'nilai_e_kriteria_jarak_dengan_pusat_kota' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_jarak_dengan_pusat_kota'],
            'nilai_e_kriteria_harga' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_harga'],
        ];
        // dd($nilaiEntropi);

        try {
            DB::table('tabel_nilai_entropies')->insert($nilaiEntropi);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }

        $perhitunganNilaiEntropy = DB::table('tabel_nilai_entropies')
            ->where('id_perhitungan', $id_perhitungan)
            ->get();

        // Perhitungan Total Nilai Entropy
        $total = DB::table('tabel_nilai_entropies')
            ->where('id_perhitungan', $id_perhitungan)
            ->selectRaw('SUM(
            nilai_e_kriteria_aksesbilitas +
            nilai_e_kriteria_keamanan +
            nilai_e_kriteria_kenyamanan +
            nilai_e_kriteria_luas_bangunan +
            nilai_e_kriteria_luas_parkir +
            nilai_e_kriteria_keramaian +
            nilai_e_kriteria_kebersihan +
            nilai_e_kriteria_fasilitas +
            nilai_e_kriteria_jarak_dengan_pusat_kota +
            nilai_e_kriteria_harga
        ) as total')
            ->value('total');
        // dd($total);

        TabelTotalNilaiEntropy::updateOrCreate(
            ['hitung_id' => $id_perhitungan],
            ['total_nilai_e_entropy' => $total]
        );

        // Perhitungan Bobot Nilai Entropy Per Kriteria
        $TabelTotalNilaiEntropy = DB::table('tabel_total_nilai_entropies')
            ->select('total_nilai_e_entropy')
            ->where('hitung_id', $perhitunganID)
            ->get();

        $totalNilaiEntropy = $TabelTotalNilaiEntropy->first()->total_nilai_e_entropy;

        $nilai_e_kriteria_aksesbilitas_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_aksesbilitas;
        $nilai_e_kriteria_keamanan_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_keamanan;
        $nilai_e_kriteria_kenyamanan_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_kenyamanan;
        $nilai_e_kriteria_luas_bangunan_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_luas_bangunan;
        $nilai_e_kriteria_luas_parkir_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_luas_parkir;
        $nilai_e_kriteria_keramaian_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_keramaian;
        $nilai_e_kriteria_kebersihan_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_kebersihan;
        $nilai_e_kriteria_fasilitas_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_fasilitas;
        $nilai_e_kriteria_jarak_dengan_pusat_kota_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_jarak_dengan_pusat_kota;
        $nilai_e_kriteria_harga_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_harga;


        $tabelBobot = new TabelBobotEntropy([
            'hitung_id' => $perhitunganID,
            'bobot_entropy_aksesbilitas' => ((1 / (10 - $totalNilaiEntropy)) * (1 - $nilai_e_kriteria_aksesbilitas_final)),
            'bobot_entropy_keamanan' => ((1 / (10 - $totalNilaiEntropy)) * (1 - $nilai_e_kriteria_keamanan_final)),
            'bobot_entropy_kenyamanan' => ((1 / (10 - $totalNilaiEntropy)) * (1 - $nilai_e_kriteria_kenyamanan_final)),
            'bobot_entropy_luas_bangunan' => ((1 / (10 - $totalNilaiEntropy)) * (1 - $nilai_e_kriteria_luas_bangunan_final)),
            'bobot_entropy_luas_parkir' => ((1 / (10 - $totalNilaiEntropy)) * (1 - $nilai_e_kriteria_luas_parkir_final)),
            'bobot_entropy_keramaian' => ((1 / (10 - $totalNilaiEntropy)) * (1 - $nilai_e_kriteria_keramaian_final)),
            'bobot_entropy_kebersihan' => ((1 / (10 - $totalNilaiEntropy)) * (1 - $nilai_e_kriteria_kebersihan_final)),
            'bobot_entropy_fasilitas' => ((1 / (10 - $totalNilaiEntropy)) * (1 - $nilai_e_kriteria_fasilitas_final)),
            'bobot_entropy_jarak_dengan_pusat_kota' => ((1 / (10 - $totalNilaiEntropy)) * (1 - $nilai_e_kriteria_jarak_dengan_pusat_kota_final)),
            'bobot_entropy_harga' => ((1 / (10 - $totalNilaiEntropy)) * (1 - $nilai_e_kriteria_harga_final)),

        ]);

        $tabelBobot->save();
        $TabelTotalBobotEntropy = DB::table('tabel_bobot_entropies')
            ->where('hitung_id', $perhitunganID)
            ->get();

        // Perhitungan Normalisasi Moora
        $normalisasiMoora = [];

        $nilaiPow = [
            'nilaiTotal_aksesbilitas' => 0,
            'nilaiTotal_keamanan' => 0,
            'nilaiTotal_kenyamanan' => 0,
            'nilaiTotal_luas_bangunan' => 0,
            'nilaiTotal_luas_parkir' => 0,
            'nilaiTotal_keramaian' => 0,
            'nilaiTotal_kebersihan' => 0,
            'nilaiTotal_fasilitas' => 0,
            'nilaiTotal_jarak_dengan_pusat_kota' => 0,
            'nilaiTotal_harga' => 0,
        ];

        foreach ($perhitunganKriteriaPerAlternatif as $data) {
            $nilaiPow['nilaiTotal_aksesbilitas'] += pow($data->aksesbilitas, 2);
            $nilaiPow['nilaiTotal_keamanan'] += pow($data->keamanan, 2);
            $nilaiPow['nilaiTotal_kenyamanan'] += pow($data->kenyamanan, 2);
            $nilaiPow['nilaiTotal_luas_bangunan'] += pow($data->luas_bangunan, 2);
            $nilaiPow['nilaiTotal_luas_parkir'] += pow($data->luas_parkir, 2);
            $nilaiPow['nilaiTotal_keramaian'] += pow($data->keramaian, 2);
            $nilaiPow['nilaiTotal_kebersihan'] += pow($data->kebersihan, 2);
            $nilaiPow['nilaiTotal_fasilitas'] += pow($data->fasilitas, 2);
            $nilaiPow['nilaiTotal_jarak_dengan_pusat_kota'] += pow($data->jarak_dengan_pusat_kota, 2);
            $nilaiPow['nilaiTotal_harga'] += pow($data->harga, 2);
        }

        foreach ($perhitunganKriteriaPerAlternatif as $data) {
            $normalisasiMoora[] = [
                'id_perhitungan' => $perhitunganID,
                'nilai_normalisasi_moora_aksesbilitas' => $data->aksesbilitas / sqrt($nilaiPow['nilaiTotal_aksesbilitas']),
                'nilai_normalisasi_moora_keamanan' => $data->keamanan / sqrt($nilaiPow['nilaiTotal_keamanan']),
                'nilai_normalisasi_moora_kenyamanan' => $data->kenyamanan / sqrt($nilaiPow['nilaiTotal_kenyamanan']),
                'nilai_normalisasi_moora_luas_bangunan' => $data->luas_bangunan / sqrt($nilaiPow['nilaiTotal_luas_bangunan']),
                'nilai_normalisasi_moora_luas_parkir' => $data->luas_parkir / sqrt($nilaiPow['nilaiTotal_luas_parkir']),
                'nilai_normalisasi_moora_keramaian' => $data->keramaian / sqrt($nilaiPow['nilaiTotal_keramaian']),
                'nilai_normalisasi_moora_kebersihan' => $data->kebersihan / sqrt($nilaiPow['nilaiTotal_kebersihan']),
                'nilai_normalisasi_moora_fasilitas' => $data->fasilitas / sqrt($nilaiPow['nilaiTotal_fasilitas']),
                'nilai_normalisasi_moora_jarak_dengan_pusat_kota' => $data->jarak_dengan_pusat_kota / sqrt($nilaiPow['nilaiTotal_jarak_dengan_pusat_kota']),
                'nilai_normalisasi_moora_harga' => $data->harga / sqrt($nilaiPow['nilaiTotal_harga']),
            ];
        }
        try {
            DB::table('normalisasi_moora')->insert($normalisasiMoora);
        } catch (\Exception $e) {
            // Handle error jika terjadi kesalahan saat menyimpan data
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.']);
        }

        $NilaiNormalisasiMoora = DB::table('normalisasi_moora')
            ->where('id_perhitungan', $perhitunganID)
            ->get();


        foreach ($normalisasiMoora as $index => $data) {
            $nama_restoran = $perhitunganKriteriaPerAlternatif[$index]->nama_restoran;

            foreach ($TabelTotalBobotEntropy as $item) {
                $optimasiMoora[] = [
                    'id_perhitungan' => $perhitunganID,
                    'nama_restoran' => $nama_restoran,
                    'nilai_optimasi_moora_aksesbilitas' => $data['nilai_normalisasi_moora_aksesbilitas'] * $item->bobot_entropy_aksesbilitas,
                    'nilai_optimasi_moora_keamanan' => $data['nilai_normalisasi_moora_keamanan'] * $item->bobot_entropy_keamanan,
                    'nilai_optimasi_moora_kenyamanan' => $data['nilai_normalisasi_moora_kenyamanan'] * $item->bobot_entropy_kenyamanan,
                    'nilai_optimasi_moora_luas_bangunan' => $data['nilai_normalisasi_moora_luas_bangunan'] * $item->bobot_entropy_luas_bangunan,
                    'nilai_optimasi_moora_luas_parkir' => $data['nilai_normalisasi_moora_luas_parkir'] * $item->bobot_entropy_luas_parkir,
                    'nilai_optimasi_moora_keramaian' => $data['nilai_normalisasi_moora_keramaian'] * $item->bobot_entropy_keramaian,
                    'nilai_optimasi_moora_kebersihan' => $data['nilai_normalisasi_moora_kebersihan'] * $item->bobot_entropy_kebersihan,
                    'nilai_optimasi_moora_fasilitas' => $data['nilai_normalisasi_moora_fasilitas'] * $item->bobot_entropy_fasilitas,
                    'nilai_optimasi_moora_jarak_dengan_pusat_kota' => $data['nilai_normalisasi_moora_jarak_dengan_pusat_kota'] * $item->bobot_entropy_jarak_dengan_pusat_kota,
                    'nilai_optimasi_moora_harga' => $data['nilai_normalisasi_moora_harga'] * $item->bobot_entropy_harga,
                ];
            }
        }
        try {
            DB::table('optimasi_moora')->insert($optimasiMoora);
        } catch (\Exception $e) {
            // Handle error jika terjadi kesalahan saat menyimpan data
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.']);
        }
        $NilaiOptimasiMoora = DB::table('optimasi_moora')
            ->where('id_perhitungan', $perhitunganID)
            ->get();

        $kolomMax = [
            'nilai_optimasi_moora_aksesbilitas',
            'nilai_optimasi_moora_keamanan',
            'nilai_optimasi_moora_kenyamanan',
            'nilai_optimasi_moora_luas_bangunan',
            'nilai_optimasi_moora_luas_parkir',
            'nilai_optimasi_moora_keramaian',
            'nilai_optimasi_moora_kebersihan',
            'nilai_optimasi_moora_fasilitas',
        ];

        $kolomMin = [
            'nilai_optimasi_moora_jarak_dengan_pusat_kota',
            'nilai_optimasi_moora_harga',
        ];

        $rankingFinals = [];
        $penguranganMaxminArray = [];

        foreach ($optimasiMoora as $key => $data) {
            $maxOptimasi = 0;

            foreach ($kolomMax as $kolom) {
                $maxOptimasi += $data[$kolom];
            }

            $minOptimasi = 0;

            foreach ($kolomMin as $kolom) {
                $minOptimasi += $data[$kolom];
            }

            $penguranganMaxmin = $maxOptimasi - $minOptimasi;
            $penguranganMaxminArray[$key] = $penguranganMaxmin;

            $rankingFinals[] = [
                'id_perhitungan' => $perhitunganID,
                'nama_restoran' => $data['nama_restoran'],
                'max_optimasi' => $maxOptimasi,
                'min_optimasi' => $minOptimasi,
                'pengurangan_maxmin' => $penguranganMaxmin,
            ];
        }

        arsort($penguranganMaxminArray);

        $rangkingMoora = [];
        $rank = 1;
        foreach ($penguranganMaxminArray as $key => $value) {
            $rangkingMoora[$key] = $rank;
            $rank++;
        }

        foreach ($rankingFinals as $key => $data) {
            $rankingFinals[$key]['ranking'] = $rangkingMoora[$key];
        }

        try {
            DB::table('ranking_finals')->insert($rankingFinals);
        } catch (\Exception $e) {
            // Handle error jika terjadi kesalahan saat menyimpan data
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.']);
        }

        $NilairankingFinals = DB::table('ranking_finals')
            ->where('id_perhitungan', $perhitunganID)
            ->get();

        $perhitunganKriteriaPerAlternatifData = DB::table('perhitungan_kriteria_per_alternatif')
            ->where('id', $perhitunganID)
            ->first();

        $nilaimaxbenefitData = DB::table('nilai_max_tiap_alternatif_benefit')
            ->where('id', $perhitunganID)
            ->first();

        $nilaimincostData = DB::table('nilai_min_tiap_alternatif_cost')
            ->where('id', $perhitunganID)
            ->first();

        $nilaiEntropyNormalisasiData = DB::table('hasil_normalisasi_entropy')
            ->where('id', $perhitunganID)
            ->first();

        $perhitunganJumlahNormalisasiEntropyData = DB::table('jumlah_normalisasi_entropies')
            ->where('id', $perhitunganID)
            ->first();

        $perhitunganNilaiEntropyData = DB::table('tabel_nilai_entropies')
            ->where('id', $perhitunganID)
            ->first();

        $TabelTotalNilaiEntropyData = DB::table('tabel_total_nilai_entropies')
            ->where('id', $perhitunganID)
            ->first();

        $TabelTotalBobotEntropyData = DB::table('tabel_bobot_entropies')
            ->where('id', $perhitunganID)
            ->first();

        $NilaiNormalisasiMooraData = DB::table('normalisasi_moora')
            ->where('id', $perhitunganID)
            ->first();

        $NilaiOptimasiMooraData = DB::table('optimasi_moora')
            ->where('id', $perhitunganID)
            ->first();

        $NilairankingFinalsData = DB::table('ranking_finals')
            ->where('id', $perhitunganID)
            ->first();

        // Simpan ke tabel_histories
        $tabelHistories = new TabelHistory();
        $tabelHistories->id_perhitungan = $perhitunganID;
        $tabelHistories->id_kriteria_per_alternatif = $perhitunganKriteriaPerAlternatifData->id;
        $tabelHistories->id_nilai_max_benefit = $nilaimaxbenefitData->id;
        $tabelHistories->id_nilai_min_cost = $nilaimincostData->id;
        $tabelHistories->id_hasil_normalisasi_entropy = $nilaiEntropyNormalisasiData->id;
        $tabelHistories->id_jumlah_normalisasi_entropy = $perhitunganJumlahNormalisasiEntropyData->id;
        $tabelHistories->id_nilai_entropy_e = $perhitunganNilaiEntropyData->id;
        $tabelHistories->id_total_nilai_entropy = $TabelTotalNilaiEntropyData->id;
        $tabelHistories->id_bobot_entropy = $TabelTotalBobotEntropyData->id;
        $tabelHistories->id_normalisasi_moora = $NilaiNormalisasiMooraData->id;
        $tabelHistories->id_optimasi_moora = $NilaiOptimasiMooraData->id;
        $tabelHistories->id_ranking_final = $NilairankingFinalsData->id;
        // Assign nilai foreign key lainnya sesuai kebutuhan
        // dd($tabelHistories);

        $tabelHistories->save();


        $response = [
            'nilaimaxbenefit' => $nilaimaxbenefit,
            'nilaimincost' => $nilaimincost,
            'nilaiEntropyNormalisasi' => $nilaiEntropyNormalisasi,
            'jumlahNilaiNormalisasi' => $perhitunganJumlahNormalisasiEntropy,
            'nilaiEntropy' => $perhitunganNilaiEntropy,
            'TabelTotalNilaiEntropy' => $TabelTotalNilaiEntropy,
            'TabelTotalBobotEntropy' => $TabelTotalBobotEntropy,
            'NilaiNormalisasiMoora' => $NilaiNormalisasiMoora,
            'NilaiOptimasiMoora' => $NilaiOptimasiMoora,
            'NilairankingFinals' => $NilairankingFinals,
        ];

        return response()->json($response);
    }


    public function TambahDataKriteriaDanAlternatif(Request $request)
    {
        $request->validate([
            'judul_perhitungan' => 'required',
            'alternatif' => 'required|array',
            'alternatif.*.nama_restoran' => 'required',
            'alternatif.*.aksesbilitas' => 'required',
            'alternatif.*.keamanan' => 'required',
            'alternatif.*.kenyamanan' => 'required',
            'alternatif.*.luas_bangunan' => 'required',
            'alternatif.*.luas_parkir' => 'required',
            'alternatif.*.keramaian' => 'required',
            'alternatif.*.kebersihan' => 'required',
            'alternatif.*.fasilitas' => 'required',
            'alternatif.*.jarak_dengan_pusat_kota' => 'required',
            'alternatif.*.harga' => 'required',
        ]);

        $perhitungan = new Perhitungan();
        $perhitungan->judul_perhitungan = $request->judul_perhitungan;
        $perhitungan->waktu_perhitungan = now();
        $perhitungan->save();

        $perhitunganKriteriaPerAlternatifData = [];

        foreach ($request->alternatif as $alternatif) {
            $perhitunganKriteriaPerAlternatif = new PerhitunganKriteriaPerAlternatif();
            $perhitunganKriteriaPerAlternatif->id_perhitungan = $perhitungan->id;
            $perhitunganKriteriaPerAlternatif->nama_restoran = $alternatif['nama_restoran'];
            $perhitunganKriteriaPerAlternatif->aksesbilitas = $alternatif['aksesbilitas'];
            $perhitunganKriteriaPerAlternatif->keamanan = $alternatif['keamanan'];
            $perhitunganKriteriaPerAlternatif->kenyamanan = $alternatif['kenyamanan'];
            $perhitunganKriteriaPerAlternatif->luas_bangunan = $alternatif['luas_bangunan'];
            $perhitunganKriteriaPerAlternatif->luas_parkir = $alternatif['luas_parkir'];
            $perhitunganKriteriaPerAlternatif->keramaian = $alternatif['keramaian'];
            $perhitunganKriteriaPerAlternatif->kebersihan = $alternatif['kebersihan'];
            $perhitunganKriteriaPerAlternatif->fasilitas = $alternatif['fasilitas'];
            $perhitunganKriteriaPerAlternatif->jarak_dengan_pusat_kota = $alternatif['jarak_dengan_pusat_kota'];
            $perhitunganKriteriaPerAlternatif->harga = $alternatif['harga'];
            $perhitunganKriteriaPerAlternatif->save();

            $perhitunganKriteriaPerAlternatifData[] = $perhitunganKriteriaPerAlternatif;
        }



        $perhitunganTotalResponse = $this->PerhitunganTotal($perhitungan->id);

        $response = [
            'message' => 'Data berhasil disimpan',
            'perhitungan' => $perhitungan,
            'perhitungan_kriteria_per_alternatif' => $perhitunganKriteriaPerAlternatifData,
            'perhitungan_total' => $perhitunganTotalResponse,
        ];

        return response()->json($response, 201);
    }


}
