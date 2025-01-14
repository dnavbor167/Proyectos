import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Component } from 'react';
import Menu from './Components/Menus';
import AppLogin from './Components/AppLogin';

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      menuItem: "UNO",
      logged: false,
      info: "",
    }
  }

  changeMenu(item) {
    this.setState({ menuItem: item })
  }

  userLogin(telefono, password) {
    if (telefono === "" || password === "") {
      this.setState({ info: "Campos vacíos" })
      return "Campos vacíos"
    } else if (telefono === "dani@gmail.com" && password === "1234") {
      this.setState({ logged: true })
      return ""
    } else {
      this.setState({ info: "Datos Incorrectos" })
      return "Datos Incorrectos"
    }
  }

  render() {
    let obj = <><Menu
      changeMenu={(item) => this.changeMenu(item)} /></>
    if (!this.state.logged) {
      obj = <AppLogin
        userLogin={(telefono, password) => this.userLogin(telefono, password)}
        info={this.state.info}
      />
    }
    return (
      <div className="App">
        {obj}
      </div>
    );
  }
}

export default App;