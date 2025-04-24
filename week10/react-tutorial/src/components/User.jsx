import React, { useState } from 'react';

function UserList() {
  const [users, setUsers] = useState([
    { id: 1, name: 'John', age: 30 },
    { id: 2, name: 'Jane', age: 25 },
    { id: 3, name: 'Alice', age: 28 }
  ]);

  // thêm người dùng Bob mỗi lần nhấn nút
  const addUser = () => {
    const newUser = { id: 4, name: 'Bob', age: 35 };
    setUsers([...users, newUser]); 
  };

  const removeUser = (id) => {
    setUsers(users.filter(user => user.id !== id));
  };

  return (
    <div>
      <button onClick={addUser}>Add User</button>
      <ul>
        {users.map(user => (
          <li key={user.id}>
            {user.name}, {user.age} years old
            <button onClick={() => removeUser(user.id)}>Remove</button>
          </li>
        ))}
      </ul>
    </div>
  );
}

export default UserList;
