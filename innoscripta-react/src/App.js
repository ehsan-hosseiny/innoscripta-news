import logo from './logo.svg';
import React from 'react';
import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import {BrowserRouter,Route,Routes,useLocation} from 'react-router-dom'
import Login from './Login'
import Register from './Register'
import News from './News'
import Protected from './Protected';
import Preference from './Preference';
import Source from './Source';




function App() {
  return (
    <div className="App">
      <BrowserRouter>
   
     <Routes>
          <Route path="/" element={<Login />} />
          <Route path="/login" element={<Login />} />
          <Route path="/register" element={<Register />} />       
          <Route path="/news"element={<Protected cmp={News} />} // Use lowercase 'cmp' prop
          />
           <Route path="/preference"element={<Protected cmp={Preference} />} // Use lowercase 'cmp' prop
          />
          <Route path="/source"element={<Protected cmp={Source} />} // Use lowercase 'cmp' prop
          />
          
      </Routes>
 
     </BrowserRouter>
    </div>
  );
}

export default App;
