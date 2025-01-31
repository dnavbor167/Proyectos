import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Component, useState } from 'react';
import {
  Alert, Row, Col, UncontrolledAccordion, AccordionItem, AccordionHeader, AccordionBody, Input, Button, Modal, ModalHeader, ModalBody, ModalFooter, FormGroup, Label
} from 'reactstrap';

const VentanaModal = (props) => {
  const [cantidad, setCantidad] = useState('');
  const [meses, setMeses] = useState('');
  const [tae, setTae] = useState('');
  const [alert, setAlert] = useState(false);

  const { className } = props;

  const handleChange = (event) => {
    const target = event.target
    if (target.name === "total") {
      setCantidad(target.value)
    }

    if (target.name === "meses") {
      setMeses(target.value)
    }

    if (target.name === "tae") {
      setTae(target.value)
    }
  }

  const datos = () => {
    //comprobamos de que sean correctos los datos (estén llenos y sean numeros)
    if (cantidad !== '' && !isNaN(cantidad) && cantidad > 0 && meses > 0 && meses !== '' && !isNaN(meses) && tae !== "") {
      setAlert(false);
      return { cantidadPropuesta: cantidad, mesesPropuestos: meses, taePropuesto: tae }
    } else {
      setAlert(true);
      return false;
    }
  }

  const mostrarAlerta = () => {
    if (alert) {
      return (
        <Alert color="danger">
          Debes rellenar todos los campos
        </Alert>
      )
    }
  }

  return (
    <div>
      <Modal isOpen={props.mostrar} toggle={props.toggle} className={className} onEntering={"//ESTO SE EJECUTA CUANDO MUESTRAS LA VENTANA"}>
        <ModalHeader toggle={props.toggle}>{props.titulo}</ModalHeader>
        <ModalBody>
          <FormGroup row>
            <Label sm={2} > Cantidad a pedir: </Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="total"
                name="total"
                type="Text" />
            </Col>
          </FormGroup>
          <FormGroup row>
            <Label sm={2} > Meses: </Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="meses"
                name="meses"
                type="number" />
            </Col>
          </FormGroup>
          <FormGroup row>
            <Label sm={2} > TAE: </Label>
            <Col sm={10}>
              <Input onChange={handleChange} onClick={handleChange}
                id="tae"
                name="tae"
                type="select"
                value={tae}
              >
                <option value="">Seleccione TAE</option>
                <option value='5'>5%</option>
                <option value='6'>6%</option>
                <option value='7'>7%</option>
                <option value='8'>8%</option>
                <option value='9'>9%</option>
              </Input>
            </Col>
          </FormGroup>
          {mostrarAlerta()}
        </ModalBody>
        <ModalFooter>
          <Button color="primary" onClick={() => {
            const isValid = datos();
            if (isValid !== false) {
              props.aceptar(datos())
            }
          }}>{props.botonAceptar}</Button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </ModalFooter>
      </Modal>
    </div>
  );
}


class App extends Component {
  constructor(props) {
    super(props)
    this.state = {
      isOpen: false,
    }
  }

  setIsOpen(d) {
    if (d === undefined) return;
    this.setState({ isOpen: d })
  }

  aceptar(datos) {
    console.log(datos)
    this.toggleModal();
    return (
      <Alert>
        Para la cantidad de {datos.cantidadPropuesta} con {datos.mesesPropuestos} meses y con un tae del {datos.taePropuesto}
      </Alert>
    )
  }

  toggleModal() { this.setIsOpen(!this.state.isOpen) }

  render() {
    return (
      <div className="App">
        <Button onClick={() => { this.toggleModal() }}>
          Dale
        </Button>
        <VentanaModal
          aceptar={(datos) => this.aceptar(datos)}
          mostrar={this.state.isOpen}
          botonAceptar={"Calcular"}
          titulo={"CALCULO DE TU CUOTA"}
        />
      </div>
    );
  }
}

export default App;