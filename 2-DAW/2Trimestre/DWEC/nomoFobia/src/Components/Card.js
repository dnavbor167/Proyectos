import React from 'react';
import { Card, CardBody, CardTitle, CardText, Button } from 'reactstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import "../App.css"

export default function Preguntas(props) {
    return (
        props.listaPreguntas.map((pr) => (
            <Card
                style={{
                    width: '100%'
                }}
            >
                <CardBody>
                    <CardTitle tag="h5">
                        Pregunta {pr.id}
                    </CardTitle>
                    <CardText>
                        {pr.pregunta}
                    </CardText>
                    <Button className='right' color='primary' onClick={() => props.clica("si", pr.id)}>
                        Sí
                    </Button>
                    <Button onClick={() => props.clica("no", pr.id)}>
                        No
                    </Button>
                </CardBody>
            </Card>
        ))
    )
}