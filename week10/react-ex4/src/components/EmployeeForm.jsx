import React from "react";
import CheckboxInput from "./CheckboxInput";
import DatePicker from "./DatePicker";
import InputText from "./InputText";
import RadioButtonInput from "./RadioButtonInput";
import TextareaInput from "./TextareaInput";
import { useCallback } from "react";
function EmployeeForm() {
    const [formData, setFormData] = React.useState({
        name: "",
        age: "",
        dob: "",
        exp: "",
        hobbies: [],
        gender: "",
    });
    const handleChange = (e) => {
        const { name, value, type, checked } = e.target;

        if (type === "checkbox") {
            // Cập nhật danh sách hobbies khi checkbox thay đổi
            setFormData((prevData) => ({
                ...prevData,
                hobbies: checked
                    ? [...prevData.hobbies, value] // Thêm vào nếu checkbox được chọn
                    : prevData.hobbies.filter((item) => item !== value), // Loại bỏ nếu checkbox bị bỏ chọn
            }));
        } else {
            // Cập nhật các field khác
            setFormData({
                ...formData,
                [name]: value,
            });
        }
    };
    const handleRadioChange = (e) => {
        const { name, value } = e.target;   
        setFormData((prevData) => ({
            ...prevData,
            [name]: value,
        }));
    };

    const handleSubmit = (e) => {
        e.preventDefault(); // Ngăn chặn hành động mặc định của form
        alert("Thông tin nhân viên: " + JSON.stringify(formData, null, 2));
    }
    const handleDateChange = useCallback((date) => {
        setFormData((prev) => ({
            ...prev,
            dob: date,
        }));
    }, []);

    return (
        <div className="employee-form">
            <h1>Employee Form</h1>
            <p>Nhập thông tin nhân viên:</p>
            <form action="" onSubmit={handleSubmit} >
                <InputText name="name" label="Nhập tên"  value={formData.name} handleChange={handleChange} />
                <InputText name="age" label="Nhập tuổi" value={formData.age} handleChange={handleChange} />
                <DatePicker handleDateChange={handleDateChange} />
                <TextareaInput name="exp" value={formData.exp} handleChange={handleChange} />
                <CheckboxInput selectedCheckboxes={formData.hobbies} handleCheckboxChange={handleChange} />
                <RadioButtonInput selectedValue={formData.gender} handleRadioChange={handleRadioChange} />
                {/* <MultipleSelect /> */}
                <button type="submit">Gửi</button>
            </form>

            {/* <div style={{ marginTop: "20px" }}>
                <Link to="/">Quay về trang chủ</Link>
                <br />
                <Link to="/inputtext">Input text</Link>
                <br />
                <Link to="/checkbox">Input checkbox</Link>
                <br />
                <Link to="/radiobutton">Input radio</Link>
                <br />
                <Link to="/textarea">Input textarea</Link>
                <br />
                <Link to="/multiple">Input multiple select</Link>
                <br />
                <Link to="/datepicker">Input datepicker</Link>
            </div> */}
        </div>
    );
}
export default EmployeeForm;
