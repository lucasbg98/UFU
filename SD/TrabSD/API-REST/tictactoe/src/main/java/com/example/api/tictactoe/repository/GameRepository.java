package com.example.api.tictactoe.repository;

import java.util.HashMap;
import java.util.Map;

import org.springframework.stereotype.Component;

import com.example.api.tictactoe.model.Game;

@Component
public class GameRepository {
    
    private static Game instance;
    private static Map<String, Game> games;


    public GameRepository(){
        games = new HashMap<>();
    }

    public static Map<String, Game> getGames() {
        return games;
    }

    public static void setGames(String id, Game game) {
        games.put(id, game);
    }

    public static Game getInstance() {
        if (instance == null) {
            instance = new Game();
        }
        return instance;
    }


    
}
