import { Navback } from "../components/navback"
import React from 'react'
import { useNavigate } from "react-router-dom";
import * as XLSX from 'xlsx';
import { useState } from 'react';

export const Hitung = () => {
    const navigate = useNavigate()
    const [jsonData, setJsonData] = useState([]);


    const [formData, setFormData] = useState({
        judul_perhitungan: 'Judul 1',
        alternatif: []

    });

    // console.log(formData)

    const handleChange = (event, index) => {
        const { name, value } = event.target;
        const updatedFormData = { ...formData };


        updatedFormData.alternatif[index] = { ...updatedFormData.alternatif[index], [name]: value };
        setFormData(updatedFormData);

        // updatedFormData.alternatif[index][name] = value;
        // setRows(updatedRows);
        // console.log(updatedFormData);
    };

    const handleSubmit = (event) => {
        event.preventDefault();

        const submitJsonData = JSON.stringify(formData);

        // console.log(formData);

        fetch('http://127.0.0.1:8000/api/inputKriteriaAlternatif', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: submitJsonData,
        })
            .then(response => response.json())
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'yey',
                    text: 'Data input Success!',
                })
                navigate('/langkah', { state: { data } });
                // // Lakukan sesuatu setelah berhasil mengirim form
                // // navigate('/langkah');
                // console.log(data);

            })
            .catch(error => {
                // Tangani error jika terjadi
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error,
                })
            });
    };


    const convertExcelToJson = (file) => {
        const reader = new FileReader();

        reader.onload = (e) => {
            const data = new Uint8Array(e.target.result);
            const workbook = XLSX.read(data, { type: 'array' });

            const sheetName = workbook.SheetNames[0]; // Menggunakan sheet pertama
            const worksheet = workbook.Sheets[sheetName];

            const jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1, raw: true, defval: "" });

            // console.log(jsonData); // JSON hasil konversi
            // setJsonData(jsonData);

            const headers = jsonData[0]; // Header baris pertama
            const dataRows = jsonData.slice(1); // Baris data (mulai dari baris kedua)

            const result = dataRows.map((row) => {
                const obj = {};
                headers.forEach((header, index) => {
                    obj[header] = row[index];
                });
                return obj;
            });

            console.log(result); // JSON hasil konversi
            setJsonData(result);

            const updatedFormData = { ...formData };


            updatedFormData.alternatif = result;
            setFormData(updatedFormData);
        };

        reader.readAsArrayBuffer(file);
    };

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
                    <div className="row">
                        <div className="col-6">
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
                        <div className="col-6">
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
                    <form action="POST" onSubmit={handleSubmit}>
                        <div className="ps-5" style={{ width: '50%' }}>
                            <div className="mb-5">
                                <label htmlFor="judul" className="form-label">Judul Perhitungan</label>
                                <input type="text" className="form-control" name="judul_perhitungan" value={formData.judul_perhitungan} onChange={(event) => setFormData({ ...formData, judul_perhitungan: event.target.value })} required />
                            </div>
                            <p className="m-0">Contoh Inputan Excel</p>
                            <img src="img/contoh.png" alt="" className="p-3" />
                            <div className="my-5" style={{ width: '150%' }}>
                                <div className="d-flex">
                                    <div className="">
                                        <label htmlFor="excel" className="form-label">Input Data Kiteria per alternatif</label><br />
                                        <input type="file" className="form-control" id="excel" required onChange={(e) => convertExcelToJson(e.target.files[0])} />
                                    </div>
                                </div>
                            </div>
                            <div className="py-4">
                                <h3 className="p-4">Preview Data</h3>
                                <table className="table table-bordered" style={{ width: '180%' }} id="kriteria-table" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Restoran</th>
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
                                        {jsonData.map((data, index) => (
                                            <tr key={index} >
                                                <td>{index + 1}</td>
                                                <td>
                                                    <input type="text" name="nama_restoran" required defaultValue={data.nama_restoran} style={{ border: 'none' }} onChange={(event) => handleChange(event, index)} />
                                                </td>
                                                <td>
                                                    <input type="number" name="aksesbilitas" required defaultValue={data.aksesbilitas} style={{ width: '40px', border: 'none' }} onChange={(event) => handleChange(event, index)} />
                                                </td>
                                                <td>
                                                    <input type="number" name="keamanan" required defaultValue={data.keamanan} style={{ width: '40px', border: 'none' }} onChange={(event) => handleChange(event, index)} />
                                                </td>
                                                <td>
                                                    <input type="number" name="jarak_dengan_pusat_kota" required defaultValue={data.jarak_dengan_pusat_kota} style={{ width: '40px', border: 'none' }} onChange={(event) => handleChange(event, index)} />
                                                </td>
                                                <td>
                                                    <input type="number" name="harga" required defaultValue={data.harga} style={{ width: '40px', border: 'none' }} onChange={(event) => handleChange(event, index)} />
                                                </td>
                                                <td>
                                                    <input type="number" name="kenyamanan" required defaultValue={data.kenyamanan} style={{ width: '40px', border: 'none' }} onChange={(event) => handleChange(event, index)} />
                                                </td>
                                                <td>
                                                    <input type="number" name="luas_bangunan" required defaultValue={data.luas_bangunan} style={{ width: '40px', border: 'none' }} onChange={(event) => handleChange(event, index)} />
                                                </td>
                                                <td>
                                                    <input type="number" name="luas_parkir" required defaultValue={data.luas_parkir} style={{ width: '40px', border: 'none' }} onChange={(event) => handleChange(event, index)} />
                                                </td>
                                                <td>
                                                    <input type="number" name="keramaian" required defaultValue={data.keramaian} style={{ width: '40px', border: 'none' }} onChange={(event) => handleChange(event, index)} />
                                                </td>
                                                <td>
                                                    <input type="number" name="kebersihan" required defaultValue={data.kebersihan} style={{ width: '40px', border: 'none' }} onChange={(event) => handleChange(event, index)} />
                                                </td>
                                                <td>
                                                    <input type="number" name="fasilitas" required defaultValue={data.fasilitas} style={{ width: '40px', border: 'none' }} onChange={(event) => handleChange(event, index)} />
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                            <div className="d-flex flex-row-reverse" style={{ width: '200%' }}>
                                {/* <button type="submit" className="btn btn-success btn-lg text-white m-3" onClick={() => navigate('/langkah')} >Hitung</button> */}
                                <button type="submit" className="btn btn-success btn-lg text-white m-3">Hitung</button>
                                <button type="reset" className="btn btn-danger btn-lg text-white m-3" >Reset</button>
                            </div>
                        </div>
                    </form>
                </div >

            </div >
        </>
    );
}

export default Hitung;