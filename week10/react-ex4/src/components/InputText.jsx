import React from "react";
// import { useState } from "react";
// import { Link } from 'react-router-dom';
function InputText({ name, value, label, handleChange }) {
    // const [inputName, setName] = useState("");
    // const [inputAge, setAge] = useState("");
    // const handleSubmit = (e) => {
    //     e.preventDefault(); // Ngăn trang reload
    //     alert("Tên của bạn là: " + inputName + ", tuổi của bạn là: " + inputAge);
    // }
    // const handleChange = (e) => {   
    //     const { name, value } = e.target;
    //     if (name === "inputName") {
    //         setName(value);
    //     } else if (name === "inputAge") {
    //         setAge(value);
    //     }
    // }
    return (
        <div>
            <div className="input-text container">
                {/* <h3>Input text</h3> */}
                {/* <form onSubmit={handleSubmit}> */}
                <div>
                    <label className="form-label">{label}</label>
                    <input
                        type="text"
                        className="form-control"
                        name={name}
                        value={value} // giá trị của input sẽ lấy từ state name
                        onChange={handleChange}
                    />
                </div>
                {/* <div>
                        <label> </label>
                        <input
                            type="number"
                            className="form-control"
                            placeholder="Nhập tuổi của bạn"
                            name={inputAge}
                            value={inputAge} // giá trị của input sẽ lấy từ state age
                            // khi nhập input thì sẽ gọi hàm setAge để cập nhật lại state age 
                            onChange={handleChange}
                        />
                    </div> */}
                {/* <button type="submit">Gửi</button> */}
                {/* </form> */}
            </div>
            {/* <div style={{ marginTop: "20px" }}>
                <Link to="/">Quay về trang chủ</Link>
                <br />
                <Link to="/checkbox">Input checkbox</Link>
                <br />
                <Link to="/radiobutton">Input radio</Link>
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
export default InputText;