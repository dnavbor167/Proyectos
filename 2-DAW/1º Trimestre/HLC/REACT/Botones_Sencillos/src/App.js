import { Component } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Button } from 'reactstrap';

class App extends Component {
    constructor(props) {

        super(props);
        this.state = {
            listaColores: Array(5).fill("secondary"),
            numero: 0,
        };
    }

    handleOnClick(numButt) {
        let copListColo = this.state.listaColores
        //incrementamos en uno 
        copListColo[numButt] = "danger";

        this.setState({
            listaColores: copListColo,
            numero: copListColo.filter(n => n==="danger").length,
        })
    }

    render() {
        return (
            <div className="App">
                <header className="App-header">
                    <h1>{this.state.numero}</h1>
                    <Botoncillo color={this.state.listaColores[0]} pos={0} increment={(n) => this.handleOnClick(n)} />
                    <Botoncillo color={this.state.listaColores[1]} pos={1} increment={(n) => this.handleOnClick(n)} />
                    <Botoncillo color={this.state.listaColores[2]} pos={2} increment={(n) => this.handleOnClick(n)} />
                    <Botoncillo color={this.state.listaColores[3]} pos={3} increment={(n) => this.handleOnClick(n)} />
                    <Botoncillo color={this.state.listaColores[4]} pos={4} increment={(n) => this.handleOnClick(n)} />
                </header>
            </div>
        );
    }
}

function Botoncillo(props) {
    return (
        <Button color={props.color} onClick={() => props.increment(props.pos)}></Button>
    );
}

export default App;