import React from "react";
import ReactDOM from "react-dom";

import "../css/app.css";
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'
import { Home } from "./Pages/Home.jsx";
import { Hitung } from "./Pages/Hitung.jsx"
import { Langkah } from "./Pages/Langkah.jsx"
import { History } from "./Pages/History.jsx"
import { createRoot } from 'react-dom';


export const App = () => {

  return (
    <Router>
      <Routes>
        <Route index element={<Home />} />
        <Route path="/hitung" element={<Hitung />} />
        <Route path="/langkah" element={<Langkah />} />
        <Route path="/history" element={<History />} />
      </Routes>
    </Router>
  );
};

export default App;

if (document.getElementById('app')) {
  createRoot(document.getElementById('app')).render(<App />);
}
