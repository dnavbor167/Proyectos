import 'bootstrap/dist/css/bootstrap.min.css';
import { Card, CardBody, CardText, CardTitle, Modal, ModalHeader, ModalBody, ModalFooter, Button, FormGroup, Label, Col, Input, Alert } from 'reactstrap';
import './App.css';
import { Component, useState } from 'react';
export const PIELES = [
  {
    id: 0,
    imagen: "https://pielparaartesanos.com/cdn/shop/files/Cabra_laminada_oro.jpg",
    nombre: "Cabra laminada oro",
    texto: "Cabra laminada con acabado arrugado en color oro.",
    precio: 25.45
  },
  {
    id: 1,
    imagen: "https://pielparaartesanos.com/cdn/shop/files/Vacuno_encerado_lodo.jpg",
    nombre: "Vacuno encerado lodo",
    texto: "Dale un toque único y resistene a tus productos artesanales con este material de alta calidad.",
    precio: 50.56
  },
  {
    id: 2,
    imagen: "https://pielparaartesanos.com/cdn/shop/files/RST_420.jpg",
    nombre: "Vacuno flor de burdeos",
    texto: "La piel de vacuno es la opción ideal para bolsos de calidad.",
    precio: 5.5
  }
];

function Productos(props) {
  return (
    <Card style={{ width: '18rem' }}>
      <img src={props.img} />
      <CardBody>
        <CardTitle tag="h5">{props.nombre}</CardTitle>
        <CardText>{props.texto}</CardText>
        <Button color="primary" onClick={() => props.comprar(props.id)}>Comprar</Button>
      </CardBody>
    </Card>
  )
}

function ShowProductos(props) {
  return (
    <>
      {props.productos.map(p => (
        <Productos img={p.imagen} nombre={p.nombre} texto={p.texto} id={p.id} comprar={() => props.comprar(p.id)} />
      ))}
    </>)
}

