import { Component } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Button } from 'reactstrap';

class App extends Component {
    constructor(props) {

        super(props);
        this.state = {
            listBut: Array(5).fill("secondary"),
            listNum: Array(5).fill(0),
        };
    }

    handleOnClick(numBoton) {
        let copListBut = this.state.listBut
        let copListNum = this.state.listNum

        copListBut[numBoton] = "danger"
        copListNum[numBoton]++

        this.setState({
            listBut: copListBut,
            listNum: copListNum,
        })
    }

    render() {
        return (
            <div className="App">
                <header className="App-header">
                    <Botoncillo color={this.state.listBut[0]} numero={this.state.listNum[0]} pos={0} func={(n) => this.handleOnClick(n)} />
                    <Botoncillo color={this.state.listBut[1]} numero={this.state.listNum[1]} pos={1} func={(n) => this.handleOnClick(n)} />
                    <Botoncillo color={this.state.listBut[2]} numero={this.state.listNum[2]} pos={2} func={(n) => this.handleOnClick(n)} />
                    <Botoncillo color={this.state.listBut[3]} numero={this.state.listNum[3]} pos={3} func={(n) => this.handleOnClick(n)} />
                    <Botoncillo color={this.state.listBut[4]} numero={this.state.listNum[4]} pos={4} func={(n) => this.handleOnClick(n)} />
                </header>
            </div>
        );
    }
}

function Botoncillo(props) {
    return (
        <Button color={props.color} onClick={() => props.func(props.pos)}>{props.numero}</Button>
    );
}

export default App;