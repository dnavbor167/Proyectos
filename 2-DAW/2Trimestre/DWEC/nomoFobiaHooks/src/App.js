import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import React from 'react';
import Preguntas from './Components/Card';
import { Alert } from 'reactstrap';
import { useState } from 'react';

const App = () => {

  const [questions, setQuestions] = useState([
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
  ])
  const [respuestas, setRespuestas] = useState([
    { id: 1, respuesta: "En principio no tienes nada de que preocuparte." },
    { id: 2, respuesta: "Empiezas a tener signos de dependencia del móvil. Puedes utilizar técnicas como apagar el móvil cuando no lo necesitas, cuando duermes, etc." },
    { id: 3, respuesta: "Tienes una gran dependencia del móvil. Deberías seguir un plan de «desintoxicación» del móvil como por ejemplo dejar el móvil en casa cuando vas a comprar, apagarlo durante la noche, apagarlo durante horas de clase o trabajo, etc." },
    { id: 4, respuesta: "Tus síntomas de dependencia son muy preocupantes. Además de todas las técnicas de los apartados anteriores deberías plantearte un plan de desintoxicación del móvil que consista en estar una o dos semanas sin utilizarlo. Si ves que no puedes hacerlo por ti mismo, pide ayuda a un profesional." }
  ])

  let [contador, setContador] = useState(0)

  const [mostrarModal, setMostrarModal] = useState(false)

  const clica = (valorBtn, idBoton) => {
    if (valorBtn === "si") {
      setContador(contador + 1)
    }

    let array = questions.filter(id => id.id !== idBoton)

    setQuestions(array)

    setMostrarModal(array.length === 0)
  }

  const alertas = () => {
    let respuesta = null

    if (mostrarModal) {
      if (contador >= 0 && contador <= 5) {
        respuesta = <Alert>{respuestas[0].respuesta} </Alert>
      } else if (contador >= 6 && contador <= 7) {
        respuesta = <Alert color='primary'>{respuestas[1].respuesta} </Alert>
      } else if (contador >= 7 && contador <= 8) {
        respuesta = <Alert color='warning'>{respuestas[2].respuesta} </Alert>
      } else if (contador >= 9 && contador <= 10) {
        respuesta = <Alert color='danger'>{respuestas[3].respuesta} </Alert>
      }
    }


    return respuesta
  }

  return (
    <div className="App">
      {alertas()}
      <Preguntas listaPreguntas={questions} clica={(valorBtn, idBoton) => clica(valorBtn, idBoton)} />
    </div>
  );
}

export default App;