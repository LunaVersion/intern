import './App.css';
import Employee from './components/Employee'; 
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import Form from './components/Form';
function App() {
  return (
    <div className="App">
      <Router>
        <Routes>
          <Route path="/" element={<Employee />} />
          <Route path="/form" element={<Form />} />
        </Routes>
      </Router>
    </div>
  );
}

export default App;
