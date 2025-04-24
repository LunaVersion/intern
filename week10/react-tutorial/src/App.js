import './App.css';
import React from 'react';
import Counter from './components/Counter';
import { BrowserRouter as Router, Route, Routes, Link } from 'react-router-dom';
import Home from './components/Home';
import List from './components/List';
import Form from './components/Form';
import User from './components/User';
function App() {
  return (
    <Router>
    <div className="App">
          <Link to="/">Trang chủ</Link>
          <br />
          <Link to="/counter">Trang đếm</Link>
          <br />
          <Link to="/list">Trang danh sách hoa quả</Link>
          <br />
          <Link to="/form">Trang nhập form</Link>
          <br />
          <Link to="/user">Trang thêm và xóa người dùng</Link>
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/counter" element={<Counter />} />
          <Route path="/list" element={<List />} />
          <Route path="/form" element={<Form />} />
          <Route path="/user" element={<User />} />

        </Routes>
    </div>
    </Router>
  );
}

export default App;
