import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import {
    BrowserRouter as Router,

} from 'react-router-dom';
import Header from './Header';
import Footer from './Footer';



export default class Index extends Component {

    render() {
        return (
            <div>
                <Header />

                <Footer/>
            </div>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<Index />, document.getElementById('app'));
}