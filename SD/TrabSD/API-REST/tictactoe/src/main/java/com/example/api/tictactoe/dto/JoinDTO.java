package com.example.api.tictactoe.dto;

import com.example.api.tictactoe.model.Player;

public class JoinDTO {
    Player player;
    String id;
    
    public Player getPlayer() {
        return player;
    }
    public void setPlayer(Player player) {
        this.player = player;
    }
    public String getId() {
        return id;
    }
    public void setId(String id) {
        this.id = id;
    }


    
}
