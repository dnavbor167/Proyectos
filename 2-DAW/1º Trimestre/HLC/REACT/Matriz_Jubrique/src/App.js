import "./App.css";
import { Component } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Button } from 'reactstrap';

class App extends Component {
    constructor(props) {

        super(props);
        this.state = {
            listBut: Array(9).fill(Array(9).fill("")),
            listaColores: Array(9).fill(Array(9).fill("info")),
            listColores: ["primary", "secondary", "success", "info", "warning", "danger", "link"],
        };
    }

    handleOnClick(fila, columna) {
        let copListColores = this.state.listaColores.map(row => [...row])

        copListColores[fila][columna] = "warning"

        this.setState({
            listaColores: copListColores,
        })
    }

    render() {
        return (
            <div className="App">
                {this.state.listBut.map((value, rowIndex) => (
                    value.map((valor, colIndex) => (
                        <Botoncillo 
                            color={this.state.listaColores[rowIndex][colIndex]} 
                            row={rowIndex} 
                            col={colIndex} 
                            changes={(r,c) => this.handleOnClick(r,c)} 
                        />
                    ))
                ))}

            </div>
        );
    }
}

function Botoncillo(props) {
    return (
        <Button className="button" color={props.color} onClick={() => props.changes(props.row, props.col)} ></Button>
    );
}

export default App;