/*import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();*/


import './bootstrap';

import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import Posts from './components/Posts'; // Uveri se da je ovo ispravna putanja


const App = () => (
    <Router>
        <Routes>
            <Route path="/" element={<Posts />} />
        </Routes>
    </Router>
);

ReactDOM.render(<App />, document.getElementById('app'));
