import axios from "axios";

const api = axios.create({
  baseURL: "http://localhost:8080/tictactoe/",
});

axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';

const baseURL ="http://localhost:8080/tictactoe"


async function startGame(){

    return await api.post(baseURL + '/create',
     {
        name: 'Player1'
     })
    .then((response) => {
        return response.data
    });

}   

async function servers(){

  return await api.post(baseURL + '/servers')
  .then((response) => {
      return response.data
  });
  
}        


async function join(idGame) {

  return await api.post(baseURL + '/join',
    {
      player: {
        name: "Player2"
      },
      id: idGame
    })
    .then((response) => {
      return response.data
    });

}

async function playGame(idGame, position, option) {
  return await api.post(baseURL + '/play',
    {
      id: idGame,
      position: position,
      option: option
    })
    .then((response) => {
      return response.data
    });

}    




export  {
    startGame,
    servers,
    join,
    playGame,

}