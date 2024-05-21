package com.example.api.tictactoe.service;

import java.util.Map;

import org.springframework.stereotype.Service;


import com.example.api.tictactoe.dto.JoinDTO;
import com.example.api.tictactoe.model.Board;
import com.example.api.tictactoe.model.Game;
import com.example.api.tictactoe.model.Player;
import com.example.api.tictactoe.repository.GameRepository;

@Service
public class GameService {

    public int sizeBoard = 9;
    
    public GameService(){}

    public Game create(Player player){

        Game game = new Game();

        game.setBoard(new int[sizeBoard]);
        game.setPlayer1(player);
        game.setWinner("");
        GameRepository.setGames("1", game);

        return game;
    } 

    public Map<String, Game> servers(){
        return GameRepository.getGames();
    }

    public Game join(JoinDTO joinDTO){

        if ( GameRepository.getGames().size() >= 1 ){

            Game game = GameRepository.getGames().get(joinDTO.getId());

            game.setPlayer2(joinDTO.getPlayer());

            return game;   
        }

        return null;
    }

    public Game playGame(Board board){

        if( !GameRepository.getGames().containsKey(board.getId()) )
            return null;


        Game game = GameRepository.getGames().get(board.getId());
        int [] newBoard = game.getBoard();

        newBoard[board.getPosition()] = board.getOption();
    
        Boolean winner = checkWinner(newBoard, board.getOption());
 
        if(winner && board.getOption() == 1){
            game.setWinner("X");
        }else if(winner && board.getOption() == 2){
            game.setWinner("O");
        }


        return game;

    }



    public boolean checkWinner(int[] board, int option){

        int[][] possibles = { {0,1,2}, {3,4,5}, {6,7,8}, {0,3,6}, {1,4,7}, {2,5,8}, {0,4,8}, {2,4,6} } ; 
        int count = 0;

        for(int i=0; i<possibles.length; i++){
            for(int j=0; j<possibles[i].length; j++){

                int pos = possibles[i][j];

                if( board[pos] == option ){
                    count++;
                }else{
                    count = 0;
                }
                
                if( count == 3 )
                    return true;
            }
            count = 0;
           
        }

        return false;
    }


}