package com.example.api.tictactoe.model;

public class Game {
    
    private Player player1;
    private Player player2;
    private int[] board;
    private String winner;
    
    public Player getPlayer1() {
        return player1;
    }
    public void setPlayer1(Player player1) {
        this.player1 = player1;
    }
    public Player getPlayer2() {
        return player2;
    }
    public void setPlayer2(Player player2) {
        this.player2 = player2;
    }
    public int[] getBoard() {
        return board;
    }
    public void setBoard(int[] board) {
        this.board = board;
    }
    public String getWinner() {
        return winner;
    }
    public void setWinner(String winner) {
        this.winner = winner;
    }

    



}
