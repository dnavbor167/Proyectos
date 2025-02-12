import React, { Component, useState } from "react";
import { Button, Table, Input, Modal, ModalHeader, ModalBody, ModalFooter, FormGroup, Label, Col, Alert } from 'reactstrap';
import 'bootstrap/dist/css/bootstrap.min.css';


const Corredor = (props) => {
  const { className } = props;

  const [nombre, setNombre] = useState(undefined)
  const [equipo, setEquipo] = useState(undefined)
  const [alerta, setAlerta] = useState(false)

  const handleChange = (event) => {
    const target = event.target

    if (target.name === "nombre") {
      setNombre(target.value)
    }

    if (target.name === "equipo") {
      setEquipo(target.value)
    }
  }

  const datos = () => {
    let corredores = props.corredores.length + 1
    let nombreRepetido = props.corredores.find(n => n.nombre === nombre)
    if (!nombreRepetido && nombre !== undefined && nombre !== "" && isNaN(nombre) && equipo !== undefined && equipo !== "" && isNaN(equipo)) {
      setAlerta(false)
      return { "nombre": nombre, "equipo": equipo, "posicion": corredores }
    } else {
      setAlerta(true)
      return false
    }
  }

  return (
    <div>
      <Modal isOpen={props.mostrar} toggle={props.toggle} className={className} onEntiring={() => { }}>
        <ModalHeader toggle={props.toggle}>AÑADIR CORREDOR</ModalHeader>
        <ModalBody>
          <FormGroup row>
            <Label sm={2}>Nombre:</Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="nombre"
                name="nombre"
                type="text" />
            </Col>
          </FormGroup>
          <FormGroup row>
            <Label sm={2}>Equipo:</Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="equipo"
                name="equipo"
                type="nombre" />
            </Col>
          </FormGroup>
        </ModalBody>
        <Alert isOpen={alerta} color="danger">Debe rellenar los campos correctamente y/o nombre repetido</Alert>
        <ModalFooter>
          <Button onClick={() => {
            let isValid = datos()
            if (isValid !== false) {
              props.aceptar(isValid)
              props.toggle()
            }
            setNombre("")
            setEquipo("")
          }} color="primary">AÑADIR CORREDOR</Button>
        </ModalFooter>
      </Modal>
    </div>
  )
}

const Mostrar = (props) => {
  const ultimaPosicion = props.corredores.length
  return (
    <>
      <Table>
        <thead>
          <tr><th>#</th><th>Nombre</th><th>Equipo</th><th>Posición</th></tr>
        </thead>
        <tbody>
          {
            props.corredores.map(c => (
              <tr>
                <th scope="row">{c.posicion}</th><td>{c.nombre}</td><td>{c.equipo}</td> <td><Button onClick={() => props.mover("up", Number(c.posicion))} hidden={Number(c.posicion) === 1 ? true : false}>UP</Button><Button onClick={() => props.mover("down", Number(c.posicion))} hidden={Number(c.posicion) !== 1 && Number(c.posicion) === ultimaPosicion ? true : false}>DOWN</Button></td>
              </tr>
            ))}

        </tbody>

      </Table>
    </>
  )
}

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      listaCorredores: [{ "nombre": "sdfsd", "equipo": "jsdfj", "posicion": "1" }],
      isOpen: false,
    }
  }

  toggleModal() { this.setState({ isOpen: !this.state.isOpen }) }

  alta(datos) {
    let listCopia = this.state.listaCorredores
    listCopia.push(datos)

    this.setState({ listaCorredores: listCopia })
  }

  mover(movimiento, posicion) {
    let copiaLista = this.state.listaCorredores
    let ordenado
    let temp1
    let temp2
    if (movimiento === "down") {
      temp1 = copiaLista.filter(j => j.posicion === posicion)
      temp1 = { "nombre": temp1.nombre, "equipo": temp1.equipo, "posicion": posicion + 1 }

      temp2 = copiaLista.filter(j => j.posicion === posicion + 1)
      temp2 = { "nombre": temp2.nombre, "equipo": temp2.equipo, "posicion": posicion - 1 }
    } else {
      temp1 = copiaLista.filter(j => j.posicion === posicion)
      temp1 = { "nombre": temp1.nombre, "equipo": temp1.equipo, "posicion": posicion - 1 }

      temp2 = copiaLista.filter(j => j.posicion === posicion - 1)
      temp2 = { "nombre": temp2.nombre, "equipo": temp2.equipo, "posicion": posicion + 1 }
    }

  }

  render() {
    return (
      <div className="App">
        <h1>CARRERA DE ORIENTACIÓN DE ISTAN</h1>
        <Mostrar corredores={this.state.listaCorredores} mover={(movimiento, posicion) => this.mover(movimiento, posicion)} />
        <Button onClick={() => { this.toggleModal() }} color="info">ALTA CORREDOR</Button>
        <Corredor
          mostrar={this.state.isOpen}
          toggle={() => { this.toggleModal() }}
          aceptar={(datos) => this.alta(datos)}
          corredores={this.state.listaCorredores}
        />
      </div>
    );
  }
}

export default App;