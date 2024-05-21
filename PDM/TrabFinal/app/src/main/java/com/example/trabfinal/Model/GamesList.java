package com.example.trabfinal.Model;

import com.example.trabfinal.R;
import com.example.trabfinal.Model.Games;

import java.util.ArrayList;

public class GamesList {

    ArrayList<Games> list = new ArrayList<Games>();

    public GamesList(){
        list.add(new Games("Elden Ring", "Rise, Tarnished, and be guided by grace to brandish the power of the Elden Ring and become an Elden Lord in the Lands Between.",R.drawable.elden_ring, R.drawable.elden_ring2));
        list.add(new Games("Assassins Creed Valhalla", "Become Eivor, a legendary Viking raider on a quest for glory. Explore England's Dark Ages as you raid your enemies, grow your settlement, and build your political power.", R.drawable.assassins_creed, R.drawable.assassins_creed2));
        list.add(new Games("League of Legends", "League of Legends is a team-based strategy game where two teams of five powerful champions face off to destroy the other’s base. Choose from over 140 champions to make epic plays, secure kills, and take down towers as you battle your way to victory.", R.drawable.lol, R.drawable.lol2));
        list.add(new Games("Lost Ark", "Embark on an odyssey for the Lost Ark in a vast, vibrant world: explore new lands, seek out lost treasures, and test yourself in thrilling action combat. Define your fighting style with your class and advanced class, and customize your skills, weapons, and gear to bring your might to bear as you fight against hordes of enemies, colossal bosses, and dark forces seeking the power of the Ark in this action-packed free-to-play RPG.", R.drawable.lost_ark, R.drawable.lost_ark2));
        list.add(new Games("New World", "Explore a thrilling, open-world MMO filled with danger and opportunity where you'll forge a new destiny for yourself as an adventurer shipwrecked on the supernatural island of Aeternum. Endless opportunities to fight, forage, and forge await you among the island's wilderness and ruins. Channel supernatural forces or wield deadly weapons in a classless, real-time combat system, and fight alone, with a small team, or in massed armies for PvE and PvP battles—the choices are all yours.", R.drawable.new_world, R.drawable.new_world2));
        list.add(new Games("Valorant", "Blend your style and experience on a global, competitive stage. You have 13 rounds to attack and defend your side using sharp gunplay and tactical abilities. And, with one life per-round, you'll need to think faster than your opponent if you want to survive. Take on foes across Competitive and Unranked modes as well as Deathmatch and Spike Rush.", R.drawable.valorant, R.drawable.valorant2));

    }

    public ArrayList<Games> getList(){
        return this.list;
    }

}
