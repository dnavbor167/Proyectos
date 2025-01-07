import './App.css'; import 'bootstrap/dist/css/bootstrap.min.css';
import { Component } from 'react';
import { Button } from 'reactstrap';

class App extends Component {
  constructor(props) {
    super(props);

    this.state = {
      colores: Array(5).fill("secondary"),
      activados: 0
    }
  }
  cambioColor(numBoton) {
    let copia = this.state.colores
    let copiaActivados = this.state.activados

    if (this.state.colores[numBoton] === "secondary" && copiaActivados < 2) {
      copia[numBoton] = "primary"
      copiaActivados += 1
    }

    if (this.state.colores[numBoton - 1] === "primary") {
      copia[numBoton-2] = "secondary"
      copiaActivados -= 1
    } 
    if (this.state.colores[numBoton + 1] === "primary") {
      copia[numBoton+2] = "secondary"
      copiaActivados -= 1
    }
    
    this.setState({ colores: copia, activados: copiaActivados })
  }

  render() {
    return (
      <div className="App">
        <Button color={this.state.colores[0]} onClick={() => this.cambioColor(0)}> uno </Button>
        <Button color={this.state.colores[1]} onClick={() => this.cambioColor(1)}> dos </Button>
        <Button color={this.state.colores[2]} onClick={() => this.cambioColor(2)}> tres </Button>
        <Button color={this.state.colores[3]} onClick={() => this.cambioColor(3)}> cuatro </Button>
        <Button color={this.state.colores[4]} onClick={() => this.cambioColor(4)}> cinco </Button>
      </div>
    );
  }
} export default App;

