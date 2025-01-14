import React, { useState } from 'react';
import { Row, Col, Card, CardTitle, CardText, Form, FormGroup, Button, Label, Input } from 'reactstrap';
export default function AppLogin(props) {

    const [password, setPassword] = useState('');
    const [telefono, setTelefono] = useState('');
    const [info, setInfo] = useState('');

    const handleOnChange = (event) => {
        setInfo('')
        const target = event.target
        if (target.name === "password") {
            setPassword(target.value)
        }
        if (target.name === "telefono") {
            setTelefono(target.value)
        }
    }

    const clicla = () => {
        let result = props.userLogin(telefono, password)
        setInfo(result) 
    }

    return (
        <Row>
            <Col sm="4"></Col>
            <Col sm="4">
                <Card body>
                    <CardTitle className="text-center" tag="h4">
                        Log in
                    </CardTitle>
                    <Form inline>
                        <FormGroup className="mb-2 me-sm-2 mb-sm-0">
                            <Label className="me-sm-2" for="exampleEmail">User id</Label>
                            <Input
                                id="Telefono"
                                name="telefono"
                                placeholder="type your user id"
                                type="email"
                                onChange={handleOnChange}
                            />
                        </FormGroup>
                        <FormGroup className="mb-2 me-sm-2 mb-sm-0">
                            <Label className="me-sm-2"
                                for="examplePassword">Password</Label>
                            <Input
                                id="Password"
                                name="password"
                                type="password"
                                onChange={handleOnChange}
                            />
                        </FormGroup>
                        <br />
                        <Button onClick={clicla} color="primary" size="lg" block >
                            <strong>Log in</strong>
                        </Button>
                        <CardText className="text-danger">{info}</CardText>
                    </Form>
                </Card>
            </Col>
        </Row>

    )
}