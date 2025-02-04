import 'bootstrap/dist/css/bootstrap.min.css';
import { Card, CardBody, CardText, CardTitle, Modal, ModalHeader, ModalBody, ModalFooter, Button } from 'reactstrap';
import './App.css';
import { Component } from 'react';
export const PIELES = [
  {
    id: 0,
    imagen: "https://pielparaartesanos.com/cdn/shop/files/Cabra_laminada_oro.jpg",
    nombre: "Cabra laminada oro",
    texto: "Cabra laminada con acabado arrugado en color oro."
  },
  {
    id: 1,
    imagen: "https://pielparaartesanos.com/cdn/shop/files/Vacuno_encerado_lodo.jpg",
    nombre: "Vacuno encerado lodo",
    texto: "Dale un toque único y resistene a tus productos artesanales con este material de alta calidad."
  },
  {
    id: 2,
    imagen: "https://pielparaartesanos.com/cdn/shop/files/RST_420.jpg",
    nombre: "Vacuno flor de burdeos",
    texto: "La piel de vacuno es la opción ideal para bolsos de calidad."
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
        <Productos img={p.imagen} nombre={p.nombre} texto={p.texto} id={p.id} comprar={(id) => this.comprar(id)} />
      ))}
    </>)
}

const VentanaModal = (props) => {
  const { className } = props;

  return (
    <div>
      <Modal isOpen={props.mostrar} toggle={props.toggle} className={className}>
        <ModalHeader toggle={props.toggle}>CARRITO DE LA COMPRA</ModalHeader>
        <ModalBody>
          {props.carrito.map(p => (
            <p>{p.nombre} - {p.cantidad} <Button onClick={() => props.sumar(p.id)}>+</Button><Button onClick={() => props.restar(p.id)}>-</Button></p>
          ))}
        </ModalBody>
        <ModalFooter>
          <Button color="primary" onClick={() => props.toggle()}>CERRAR</Button>
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
        if (e.id === id) { e.cantidad++ }
      })
    } else {
      copia.push({ id: id, nombre: producto[0].nombre, cantidad: 1 })
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
    let copProducto = copia.filter(e => e.id === id)
    if (copProducto.length > 0) {
      copia.map(e => {
        if (e.id === id) { e.cantidad++ }
      })
    }
    this.setState({ carrito: copia })
  }

  restar(id) {
    let copia = this.state.carrito
    let copProducto = copia.filter(e => e.id === id)
    if (copProducto.length > 0) {
      copia.map(e => {
        if (e.id === id && e.cantidad > 0) {
          e.cantidad--
        }
      })
    }

    if (copProducto[0].cantidad === 0) {
      copia = copia.filter(e => e.id !== id)
    }
    this.setState({ carrito: copia })
  }

  render() {
    return (
      <>
        <Button color="primary" onClick={() => this.toggleModal()}>Carrito ({this.cantidadProductos()})</Button>
        <ShowProductos productos={this.state.listaProductos} />
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