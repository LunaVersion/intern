import React, { useState } from 'react';

function MyForm() {
  const [name, setName] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault(); // Ngăn trang reload
    alert('Tên của bạn là: ' + name);
  };

  return (
    // khi gửi form thì handleSubmit được gọi
    <form onSubmit={handleSubmit}>
      <label>Nhập tên:</label>
      <input
        type="text"
        value={name} // giá trị của input sẽ lấy từ state name
        // khi nhập input thì sẽ gọi hàm setName để cập nhật lại state name 
        onChange={(e) => setName(e.target.value)}
      />
      <button type="submit">Gửi</button>
    </form>
  );
}

export default MyForm;
