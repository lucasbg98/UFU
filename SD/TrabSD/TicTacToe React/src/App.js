import { useEffect, useState } from 'react';
import './App.css';
import './service/api';
import { startGame, servers, join, playGame, updateBoard } from './service/api';

function App() {
  
  const arrayStart = Array(9).fill('')
  const [board, setBoard] = useState(arrayStart)
  const [player, setPlayer] = useState();
  const [serversGame, setServers] = useState([]);
  const [idGame, setIdGame] = useState(1)
  const [buttonStart, setButtonStart] = useState(false)
  const [loader, setLoader] = useState(false)
  const [winner, setWinner] = useState('')

  useEffect(()=>{


    async function getServers() {
      let response = await servers()
      setServers(Object.entries(response))
    }

    getServers()

  },[board])



  const handleClick = async(position) => {

    let response = await playGame(idGame, position, player)
    setBoard(response.board)
    console.log(response.winner)
    setWinner(response.winner)

  }

  const handleClickstartGame = () => {

    async function initialGame(){
      let response = await startGame()
      setBoard(response.board)
    }
    setPlayer(1)
    setButtonStart(true)

    initialGame()
  }

  const verifyType = (value) =>{

      switch(value){

        case 0: return ''
        case 1: return 'X'
        case 2: return 'O'

        default:

      }
  }

  const handleClickJoinServer = async(idGame) =>{

    window.confirm("Deseja entrar na sessão de jogo ?\nPressione OK ou Cancel.");

    let resp = await join(idGame)

    if(resp)
      setPlayer(2)
    
  }


  return (
    <div className="App">
      <h1>Jogo da velha  {winner ? ' - ' + winner + " venceu!" : ''}</h1>
      <main className="container">
        <div className='container-tictactoes'>
          {
           board.map((_value,indice) =>{
              return (
                <div
                  key={indice} 
                  onClick={()=>handleClick(indice)}
                  className={`field ${verifyType(_value)}`}
                >
                  {verifyType(_value)}
                </div>
              )
           }) 
          }
        </div>
        <div className='listServer'>
          <div>
            <h3>servidores</h3>
            <div className='list'>
              <ul>
                {
                  serversGame.map((value,indice)=>{
                    return <li onClick={()=>handleClickJoinServer(value[indice][0])} key={indice}>{value[indice][0]}</li>
                  })
                }
              </ul>
            </div>
          </div>
        </div>
      </main>
      <footer className='footer'>
        <button onClick={()=>handleClickstartGame()} disabled={buttonStart}>Iniciar jogo</button>
      
      </footer>
    </div>
  );
}

export default App;
