import { Component } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Button } from 'reactstrap';

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      listColores: Array(5).fill('secondary'),
      numeros: 0,
    };
  }

  handleOnClick(numero) {
    let copiaColores = this.state.listColores;
    copiaColores[numero] =
      copiaColores[numero] === 'danger' ? 'secondary' : 'danger';
    this.setState({
      listColores: copiaColores,
      numeros: copiaColores.filter((e) => e === 'danger').length,
    });
  }

  render() {
    return (
      <div className="App">
        <h1>{this.state.numeros}</h1>
        <Botoncillo
          color={this.state.listColores[0]}
          pos={0}
          contarNumeros={(n, e) => this.handleOnClick(n)}
        />
        <Botoncillo
          color={this.state.listColores[1]}
          pos={1}
          contarNumeros={(n) => this.handleOnClick(n)}
        />
        <Botoncillo
          color={this.state.listColores[2]}
          pos={2}
          contarNumeros={(n) => this.handleOnClick(n)}
        />
        <Botoncillo
          color={this.state.listColores[3]}
          pos={3}
          contarNumeros={(n) => this.handleOnClick(n)}
        />
        <Botoncillo
          color={this.state.listColores[4]}
          pos={4}
          contarNumeros={(n) => this.handleOnClick(n)}
        />
      </div>
    );
  }
}
function Botoncillo(props) {
  return (
    <Button
      color={props.color}
      onClick={() => props.contarNumeros(props.pos)}
    ></Button>
  );
}

export default App;
