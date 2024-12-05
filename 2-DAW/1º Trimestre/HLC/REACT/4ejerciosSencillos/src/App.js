import logo from './logo.svg';
import './App.css';
import { Component } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Button } from 'reactstrap';
import { Alert } from 'reactstrap';

class App extends Component {
    constructor(props) {
        super(props)
        this.state = {
            infoToggleVisible: false,
            alertToggleVisible: false,
        }

    }
    toggleInfo = () => {
        this.setState({ infoToggleVisible: !this.state.infoToggleVisible });
    }

    toggleAlert = () => {
        this.setState({ alertToggleVisible: !this.state.alertToggleVisible });
    }
    render() {
        return (
            <div className="App">
                <header className="App-header">
                    <img src={logo} className="App-logo" alt="logo" />
                    <Button color="info" onClick={this.toggleInfo}>
                        Click Me
                    </Button>
                    <Button color="danger" onClick={this.toggleAlert}>
                        Click Me
                    </Button>
                    <Alert
                        color="info"
                        isOpen={this.state.infoToggleVisible}
                        toggle={this.toggleAlert}>
                        I am an alert and I can be dismissed!
                    </Alert>
                    <Alert
                        color="danger"
                        isOpen={this.state.alertToggleVisible}
                        toggle={this.toggleAlert}>
                        I am an alert and I can be dismissed!
                    </Alert>
                </header>
            </div>
        );
    }
}

export default App;