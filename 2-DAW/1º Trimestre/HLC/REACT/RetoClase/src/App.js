import 'bootstrap/dist/css/bootstrap.min.css';
import { Button } from 'reactstrap';
import { Component } from 'react';
import './App.css';

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      listaBtn: Array(5).fill("secondary"),
      listaNum: Array(5).fill(0),
    };
  }

  clickBtn(numBtn) {
    let auxBtn = this.state.listaBtn
    let auxNum = this.state.listaNum
    auxBtn[numBtn] = "primary"
    auxNum[numBtn] = auxNum[numBtn] + 1

    this.setState({
      listaBtn: auxBtn,
      listaNum: auxNum,
    })
  }

  render() {
    return (
      <div className="App">
        <header className="App-header">
          <Botoncillo color={this.state.listaBtn[0]} pos={0} click={(n)=>this.clickBtn(n)} />
          <Botoncillo color={this.state.listaBtn[1]} pos={1} click={(n)=>this.clickBtn(n)} />
          <Botoncillo color={this.state.listaBtn[2]} pos={2} click={(n)=>this.clickBtn(n)} />
          <Botoncillo color={this.state.listaBtn[3]} pos={3} click={(n)=>this.clickBtn(n)} />
          <Botoncillo color={this.state.listaBtn[4]} pos={4} click={(n)=>this.clickBtn(n)} />
        </header>
      </div>
    );
  }
}

function Botoncillo(props) {
  return (
    <Button color={props.color} onClick={()=>props.click(props.pos)}>{props.contador}</Button>
  );
}

export default App;
