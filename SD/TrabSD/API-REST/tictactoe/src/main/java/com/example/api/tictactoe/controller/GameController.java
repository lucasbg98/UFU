package com.example.api.tictactoe.controller;

import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.example.api.tictactoe.dto.JoinDTO;
import com.example.api.tictactoe.model.Board;
import com.example.api.tictactoe.model.Game;
import com.example.api.tictactoe.model.Player;
import com.example.api.tictactoe.service.GameService;

@CrossOrigin(origins = "*", allowedHeaders = "*")
@RestController
@RequestMapping("/tictactoe")
public class GameController {
    
    @Autowired
    private GameService gameService;

    @PostMapping("/create")
    public ResponseEntity<Game> create(@RequestBody Player player){
        return ResponseEntity.ok(gameService.create(player));
    }

    @PostMapping("/join")
    public ResponseEntity<Game> join(@RequestBody JoinDTO joinDTO){
        Game game = gameService.join(joinDTO);
        if ( game == null ){
            return ResponseEntity.notFound().build();
        }

        return ResponseEntity.ok(game);
    }

    @PostMapping("/play")
    public ResponseEntity<Game> play(@RequestBody Board board){
        Game game = gameService.playGame(board);
        if ( game == null ){
            return ResponseEntity.notFound().build();
        }

        return ResponseEntity.ok(game);
    }

    @PostMapping("/servers")
    public Map<String, Game> servers(){
       return gameService.servers();

    }


}
