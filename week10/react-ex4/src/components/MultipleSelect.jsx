import React from "react";
import { useState } from "react";
// import { Link } from 'react-router-dom';
function Multipleselect() {
    // Tạo state để lưu trữ các giá trị đã chọn
    //selectedOptions là tên state, setSelectedOptions là hàm để cập nhật state
    // useState([]) là giá trị khởi tạo của state: mảng rỗng
    const [selectedOptions, setSelectedOptions] = useState([]);

    const handleChange = (event) => {
        // Lấy tất cả các giá trị đã chọn từ select
        // và cập nhật state selectedOptions
        const value = Array.from(
            event.target.selectedOptions,
            (option) => option.value
        );
        setSelectedOptions(value);
    };

    //------------------------------------------------
    // không cần giữ Ctrl
    const [selectedOptionsNoCtrl, setSelectedOptionsNoCtrl] = useState([]);
    const handleSelectChangeNoCtrl = (event) => {
        const value = event.target.value;
        // Kiểm tra xem giá trị đã tồn tại trong mảng chưa
        if (selectedOptionsNoCtrl.includes(value)) {
            // Nếu đã tồn tại thì xóa nó khỏi mảng
            setSelectedOptionsNoCtrl(selectedOptionsNoCtrl.filter((item) => item !== value));
        } else {
            // Nếu chưa tồn tại thì thêm nó vào mảng
            setSelectedOptionsNoCtrl([...selectedOptionsNoCtrl, value]);
        }
    }
    const handleRemove = (value) => {
        setSelectedOptionsNoCtrl(selectedOptionsNoCtrl.filter((item) => item !== value));
    };
    return (
        <div className="container" style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '200px' }}>
            {/*phải giữ Ctrl mới chọn được nhiều */}
            <div className="use-select">
                <h3>Chọn các sở thích của bạn</h3>
                <i>Ấn giữ Ctrl để chọn nhiều</i> <br />
                <select multiple value={selectedOptions} onChange={handleChange}
                    style={{ width: "200px", height: "150px" }}
                >
                    <option value="Bơi lội">Bơi lội</option>
                    <option value="Chơi cầu lông">Chơi cầu lông  </option>
                    <option value="Bóng đá">Bóng đá</option>
                    <option value="Hát">Hát</option>
                    <option value="Vẽ">Vẽ</option>
                    <option value="Đi du lịch">Đi du lịch</option>
                    <option value="Đi leo núi">Đi leo núi</option>
                </select>
                <p>Các sở thích của bạn là: {selectedOptions.join(", ")}</p>
            </div>

            {/* No ctrl */}
            <div className="use-select-co-ctrl">
                <h3>Chọn các sở thích của bạn</h3>
                <select multiple onChange={handleSelectChangeNoCtrl}
                    style={{ width: "200px", height: "150px" }}
                >
                    <option value="Bơi lội">Bơi lội</option>
                    <option value="Chơi cầu lông">Chơi cầu lông  </option>
                    <option value="Bóng đá">Bóng đá</option>
                    <option value="Hát">Hát</option>
                    <option value="Vẽ">Vẽ</option>
                    <option value="Đi du lịch">Đi du lịch</option>
                    <option value="Đi leo núi">Đi leo núi</option>
                </select>
                <div>
                    <h3>Các sở thích đã chọn:</h3>
                    <ul>
                        {selectedOptionsNoCtrl.map((option, index) => (
                            <li key={index}>
                                {option} <button onClick={() => handleRemove(option)}>Xóa</button>
                            </li>
                        ))}
                    </ul>
                </div>
            </div>
            {/* <div>
                <Link to="/inputtext">Input text</Link>
                <br />
                <Link to="/checkbox">Input checkbox</Link>
                <br />
                <Link to="/radiobutton">Input radio</Link>
                <br />
                <Link to="/textarea">Input textarea</Link>
                <br />
                <Link to="/datepiker">Input datepicker</Link>
            </div> */}
        </div>
    );
}

export default Multipleselect;