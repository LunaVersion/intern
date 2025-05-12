import React from "react";
import { useState, useEffect } from "react";
import axios from "axios";
import Search from "./SearchEmployee";
function Employee() {
    const [employees, setEmployees] = useState([]);
    useEffect(() => {
        fetchUsers();
    }, []);
    
    const [newEmployee, setNewEmployee] = useState({
        name: '',
        age: '',
        gender: '',
        dob: '',
        address: ''
    });
    const [editModalVisible, setEditModalVisible] = useState(false); // Điều khiển Modal
    const [employeeToEdit, setEmployeeToEdit] = useState(null); // Nhân viên cần sửa

    const fetchUsers = async () => {
        try {
            const response = await axios.get('http://localhost:8000/api/users'); 
            setEmployees(response.data); // Trả về dữ liệu người dùng trực tiếp từ response.data
        } catch (error) {
            console.error('Lỗi lấy nhân viên:', error);
        }
    };

    const validateForm = () => {
        const errors = {};

        if(!/^[\p{L}\s]+$/u.test(newEmployee.name) || newEmployee.name.length < 2) {
            errors.name = "Tên nhân viên không hợp lệ, không được chứa số và kí tự đặc biệt!";
        }
        if(!Number.isInteger(Number(newEmployee.age)) || newEmployee.age < 18 || newEmployee.age > 65) {
            errors.age = "Tuổi nhân viên không hợp lệ, phải từ 18 đến 65 tuổi!";
        }
        if(!/^[\p{L}0-9\s,.\-/]+$/u.test(newEmployee.address) || newEmployee.address.length < 2) {
            errors.address = "Địa chỉ không hợp lệ, chỉ chứa chữ cái, số, khoảng trắng, dấu phẩy, dấu chấm, gạch ngang, gạch chéo!";
        }

        return errors;
        
    }

    // Xử lý khi người dùng nhập vào form
    const handleInputChange = (e) => {
        const { name, value } = e.target;   
        setNewEmployee(prevState => ({
            ...prevState,
            [name]: value
        }));
    };

    // Gửi dữ liệu nhân viên mới lên server
    const handleSubmit = async (e) => {
        e.preventDefault(); // Ngăn form reload lại trang

        const errors = validateForm();
        if (Object.keys(errors).length > 0) {
            alert(Object.values(errors).join('\n')); // hiện lỗi và ko làm gì cả
            return;
        }

        try {
            const response = await axios.post('http://localhost:8000/api/users', newEmployee);
            //setEmployees([...employees, response.data]); // Thêm nhân viên mới vào danh sách
            setNewEmployee({
                name: '',
                age: '',
                gender: '',
                dob: '',
                address: ''
            }); // Reset form sau khi thêm
            fetchUsers(); // Cập nhật danh sách nhân viên
        } catch (error) {
            console.error('Lỗi thêm nhân viên:', error);
        }
    };
    const handleDelete = async (id) => {
        const comfirmDelete = window.confirm("Bạn có chắc chắn muốn xóa nhân viên này không?");
        if (!comfirmDelete) return; // Nếu không xác nhận thì không làm gì cả
        try {
            await axios.delete(`http://localhost:8000/api/users/${id}`); // Gọi API xóa nhân viên
            setEmployees(employees.filter(emp => emp.id !== id)); // Cập nhật danh sách nhân viên sau khi xóa
        } catch (error) {
            console.error('Lỗi xóa nhân viên:', error);
        }
    }

    // edit

    const closeModel = () => {
        setEditModalVisible(false); // Đóng modal
        setEmployeeToEdit(null); // Reset nhân viên cần sửa
    };

    const openModal = (emp) => {
        setEditModalVisible(true); // Mở modal
        setEmployeeToEdit(emp); // Nhân viên cần sửa
    };

    const validateEditForm = () => {
        const errors = {};

        if(!/^[\p{L}\s]+$/u.test(employeeToEdit.name) || employeeToEdit.name.length < 2) {
            errors.name = "Tên nhân viên không hợp lệ, không được chứa số và kí tự đặc biệt!";
        }
        if(!Number.isInteger(Number(employeeToEdit.age)) || employeeToEdit.age < 18 || employeeToEdit.age > 65) {
            errors.age = "Tuổi nhân viên không hợp lệ, phải từ 18 đến 65 tuổi!";
        }
        if(!/^[\p{L}0-9\s,.\-/]+$/u.test(employeeToEdit.address) || employeeToEdit.address.length < 2) {
            errors.address = "Địa chỉ không hợp lệ, chỉ chứa chữ cái, số, khoảng trắng, dấu phẩy, dấu chấm, gạch ngang, gạch chéo!";
        }

        return errors;
    }

    const handleEditSubmit = async (e) => {
        e.preventDefault();

        const errors = validateEditForm();
        if (Object.keys(errors).length > 0) {
            alert(Object.values(errors).join('\n')); // hiện lỗi nếu có lỗi validate
            return;
        }

        try {
            const response = await axios.put(`http://localhost:8000/api/users/${employeeToEdit.id}`, employeeToEdit);
            setEmployees(employees.map(emp => (emp.id === employeeToEdit.id ? response.data : emp)));
            // không cần thiết phải rest form
            closeModel();
        }catch (error) {
            console.error('Lỗi sửa nhân viên:', error);
        }
    }

    // search
    const [searchTerm, setSearchTerm] = useState('');
    const [filteredEmployees, setFilteredEmployees] = useState([]);

    useEffect(() => {
        const lowerSearch = searchTerm.toLowerCase();
      
        const filteredEmployees = employees.filter(emp =>
          (emp.name && emp.name.toLowerCase().includes(lowerSearch)) ||
          (emp.address && emp.address.toLowerCase().includes(lowerSearch)) ||
            emp.dob.includes(searchTerm) ||
            emp.age.toString().includes(searchTerm) 
        );
        setFilteredEmployees(filteredEmployees);
    }, [employees, searchTerm]);
    
    return (
        <div className="container">
            <h2 className="mt-5">Quản lý nhân viên</h2>
            <form onSubmit={handleSubmit} className="form d-flex " >
                <div className="mx-2">
                    <input
                        type="text"
                        name="name"
                        placeholder="Tên nhân viên"
                        className="form-control"
                        value={newEmployee.name}
                        onChange={handleInputChange}
                        required
                    />
                </div>

                <div className="mx-2">
                    <input
                        type="number"
                        name="age"
                        placeholder="Tuổi"
                        className="form-control"
                        value={newEmployee.age}
                        onChange={handleInputChange}
                        required
                    />
                </div>

                <div className="mx-2">
                    <select
                        name="gender"
                        className="form-control"
                        value={newEmployee.gender}
                        onChange={handleInputChange}
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
                        max={new Date().toISOString().split("T")[0]} // chỉ cho phép chọn ngày trong quá khứ
                        className="form-control"
                        value={newEmployee.dob}
                        onChange={handleInputChange}
                        required
                    />
                </div>

                <div className="mx-2">
                    <input
                        type="text"
                        name="address"
                        placeholder="Địa chỉ"
                        className="form-control"
                        value={newEmployee.address}
                        onChange={handleInputChange}
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
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    {Array.isArray(filteredEmployees) && filteredEmployees.map((emp) => (
                        <tr key={emp.id}>
                            <td>{emp.name}</td>
                            <td>{emp.age}</td>
                            <td>{emp.gender}</td>
                            <td>{emp.dob}</td>
                            <td>{emp.address}</td>
                            <td>
                                <button onClick={()=>openModal(emp)} className="btn btn-primary btn-sm">Sửa</button>
                            </td>
                            <td>
                                
                                <button onClick={() => handleDelete(emp.id)} className="btn btn-danger btn-sm">Xóa</button>

                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
            
            {editModalVisible && employeeToEdit && (
                <div style={{ backgroundColor: 'rgba(0,0,0,0.5)', position: 'fixed', top: 0, left: 0, right: 0, bottom: 0, display: 'flex', justifyContent: 'center', alignItems: 'center' }}>
                <div style={{ backgroundColor: 'white', padding: '20px', border: '1px solid #ccc', width: '400px' }}>
                    <h4>Sửa thông tin nhân viên</h4>
                    <form onSubmit={handleEditSubmit}>
                        <input
                            type="hidden"
                            value={employeeToEdit.id}
                        />
                        <div>
                            <label>Tên:</label>
                            <input
                                className="form-control"
                                type="text"
                                value={employeeToEdit.name}
                                onChange={(e) => setEmployeeToEdit({ ...employeeToEdit, name: e.target.value })}
                                required
                            />
                        </div>
                        <div>
                            <label>Tuổi:</label>
                            <input
                                className="form-control"
                                type="number"
                                value={employeeToEdit.age}
                                onChange={(e) => setEmployeeToEdit({ ...employeeToEdit, age: e.target.value })}
                                required
                            />
                        </div>
                        <div>
                            <label>Giới tính:</label>
                            <select className="form-control"
                                value={employeeToEdit.gender}
                                onChange={e => setEmployeeToEdit({ ...employeeToEdit, gender: e.target.value })}
                                required
                            >
                                <option value="">Chọn giới tính</option>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                        <div>
                            <label>Ngày sinh:</label>
                            <input
                                type="date"
                                className="form-control"
                                value={employeeToEdit.dob}
                                onChange={(e) => setEmployeeToEdit({ ...employeeToEdit, dob: e.target.value })}
                                required
                            />
                        </div>
                        <div>
                            <label>Địa chỉ:</label>
                            <input
                                type="text"
                                className="form-control"
                                value={employeeToEdit.address}
                                onChange={(e) => setEmployeeToEdit({ ...employeeToEdit, address: e.target.value })}
                                required
                            />
                        </div>
                        
                        <div>
                            <button type="submit" className="btn btn-primary">Lưu</button>
                            <button type="button" onClick={() => setEditModalVisible(false)} className="btn btn-secondary">Hủy</button>
                        </div>
                    </form>
                </div>
            </div>
            )}
            

        </div>
    );
}
export default Employee;
