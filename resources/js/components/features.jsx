import React from "react";

export const Features = (props) => {
  return (
    <div id="features" className="text-center p-5">
      <div className="container">
        <div className="section-title">
          <h2>Fitur-Fitur</h2>
        </div>
        <div className="d-flex justify-content-center gx-5">
          {props.data
            ? props.data.map((d, i) => (
              <div key={`${d.title}-${i}`} className="col-md">
                {" "}
                <i className={d.icon}></i>
                <h3>{d.title}</h3>
                <p>{d.text}</p>
              </div>
            ))
            : "Loading..."}
        </div>
      </div>
    </div>
  );
};
