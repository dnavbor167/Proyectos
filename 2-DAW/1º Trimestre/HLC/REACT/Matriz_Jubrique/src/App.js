import './App.css';
import { Component } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Button } from 'reactstrap';

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      listBut: Array(9).fill(Array(9).fill('')),
      listaColores: Array(9).fill(Array(9).fill('info')),
      listColores: [
        'primary',
        'secondary',
        'success',
        'warning',
        'danger',
        'link',
      ],
      number: 0,
    };
  }

  handleOnClick(fila, columna) {
    let copiaNumero = this.state.number;
    let copListColores = this.state.listaColores.map((row) => [...row]);
    copListColores[fila][columna] = this.state.listColores[copiaNumero];

    copiaNumero++;

    
    if (copiaNumero >= this.state.listColores.length) {
      copiaNumero = 0;
    }

    this.setState({
      listaColores: copListColores,
      number: copiaNumero,
    });
  }

  handleOnColor(fila, columna, color) {
    let copListColores = this.state.listaColores.map((row) => [...row]);

    if (
      copListColores[fila][columna] === 'info' &&
      copListColores[fila + 1][columna] === 'info' &&
      copListColores[fila - 1][columna] === 'info' &&
      copListColores[fila][columna + 1] === 'info' &&
      copListColores[fila][columna - 1] === 'info'
    ) {
      copListColores[fila][columna] === color;
    }
  }

  render() {
    return (
      <div className="App">
        {this.state.listBut.map((value, rowIndex) =>
          value.map((valor, colIndex) => (
            <Botoncillo
              color={this.state.listaColores[rowIndex][colIndex]}
              row={rowIndex}
              col={colIndex}
              changes={(r, c) => this.handleOnClick(r, c)}
            />
          ))
        )}
      </div>
    );
  }
}

function Botoncillo(props) {
  return (
    <Button
      className="button"
      color={props.color}
      onClick={() => props.changes(props.row, props.col)}
    ></Button>
  );
}

export default App;
