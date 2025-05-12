import React from "react";
import { useState } from "react";
import Search from "./Search";
function EmployeeForm() {
    const [employees, setEmployees] = useState([]);
    const [formData, setFormData] = useState({
        name: "",
        age: "",
        gender: "",
        dob: "",
        address: "",
    });

    const [searchTerm, setSearchTerm] = React.useState("");
    
    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData((prev) => ({ ...prev, [name]: value }));
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        const newEmployee = {
            ...formData,
            id: Date.now(),
        };
        setEmployees([...employees, newEmployee]);
        setFormData({ name: "", age: "", gender: "", dob: "", address: "" });
    };

    const handleDelete = (id) => {
        const newList = employees.filter((emp) => emp.id !== id);
        setEmployees(newList);
    }
    return (
        <div className="container">
            <h2 className="mt-5">Quản lý nhân viên</h2>
            <form className="form d-flex " onSubmit={handleSubmit}>
                <div className="mx-2">
                    <input
                        type="text"
                        name="name"
                        placeholder="Tên nhân viên"
                        value={formData.name}
                        onChange={handleChange}
                        className="form-control"
                        required
                    />
                </div>

                <div className="mx-2">
                    <input
                        type="number"
                        name="age"
                        placeholder="Tuổi"
                        value={formData.age}
                        onChange={handleChange}
                        className="form-control"
                        required
                    />
                </div>

                <div className="mx-2">
                    <select
                        name="gender"
                        value={formData.gender}
                        onChange={handleChange}
                        className="form-control"
                        required
                    >
                        <option value="">Chọn giới tính</option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                        <option value="Khác">Khác</option>
                    </select>
                </div>

                <div className="mx-2">
                    <input
                        type="date"
                        name="dob"
                        value={formData.dob}
                        max={new Date().toISOString().split("T")[0]} // chỉ cho phép chọn ngày trong quá khứ
                        onChange={handleChange}
                        className="form-control"
                        required
                    />
                </div>

                <div className="mx-2">
                    <input
                        type="text"
                        name="address"
                        placeholder="Địa chỉ"
                        value={formData.address}
                        onChange={handleChange}
                        className="form-control"
                        required
                    />
                </div>
                <div className="mx-2">
                    <button type="submit" className="btn btn-primary">Thêm</button>
                </div>
            </form>

            <Search searchTerm={searchTerm} onSearch={setSearchTerm} />
            <table className="table table-striped">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Tuổi</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th>Địa chỉ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {employees.map((emp) => (
                        <tr key={emp.id}>
                            <td>{emp.name}</td>
                            <td>{emp.age}</td>
                            <td>{emp.gender}</td>
                            <td>{emp.dob}</td>
                            <td>{emp.address}</td>
                            <td>
                                <button className="btn btn-danger btn-sm" onClick={() => handleDelete(emp.id)}>Xóa</button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}
export default EmployeeForm;
