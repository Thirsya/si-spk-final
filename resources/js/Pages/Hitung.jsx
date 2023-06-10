import { Navback } from "../components/navback"
import React from 'react'
import { useNavigate } from "react-router-dom";

export const Hitung = () => {
    const navigate = useNavigate()
    return (
        <>

            <Navback></Navback>

            <div className="container mb-5">
                <h1 className="pt-5">Halaman Perhitungan</h1>
                <div className="py-4">
                    <h3 className="p-4">Tabel Kriteria</h3>
                    <table className="table table-bordered" style={{ width: '50%' }}>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kriteria</th>
                                <th>Jenis Kriteria</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Aksesbilitas</td>
                                <td>Benefit</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Keamanan</td>
                                <td>Benefit</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Jarak dengan pusat kota</td>
                                <td>Cost</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Harga</td>
                                <td>Cost</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Kenyamanan</td>
                                <td>Benefit</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Luas Bangunan</td>
                                <td>Benefit</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Luas Parkir</td>
                                <td>Benefit</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Keramaian</td>
                                <td>Benefit</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Kebersihan</td>
                                <td>Benefit</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Fasilitas</td>
                                <td>Benefit</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div className="pb-4">
                    <h3 className="p-4">Tabel Pernyataan Kriteria</h3>
                    <div class="row">
                        <div class="col-6">
                            <div className="px-3">
                                <h5 style={{ fontWeight: 'bold' }}>C1 : Aksesbilitas</h5>
                                <table className="table table-bordered mx-auto" style={{ width: '85%' }}>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kondisi</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Sulit</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Sedang</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Mudah</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Sangat Mudah</td>
                                            <td>4</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div className="px-3">
                                <h5 style={{ fontWeight: 'bold' }}>C2 : Keamanan</h5>
                                <table className="table table-bordered mx-auto" style={{ width: '85%' }}>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kondisi</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Rendah</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Sedang</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Tinggi</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Sangat Tinggi</td>
                                            <td>4</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div className="px-3">
                                <h5 style={{ fontWeight: 'bold' }}>C3 : Jarak dengan pusat kota</h5>
                                <table className="table table-bordered mx-auto" style={{ width: '85%' }}>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kondisi</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>X &ge; 5km</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>3Km &le; X &lt; 5Km</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>1Km &le; X &lt; 3Km</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>X &lt; 1Km</td>
                                            <td>4</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div className="px-3">
                                <h5 style={{ fontWeight: 'bold' }}>C4 : Harga</h5>
                                <table className="table table-bordered mx-auto" style={{ width: '85%' }}>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kondisi</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>X &ge; Rp.75.000</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Rp.50.000 &le; X &lt; Rp.75.000</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Rp.25.000 &le; X &lt; Rp.50.000</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Rp.10.000 &le; X &lt; Rp.25.000</td>
                                            <td>4</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div className="px-3">
                                <h5 style={{ fontWeight: 'bold' }}>C5 : Kenyamanan</h5>
                                <table className="table table-bordered mx-auto" style={{ width: '85%' }}>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kondisi</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Kurang Nyaman</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Cukup Nyaman</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Nyaman</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Sangat Nyaman</td>
                                            <td>4</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="col-6">
                            <div className="px-3">
                                <h5 style={{ fontWeight: 'bold' }}>C6 : Luas Bangunan</h5>
                                <table className="table table-bordered mx-auto" style={{ width: '85%' }}>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kondisi</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>100 m <sup>2</sup></td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>200 m <sup>2</sup></td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>300 m <sup>2</sup></td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>X &ge; 400 m <sup>2</sup></td>
                                            <td>4</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div className="px-3">
                                <h5 style={{ fontWeight: 'bold' }}>C7 : Luas Parkir </h5>
                                <table className="table table-bordered mx-auto" style={{ width: '85%' }}>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kondisi</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>5 m <sup>2</sup></td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>6 m <sup>2</sup></td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>7 m <sup>2</sup></td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>X &ge; 8 m <sup>2</sup></td>
                                            <td>4</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div className="px-3">
                                <h5 style={{ fontWeight: 'bold' }}>C8 : Keramaian</h5>
                                <table className="table table-bordered mx-auto" style={{ width: '85%' }}>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kondisi</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Kurang Ramai</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Cukup Ramai</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Ramai</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Sangat Ramai</td>
                                            <td>4</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div className="px-3">
                                <h5 style={{ fontWeight: 'bold' }}>C9 : Kebersihan</h5>
                                <table className="table table-bordered mx-auto" style={{ width: '85%' }}>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kondisi</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Kurang Bersih</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Cukup Bersih</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Bersih</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Sangat Bersih</td>
                                            <td>4</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div className="px-3">
                                <h5 style={{ fontWeight: 'bold' }}>C10 : Fasilitas</h5>
                                <table className="table table-bordered mx-auto" style={{ width: '85%' }}>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kondisi</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>meja, kursi</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>meja, kursi, lesehan</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>meja, kursi, lesehan, wifi, mushola</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>meja, kursi, lesehan, wifi, mushola, outdoor, indoor</td>
                                            <td>4</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

                <div className="border border-2 p-3">
                    <h3 className="mb-5 p-3">Form Input Data</h3>
                    <form action="">
                        <div className="ps-5" style={{ width: '50%' }}>
                            <div className="mb-5">
                                <label htmlFor="judul" className="form-label">Judul Perhitungan</label>
                                <input type="text" className="form-control" id="judul" required />
                            </div>
                            <p className="m-0">Contoh Inputan Excel</p>
                            <img src="img/contoh.png" alt="" className="p-3" />
                            <div className="my-5" style={{ width: '150%' }}>
                                <div className="d-flex">
                                    <div className="">
                                        <label htmlFor="excel" className="form-label">Input Data Kiteria per alternatif</label><br />
                                        <input type="file" className="form-control" id="excel" required />
                                    </div>
                                    <button type="button" className="btn btn-success btn-sm text-white m-3" >pilih</button>
                                </div>
                            </div>
                            <div className="py-4">
                                <h3 className="p-4">Preview Data</h3>
                                <form action="">
                                    <table className="table table-bordered" style={{ width: '180%' }}>
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Siswa</th>
                                                <th>C1</th>
                                                <th>C2</th>
                                                <th>C3</th>
                                                <th>C4</th>
                                                <th>C5</th>
                                                <th>C6</th>
                                                <th>C7</th>
                                                <th>C8</th>
                                                <th>C9</th>
                                                <th>C10</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Katsu Kyodai</td>
                                                <td><input type="number" required value="1" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="4" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="2" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="2" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="3" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="4" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="3" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="2" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="4" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="3" style={{ width: '40px', border: 'none' }} /></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Warunk WOW KWB - Malang</td>
                                                <td><input type="number" required value="2" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="4" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="2" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="2" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="3" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="1" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="4" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="3" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="3" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="4" style={{ width: '40px', border: 'none' }} /></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Ayam goreng nelongso</td>
                                                <td><input type="number" required value="4" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="2" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="1" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="3" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="3" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="2" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="4" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="4" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="3" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="2" style={{ width: '40px', border: 'none' }} /></td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Sate dan Bakso Abah Acil</td>
                                                <td><input type="number" required value="2" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="2" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="1" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="3" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="4" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="3" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="3" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="2" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="4" style={{ width: '40px', border: 'none' }} /></td>
                                                <td><input type="number" required value="4" style={{ width: '40px', border: 'none' }} /></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <div className="d-flex flex-row-reverse" style={{ width: '200%' }}>
                                <button type="submit" className="btn btn-success btn-lg text-white m-3" onClick={() => navigate('/langkah')} >Hitung</button>
                                <button type="reset" className="btn btn-danger btn-lg text-white m-3" >Reset</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </>
    );
}

export default Hitung;