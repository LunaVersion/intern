import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';
import reportWebVitals from './reportWebVitals';

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  // React.StrictMode khiến cho ứng dụng chạy 2 lần 
  // như ví dụ khiến cho componentDidMount chạy 2 lần
  // <React.StrictMode>
     <App />
  // </React.StrictMode>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
//-------------------------
// import React from 'react';
// import { createRoot } from 'react-dom/client';
// import './index.css'; // nếu có


// class App extends React.Component {
//   render() {
//     return (
//       <div className="App">
//         <h1>Hello, Luna!</h1>
//       </div>
//     );
//   }
// }

// const container = document.getElementById('root');
// const root = createRoot(container);
// root.render(<App />);
