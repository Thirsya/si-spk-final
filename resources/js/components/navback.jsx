import React from "react";
import { useNavigate } from "react-router-dom";

export const Navback = () => {
    const navigate = useNavigate()
    return (
        <nav className="navbar" style={{ backgroundColor: '#617efe' }}>
            <div className="container-fluid p-2">
                <button type="button" className="btn btn-sm text-white" onClick={() => navigate("/")} style={{ backgroundColor: '#617efe' }} >Kembali</button>
            </div>
        </nav>
    );
};
