import 'bootstrap/dist/css/bootstrap.min.css';
import { Row, Card, ListGroup, ListGroupItem, CardBody, CardText, CardTitle, Modal, ModalHeader, ModalBody, ModalFooter, Button, FormGroup, Label, Col, Input, Alert, CardColumns, CardGroup } from 'reactstrap';
import './App.css';
import { Component, useEffect, useState } from 'react';
import { PIELES } from './json/pieles';

function Productos(props) {
  return (
    <Card style={{ width: '18rem' }}>
      <img src={props.img} alt={props.nombre} />
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
    <CardGroup>
      {props.productos.map(p => (

        <Productos
          img={p.imagen}
          nombre={p.nombre}
          texto={p.texto}
          comprar={() => props.comprar(p.id)}
        />

      ))}
    </CardGroup>
  )
}

const CardPedido = (props) => {
  return (
    <Card
      style={{
        width: '18rem'
      }}
    >
      <img
        alt="Card"
        src={props.imagen}
      />
      <CardBody>
        <CardTitle tag="h5">
          Pedido
        </CardTitle>
      </CardBody>
      <ListGroup flush>
        <ListGroupItem>
          <strong>Nombre: </strong>{props.nombre}
          <br />
          <strong>Teléfono: </strong>{props.telefono}
          <br />
          <strong>Dirección: </strong>{props.direccion}
        </ListGroupItem>
        <ListGroupItem>
          <strong>Nombre del producto: </strong>{props.nombre_producto}
          <br />
          <strong>Cantidad del producto: </strong>{props.cantidad}
          <br />
          <strong>Precio: </strong>{props.precio_producto}
        </ListGroupItem>
      </ListGroup>
    </Card>
  )
}

const VentanaModalPedidos = (props) => {
  const { className } = props;
  return (
    <div>
      <Modal isOpen={props.mostrar} toggle={props.toggle} className={className}>
        <ModalHeader toggle={props.toggle}>Pedidos</ModalHeader>
        <ModalBody>
          {props.pedidos.length > 0 ? (
            <>
              {props.pedidos.map((e, i) => (
                <div key={i}>
                  <h2 key={i}>Total: {e.total_precio}</h2>
                  {e.productos.map((p, j) => (
                    <CardPedido
                      key={j}
                      nombre={e.nombre_persona}
                      telefono={e.telefono_persona}
                      direccion={e.direccion_persona}
                      imagen={p.imagen_producto}
                      nombre_producto={p.nombre_producto}
                      cantidad={p.cantidad_producto}
                      precio_producto={p.precio_producto}
                    />
                  ))}
                </div>
              ))}
            </>
          ) : (
            <p>No hay pedidos aún</p>
          )}

        </ModalBody>

        <ModalFooter>
          <Button
            color="primary"
            onClick={() => { props.toggle() }}>CERRAR</Button>
        </ModalFooter>
      </Modal>
    </div>
  )
}

const VentanaModal = (props) => {
  const [nombre, setNombre] = useState(undefined)
  const [telefono, setTelefono] = useState(undefined)
  const [direccion, setDireccion] = useState(undefined)
  const [alerta, setAlerta] = useState(false)
  const [pedido, setPedido] = useState({})

  useEffect(() => {
    if (!props.mostrar) {
      setAlerta(false)
    }
  }, [props.mostrar])

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
    if (nombre !== "" && nombre !== undefined && telefono !== "" && telefono !== undefined && !isNaN(telefono) && direccion !== "" && direccion !== undefined && props.carrito.length > 0) {
      //montamos el pedido
      let ped = { nombre_persona: nombre, telefono_persona: telefono, direccion_persona: direccion, productos: [], total_precio: total() }
      props.carrito.map(p => (
        ped.productos.push({ nombre_producto: p.nombre, cantidad_producto: p.cantidad, precio_producto: p.precio.toFixed(2), imagen_producto: p.imagen })
      ))
      setAlerta(false)
      setPedido(ped)
      return (ped)
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
      listaProductos: PIELES.productos,
      isOpen: false,
      isOpenPedido: false,
      carrito: [],
      pedidos: [],
    }
  }

  toggleModal() { this.setState({ isOpen: !this.state.isOpen }) }
  toggleModalPedidos() { this.setState({ isOpenPedido: !this.state.isOpenPedido }) }

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
      copia.push({ id: id, nombre: producto[0].nombre, cantidad: 1, precio: producto[0].precio, imagen: producto[0].imagen })
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
    this.setState({ pedidos: copiaPedidos, carrito: [] })

  }

  render() {
    return (
      <>
        <Button color="primary" onClick={() => this.toggleModal()}>Carrito ({this.cantidadProductos()})</Button>
        <Button color="warning" onClick={() => this.toggleModalPedidos()}>Pedidos</Button>
        <ShowProductos productos={this.state.listaProductos} comprar={(id) => this.comprar(id)} />
        {console.log(this.state.pedidos)}
        <VentanaModal
          mostrar={this.state.isOpen}
          toggle={() => this.toggleModal()}
          carrito={this.state.carrito}
          sumar={(id) => this.sumar(id)}
          restar={(id) => this.restar(id)}
          aceptar={(datos) => this.aceptar(datos)}
        />
        <VentanaModalPedidos
          mostrar={this.state.isOpenPedido}
          toggle={() => this.toggleModalPedidos()}
          pedidos={this.state.pedidos}
          total={this.state.pedidos.map(t => (t.total_precio))}
        />
      </>
    );
  }
}

export default App;