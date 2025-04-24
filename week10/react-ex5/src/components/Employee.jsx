// components/EmployeeList.js
import React from "react";
import employees from "../data/employees";
import "../css/EmployeeList.css";
import Search from "./Search";
function Employee() {
    const [searchTerm, setSearchTerm] = React.useState("");

    const filteredEmployees = employees.filter((emp) => 
        emp.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
        emp.adress.toLowerCase().includes(searchTerm.toLowerCase()) ||
        emp.dob.includes(searchTerm) ||
        emp.age.toString().includes(searchTerm) 
    );
    return (
        <div className="container">
            <h2 className="mt-5">Quản lý nhân viên</h2>
            <div className="scrollable">
            <Search searchTerm={searchTerm} onSearch={setSearchTerm} />
                <table cellPadding="10" className="table table-striped table-bordered">
                    <thead className="thead">
                        <tr>
                            <th>Tên</th>
                            <th>Tuổi</th>
                            <th>Giới tính</th>
                            <th>Ngày sinh</th>
                            <th>Địa chỉ</th>
                        </tr>
                    </thead>
                    <tbody>
                        {filteredEmployees.map((emp) => (
                            <tr key={emp.id}>
                                <td>{emp.name}</td>
                                <td>{emp.age}</td>
                                <td>{emp.gender}</td>
                                <td>{emp.dob}</td>
                                <td>{emp.adress}</td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    );
}

export default Employee;
