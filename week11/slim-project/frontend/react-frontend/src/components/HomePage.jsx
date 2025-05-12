import React from 'react';
import { Link } from 'react-router-dom';
function Home() {
    return (
        <div style={{ textAlign: 'center', padding: '20px' }}>
            <h1>Chào mừng đến trang chủ</h1>
            <p>This is the home page of our React application.</p>
            <Link to="/employee" style={{ textDecoration: 'none', color: '#007BFF' }}>
                <button 
                    style={{
                        padding: '10px 20px',
                        fontSize: '16px',
                        backgroundColor: '#007BFF',
                        color: '#fff',
                        border: 'none',
                        borderRadius: '5px',
                        cursor: 'pointer'
                    }}
                >
                    Go to Employee Page
                </button>   
            </Link>
        </div>
    );
};

export default Home;