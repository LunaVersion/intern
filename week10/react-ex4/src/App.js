import './App.css';
import Home from './components/Home';
import InputText from './components/InputText';
import CheckboxInput from './components/CheckboxInput';
import RadioButtonInput from './components/RadioButtonInput';
import TextareaInput from './components/TextareaInput';
import { BrowserRouter as Router, Route, Routes} from 'react-router-dom';
import MultipleSelect from './components/MultipleSelect'; 
import DatePicker from './components/DatePicker';
import EmployeeForm from './components/EmployeeForm';
function App() {
  return (
    <Router>
      <div className="App">
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/inputtext" element={<InputText />} />
          <Route path="/checkbox" element={<CheckboxInput />} />
          <Route path="/radiobutton" element={<RadioButtonInput />} />
          <Route path="/textarea" element={<TextareaInput />} />
          <Route path='/multiple' element={<MultipleSelect />} />
          <Route path="/datepicker" element={<DatePicker />} />
          <Route path="/employeeform" element={<EmployeeForm />} />
        </Routes>
      </div>
    </Router>
  );
}

export default App;
