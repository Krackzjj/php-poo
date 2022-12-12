import React from 'react';
import logo from './logo.svg';
import './App.css';

function App() {

const t = ()=>{fetch('http://localhost:1234/user/test').then(res=>res.json()).then(r=>console.log(r))}

  return (
    <div className="App">
      <header className="App-header">
        <img src={logo} className="App-logo" alt="logo" />
        <p>
          Edit <code>src/App.tsx</code> and save to reload.
        </p>
        <a
          className="App-link"
          href="https://reactjs.org"
          target="_blank"
          rel="noopener noreferrer"
        >
          Learn React
        </a>
        <button onClick={t}>TEST</button>
      </header>
    </div>
  );
}

export default App;
