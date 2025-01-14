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
    if (telefono === "" && password === "") {
      this.setState({ info: "Campos vacíos" })
    } else if (telefono === "dani@gmail.com" && password === "1234") {
      this.setState({ logged: true })
    } else {
      this.setState({ info: "Datos Incorrectos" })
    }
    return this.state.info
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
        <Menu menuItem={this.state.menuItem}
          changeMenu={(item) => this.changeMenu(item)} />
        {obj}
      </div>
    );
  }
}

export default App;