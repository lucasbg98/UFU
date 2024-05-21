package com.example.lab3;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;
import com.example.lab3.databinding.ActivityMainBinding;
import java.io.Serializable;
import java.util.ArrayList;


public class MainActivity extends AppCompatActivity implements Serializable {

    private ActivityMainBinding binding;
    GamePageActivity gp = new GamePageActivity();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);


        setContentView(R.layout.activity_main);

        ArrayList<Games> list = new ArrayList<>();
        list.add(new Games("Elden Ring", "Rise, Tarnished, and be guided by grace to brandish the power of the Elden Ring and become an Elden Lord in the Lands Between.", R.drawable.elden_ring, R.drawable.elden_ring2));
        list.add(new Games("Assassins Creed Valhalla", "Become Eivor, a legendary Viking raider on a quest for glory. Explore England's Dark Ages as you raid your enemies, grow your settlement, and build your political power.", R.drawable.assassins_creed, R.drawable.assassins_creed2));
        list.add(new Games("League of Legends", "League of Legends is a team-based strategy game where two teams of five powerful champions face off to destroy the other’s base. Choose from over 140 champions to make epic plays, secure kills, and take down towers as you battle your way to victory.", R.drawable.lol, R.drawable.lol2));
        list.add(new Games("Lost Ark", "Embark on an odyssey for the Lost Ark in a vast, vibrant world: explore new lands, seek out lost treasures, and test yourself in thrilling action combat. Define your fighting style with your class and advanced class, and customize your skills, weapons, and gear to bring your might to bear as you fight against hordes of enemies, colossal bosses, and dark forces seeking the power of the Ark in this action-packed free-to-play RPG.", R.drawable.lost_ark, R.drawable.lost_ark2));
        list.add(new Games("New World", "Explore a thrilling, open-world MMO filled with danger and opportunity where you'll forge a new destiny for yourself as an adventurer shipwrecked on the supernatural island of Aeternum. Endless opportunities to fight, forage, and forge await you among the island's wilderness and ruins. Channel supernatural forces or wield deadly weapons in a classless, real-time combat system, and fight alone, with a small team, or in massed armies for PvE and PvP battles—the choices are all yours.", R.drawable.new_world, R.drawable.new_world2));
        list.add(new Games("Valorant", "Blend your style and experience on a global, competitive stage. You have 13 rounds to attack and defend your side using sharp gunplay and tactical abilities. And, with one life per-round, you'll need to think faster than your opponent if you want to survive. Take on foes across Competitive and Unranked modes as well as Deathmatch and Spike Rush.", R.drawable.valorant, R.drawable.valorant2));


        CustomListAdapter adapter = new CustomListAdapter(this, list);

        ListView gamesListView = (ListView) findViewById(R.id.list_view);
        gamesListView.setAdapter(adapter);

        gamesListView.setOnItemClickListener(new AdapterView.OnItemClickListener() {

            @Override
            public void onItemClick(AdapterView<?> parent, final View view,
                                    int position, long id) {

                Intent i = new Intent(getApplicationContext(), GamePageActivity.class);
                TextView tv = (TextView) findViewById(R.id.text_view_item_description);
                //String description = tv.getText().toString();

                i.putExtra("Key", (Serializable) list.get(position));
                startActivity(i);

            }



        });
    }

}