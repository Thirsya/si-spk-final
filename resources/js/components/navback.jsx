import React from "react";
import { useNavigate } from "react-router-dom";

export const Navback = () => {
    const navigate = useNavigate()
    return (
        <nav className="navbar" style={{ backgroundColor: '#D5D5D5' }}>
            <div className="container-fluid p-2">
                <button type="button" className="btn btn-info btn-sm text-white" onClick={() => navigate("/")} >Kembali</button>
            </div>
        </nav>
    );
};
