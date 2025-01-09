import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Component } from 'react';
import { Button } from 'reactstrap';

function Botonera(props) {
  let tablero = [];
  if (props.jugar) {
    tablero.push(<br />)
    for (let i = 0; i <= 7; i++) {
      for (let j = 0; j <= 3; j++) {
        if (!(i % 2)) {
          tablero.push(<Button outline />)
        }

        if (i < 5) {
          tablero.push(<Button color={props.matriz[0]} />)
        } else {
          tablero.push(<Button color={props.matriz[1]} />)
        }

        if (i % 2) {
          tablero.push(<Button outline />)
        }
      }
      tablero.push(<br />)
    }
  }
  return (
    tablero
  );

}

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      listaBotones: ["secondary", "success", "outline"],
      playable: false
    };
  }

  jugar() {
    let jugTmp = this.state.playable

    if (jugTmp) {
      jugTmp = false
    } else {
      jugTmp = true
    }

    this.setState({
      playable: jugTmp
    });
  }

  render() {
    return (
      <div className="App">
        <Button onClick={() => this.jugar()}>Jugar</Button>
        <Botonera jugar={this.state.playable} matriz={this.state.listaBotones} />
      </div>
    );
  }
}

export default App;