const VentanaModal = (props) => {
  const [nombre, setNombre] = useState(undefined)
  const [telefono, setTelefono] = useState(undefined)
  const [direccion, setDireccion] = useState(undefined)
  const [alerta, setAlerta] = useState(false)
  const [pedido, setPedido] = useState({})

  const { className } = props;

  const handleChange = (event) => {
    const target = event.target

    if (target.name === "nombre") {
      setNombre(target.value)
    }

    if (target.name === "telefono") {
      setTelefono(target.value)
    }

    if (target.name === "direccion") {
      setDireccion(target.value)
    }
  }

  const datos = () => {
    if (nombre !== "" && nombre !== undefined && telefono !== "" && telefono !== undefined && !isNaN(telefono) && direccion !== "" && direccion !== undefined) {
      setAlerta(false)
      //montamos el pedido
      props.carrito.map(p => (
        setPedido({ nombre_persona: nombre, telefono_persona: telefono, direccion_persona: direccion, nombre_producto: p.nombre, cantidad_producto: p.cantidad, precio_producto: p.precio.toFixed(2), total_precio: total() })
      ))
      return (pedido)
    } else {
      setAlerta(true)
      return false
    }
  }

  const restablecerDatos = () => {
    setNombre(undefined)
    setTelefono(undefined)
    setDireccion(undefined)
    setAlerta(false)
    setPedido({})
  }

  const total = () => {
    return props.carrito.reduce((acum, item) => acum + item.precio, 0).toFixed(2)
  }

  return (
    <div>
      <Modal isOpen={props.mostrar} toggle={props.toggle} className={className}>
        <ModalHeader toggle={props.toggle}>CARRITO DE LA COMPRA</ModalHeader>
        <ModalBody>
          {props.carrito.map(p => (
            <p>{p.nombre} - {p.cantidad} - {p.precio.toFixed(2)} <Button onClick={() => props.sumar(p.id)}>+</Button><Button onClick={() => props.restar(p.id)}>-</Button></p>
          ))}
          <p><strong>TOTAL:</strong> {total()}</p>
          <FormGroup row>
            <Label sm={2} > <strong>Nombre:</strong> </Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="nombre"
                name="nombre"
                type="Text" />
            </Col>
          </FormGroup>
          <FormGroup row>
            <Label sm={2} > <strong>Teléfono:</strong> </Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="telefono"
                name="telefono"
                type="number" />
            </Col>
          </FormGroup>
          <FormGroup row>
            <Label sm={2} > <strong>Dirección:</strong> </Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="direccion"
                name="direccion"
                type="Text" />
            </Col>
          </FormGroup>
        </ModalBody>

        <Alert isOpen={alerta} color='danger'>Debes rellenar los campos correctamente</Alert>

        <ModalFooter>
          <Button color="secondary" onClick={() => { setAlerta(false); props.toggle() }}>CERRAR</Button>
          <Button
            color="primary"
            onClick={
              () => {
                const isValid = datos();
                if (isValid !== false) {
                  props.aceptar(isValid)
                  restablecerDatos()
                  props.toggle()
                }
              }
            }>COMPRAR</Button>
        </ModalFooter>
      </Modal>
    </div>
  )
}

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      listaProductos: PIELES,
      isOpen: false,
      carrito: [],
      pedidos: [],
    }
  }

  toggleModal() { this.setState({ isOpen: !this.state.isOpen }) }

  comprar(id) {
    let copia = this.state.carrito
    let producto = this.state.listaProductos.filter(p => p.id === id)
    //Se puede usar some que devuelve true o false si lo encuentra
    let copProducto = copia.filter(e => e.id === id)

    if (copProducto.length > 0) {
      copia.map(e => {
        if (e.id === id) { e.cantidad++; e.precio += producto[0].precio }
      })
    } else {
      copia.push({ id: id, nombre: producto[0].nombre, cantidad: 1, precio: producto[0].precio })
    }
    console.log(copia)
    this.setState({ carrito: copia })
  }

  cantidadProductos() {
    let copia = this.state.carrito
    let total = copia.map(e => e.cantidad)
    let cantidadTotal = 0;

    for (let i = 0; i < total.length; i++) {
      cantidadTotal += total[i]
    }
    return cantidadTotal > 0 ? cantidadTotal : ""
  }

  sumar(id) {
    let copia = this.state.carrito
    let producto = this.state.listaProductos.filter(p => p.id === id)
    let copProducto = copia.filter(e => e.id === id)
    if (copProducto.length > 0) {
      copia.map(e => {
        if (e.id === id) { e.cantidad++; e.precio += producto[0].precio }
      })
    }
    this.setState({ carrito: copia })
  }

  restar(id) {
    let copia = this.state.carrito
    let producto = this.state.listaProductos.filter(p => p.id === id)
    let copProducto = copia.filter(e => e.id === id)
    if (copProducto.length > 0) {
      copia.map(e => {
        if (e.id === id && e.cantidad > 0) {
          e.cantidad--
          e.precio -= producto[0].precio
        }
      })
    }

    if (copProducto[0].cantidad === 0) {
      copia = copia.filter(e => e.id !== id)
    }
    this.setState({ carrito: copia })
  }

  aceptar(datos) {
    let copiaPedidos = this.state.pedidos
    copiaPedidos.push(datos)
  }

  render() {
    return (
      <>
        <Button color="primary" onClick={() => this.toggleModal()}>Carrito ({this.cantidadProductos()})</Button>
        <ShowProductos productos={this.state.listaProductos} comprar={(id) => this.comprar(id)} />
        <VentanaModal
          mostrar={this.state.isOpen}
          toggle={() => this.toggleModal()}
          carrito={this.state.carrito}
          sumar={(id) => this.sumar(id)}
          restar={(id) => this.restar(id)}
        />
      </>
    );
  }
}

export default App;