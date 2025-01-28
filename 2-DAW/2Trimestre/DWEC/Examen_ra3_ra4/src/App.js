import React, { Component, useState } from 'react';
import { Row, FormGroup, Button, Label, Input } from 'reactstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

function Cliente(props) {
  //hook para guardar nombre o cambiarlo
  const [nombre, setNombre] = useState('');

  const handleChange = (event) => {
    if (event.target.name === "nombre") {
      setNombre(event.target.value)
    }
  }

  const clicar = () => {
    if (nombre !== undefined && nombre !== "") {
      props.reserva(nombre)
    }
  }

  return (
    <Row>
      <FormGroup>
        <Label for="nombre">Nombre</Label>
        <Input
          id="nombre"
          name="nombre"
          placeholder="nombre del cliente"
          type="text"
          onChange={handleChange}
        />
      </FormGroup> <br />
      <Button color="primary" onClick={clicar}><strong>Reservar</strong></Button>
    </Row>
  )
}

function Botonera(props) {
  let matriz = []
  for (let i = 0; i <= 8; i++) {
    let fila = []
    for (let j = 0; j <= 8; j++) {
      if (props.lista[i][j].seleccionado && !props.lista[i][j].reservado) {
        fila.push(<Button color="primary" onClick={() => props.clicar(i, j)}></Button>)
      } else if (props.lista[i][j].reservado) {
        fila.push(<Button color="danger" onClick={() => props.clicar(i, j)}>{props.lista[i][j].fulano}</Button>)
      }
      else {
        fila.push(<Button onClick={() => props.clicar(i, j)}></Button>)
      }

    }

    matriz.push(<br />)
    matriz.push(fila)
  }

  return (matriz)

}

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      listaBotones: JSON.parse(JSON.stringify((Array(9).fill(Array(9).fill({ reservado: false, seleccionado: false, fulano: "" })))))
    }
  }

  clicar(i, j) {
    let listaCopia = this.state.listaBotones
    let booleano = listaCopia[i][j].seleccionado
    listaCopia[i][j].seleccionado = !booleano

    this.setState({
      listaBotones: listaCopia
    })
  }

  reservar(nombre) {
    let listaCopia = this.state.listaBotones

    listaCopia.map(i => i.map(j => {
      if (j.seleccionado && !j.reservado) {
        j.reservado = true
        j.fulano = nombre
      }
      return j
    }))


    this.setState({
      listaBotones: listaCopia
    })
  }

  render() {
    return (
      <div className="App">
        <Botonera clicar={(i, j) => this.clicar(i, j)} lista={this.state.listaBotones} />
        <Cliente reserva={(nombre) => this.reservar(nombre)} />
      </div>
    );
  }
}

export default App;