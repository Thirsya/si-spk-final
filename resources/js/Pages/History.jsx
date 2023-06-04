import { Navback } from "../components/navback"
import React from 'react'
import { useNavigate } from "react-router-dom";

export const History = () => {
    const navigate = useNavigate()
    return (
        <>
            <Navback></Navback>
            <div className="container py-5">
                <h1 className="mb-5 ">Halaman History Pengerjaan</h1>
                <table className="table table-bordered mb-5 table-striped text-center" style={{ width: '75%' }}>
                    <thead className="table-secondary">
                        <tr>
                            <th>No</th>
                            <th>Judul Perhitungan</th>
                            <th>Tanggal Perhitungan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Perhitungan 1</td>
                            <td>01/06/2023</td>
                            <td>
                                <button className="btn btn-sm btn-info text-white" type="button" onClick={() => navigate('/langkah')}>Detail</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Perhitungan 2</td>
                            <td>01/06/2023</td>
                            <td>
                                <button className="btn btn-sm btn-info text-white" type="button" onClick={() => navigate('/langkah')}>Detail</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Perhitungan 3</td>
                            <td>01/06/2023</td>
                            <td>
                                <button className="btn btn-sm btn-info text-white" type="button" onClick={() => navigate('/langkah')}>Detail</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </>
    );
}

export default History