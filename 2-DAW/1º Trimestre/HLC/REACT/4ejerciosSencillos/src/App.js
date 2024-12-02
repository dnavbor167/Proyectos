import logo from './logo.svg';
import './App.css';
import { Component } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Button } from 'reactstrap';
import React, { useState } from 'react';
import { Alert } from 'reactstrap';

class App extends Component {
    constructor(props) {
        super(props)
        this.state = {
            alertVisible: false,
        }

    }

    render() {
        return (
            <div className="App">
                <header className="App-header">
                    <img src={logo} className="App-logo" alt="logo" />
                    <Button color="danger" onClick={()=>AlertDanger(this.setState{})}>
                        Click Me
                    </Button>
                </header>
            </div>
        );
    }
}

function AlertDanger(props) {
    const [visible, setVisible] = useState(true);

    const onDismiss = () => setVisible(false);

    return (
        <Alert color="info" isOpen={visible}>
            I am an alert and I can be dismissed!
        </Alert>
    );
}


export default App;