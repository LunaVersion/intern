import './App.css';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import HomePage from './components/HomePage';
import Employee from './components/Employee';
function App() {
  return (
    <div className="App">
        <Router>
          <Routes>
            <Route path="/" element={<HomePage />} />
            <Route path="/employee" element={<Employee />} />
          </Routes>
        </Router>
    </div>
  );
}

export default App;
