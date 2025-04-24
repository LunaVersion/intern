import React from "react";
// import {Link} from 'react-router-dom';

function RadioButtonInput({selectedValue, handleRadioChange}) {
    // const handleSubmit = (event) => {
    //     event.preventDefault(); // Ngăn chặn hành động mặc định của form    
    //     const selectedValue = document.querySelector('input[name="radio"]:checked').value;
    //     alert("Giới tính của bạn là: " + selectedValue);
    // }
    return (
        <div className="radio-button-input container">
            {/* <h1>Radio Button Input</h1> */}
            <p>Chọn giới tính của bạn:</p>
            {/* <form onSubmit={handleSubmit} > */}
            <input type="radio" id="nam" name="gender" value="Nam" 
            checked={selectedValue === "Nam"}
            onChange={handleRadioChange}
            />
            <label className="ms-2" htmlFor="nam">Nam</label>
            <br />
            <input type="radio" id="nữ" name="gender" value="Nữ" 
            checked={selectedValue === "Nữ"}
            onChange={handleRadioChange}
            />
            <label className="ms-2" htmlFor="nữ">Nữ</label>
            <br />
            <input type="radio" id="khác" name="gender" value="Khác" 
            checked={selectedValue === "Khác"}
            onChange={handleRadioChange}
            />
            <label className="ms-2" htmlFor="khác">Khác</label>
            <br />
            {/* <button type="submit">Submit</button> */}
            {/* </form> */}
            
            {/* <div style={{ marginTop: "20px" }}>
                <Link to="/">Quay về trang chủ</Link>
                <br />
                <Link to="/inputtext">Input text</Link>
                <br />
                <Link to="/checkbox">Input checkbox</Link>
                <br />
                <Link to="/textarea">Input textarea</Link>
                <br />
                <Link to="/datepicker">Input datepicker</Link>
                <br />
                <Link to="/multiple">Input multiple select</Link>
            </div> */}
        </div>
    );
}   

export default RadioButtonInput;