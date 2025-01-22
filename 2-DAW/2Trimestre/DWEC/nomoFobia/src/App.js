import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import React, { Component } from 'react';
import Preguntas from './Components/Card';
import { Alert } from 'reactstrap';

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      questions: [
        { id: 1, pregunta: "Cuando mandas un mensaje por whatsapp esperas siempre al doble check. Si no aparece vuelves a abrir el terminal para revisarlo al rato." },
        { id: 2, pregunta: "Antes de acostarte siempre miras el móvil a ver si tienes mensajes o notificaciones." },
        { id: 3, pregunta: "Te despiertas antes de tiempo para jugar, mandar mensajes, actualizar perfiles,… con el teléfono móvil." },
        { id: 4, pregunta: "Si sales de casa sin el móvil volverías a cogerlo aunque llegues tarde a tu cita." },
        { id: 5, pregunta: "Tienes miedo a quedarte sin batería." },
        { id: 6, pregunta: "Cuando tienes la batería baja desactivas ciertas aplicaciones u opciones del teléfono como la WiFi, bluetooth para no quedarte sin batería." },
        { id: 7, pregunta: "Tienes ansiedad cuando tienes llamadas perdidas. Llamas a los números y te preocupas si no responden." },
        { id: 8, pregunta: "Miras la cobertura cuando estas en algún sitio con los amigos, esperando, etc." },
        { id: 9, pregunta: "Sueles hacer alguna otra cosa mientras que miras al móvil como comer, lavarte los dientes, etc." },
        { id: 10, pregunta: "Vas al baño siempre con el móvil." }
      ],
      respuestas: [
        { id: 1, respuesta: "En principio no tienes nada de que preocuparte." },
        { id: 2, respuesta: "Empiezas a tener signos de dependencia del móvil. Puedes utilizar técnicas como apagar el móvil cuando no lo necesitas, cuando duermes, etc." },
        { id: 3, respuesta: "Tienes una gran dependencia del móvil. Deberías seguir un plan de «desintoxicación» del móvil como por ejemplo dejar el móvil en casa cuando vas a comprar, apagarlo durante la noche, apagarlo durante horas de clase o trabajo, etc." },
        { id: 4, respuesta: "Tus síntomas de dependencia son muy preocupantes. Además de todas las técnicas de los apartados anteriores deberías plantearte un plan de desintoxicación del móvil que consista en estar una o dos semanas sin utilizarlo. Si ves que no puedes hacerlo por ti mismo, pide ayuda a un profesional." }
      ],
      contador: 0,
      mostrarModal: false,
    }
  }

  clica(valorBtn, idBoton) {
    let copiaQuestions = this.state.questions
    let conta = this.state.contador

    if (valorBtn === "si") {
      conta += 1
    }

    let array = copiaQuestions.filter(id => id.id !== idBoton)

    this.setState({
      questions: array,
      contador: conta,
      mostrarModal: array.length === 0
    })
  }

  alertas() {
    let respuesta = null

    if (this.state.mostrarModal) {
      if (this.state.contador >= 0 && this.state.contador <= 5) {
        respuesta = <Alert>{this.state.respuestas[0].respuesta} </Alert>
      } else if (this.state.contador >= 6 && this.state.contador <= 7) {
        respuesta = <Alert color='primary'>{this.state.respuestas[1].respuesta} </Alert>
      } else if (this.state.contador >= 7 && this.state.contador <= 8) {
        respuesta = <Alert color='warning'>{this.state.respuestas[2].respuesta} </Alert>
      } else if (this.state.contador >= 9 && this.state.contador <= 10) {
        respuesta = <Alert color='danger'>{this.state.respuestas[3].respuesta} </Alert>
      }
    }


    return respuesta
  }

  render() {
    return (
      <div className="App">
        {this.alertas()}
        <Preguntas listaPreguntas={this.state.questions} clica={(valorBtn, idBoton) => this.clica(valorBtn, idBoton)} />
      </div>
    );
  }
}

export default App;