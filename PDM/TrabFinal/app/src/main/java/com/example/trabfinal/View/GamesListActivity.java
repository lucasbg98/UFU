package com.example.trabfinal.View;

import android.content.Intent;
import android.os.Bundle;

import com.example.trabfinal.Model.CustomListAdapter;
import com.example.trabfinal.Model.Games;
import com.example.trabfinal.R;
import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.SearchView;
import android.widget.Toast;


import java.io.Serializable;
import java.util.ArrayList;

public class GamesListActivity extends AppCompatActivity implements Serializable , BottomNavigationView.OnNavigationItemSelectedListener {

    private ArrayList<Games> list = new ArrayList<>();
    BottomNavigationView bnv;
    DatabaseReference ref;
    ListView gamesListView;
    SearchView sv;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_games_list);


        ref = FirebaseDatabase.getInstance().getReference().child("List"); // Get Reference from Database

        sv = (SearchView) findViewById(R.id.search_view2);

        bnv = findViewById(R.id.bottomNavigationView);
        bnv.setOnNavigationItemSelectedListener(this);
        bnv.setSelectedItemId(R.id.game_list);


        CustomListAdapter adapter = new CustomListAdapter(list);

        gamesListView = (ListView) findViewById(R.id.list_view);
        gamesListView.setAdapter(adapter);

        gamesListView.setOnItemClickListener(new AdapterView.OnItemClickListener() {

            @Override
            public void onItemClick(AdapterView<?> parent, final View view,
                                    int position, long id) {

                Intent i = new Intent(getApplicationContext(), GamePageActivity.class);

                i.putExtra("Key", (Serializable) list.get(position));
                startActivity(i);

            }
        });

        // checks everytime that user removes/add any game to the list
        if(ref != null){

            ref.addValueEventListener(new ValueEventListener() {
                @Override
                public void onDataChange(@NonNull DataSnapshot snapshot) {
                    if(snapshot.exists()){
                        for(DataSnapshot ds: snapshot.getChildren()){
                            list.add(ds.getValue(Games.class));  // add to the list the value of the game from the database
                        }
                        CustomListAdapter adapter = new CustomListAdapter(list);

                        ListView gamesListView = (ListView) findViewById(R.id.list_view);
                        gamesListView.setAdapter(adapter);
                    }

                }

                @Override
                public void onCancelled(@NonNull DatabaseError error) {
                    Toast.makeText(GamesListActivity.this, error.getMessage(), Toast.LENGTH_SHORT).show();
                }
            });
        }

        //Checks the SearchView
        if (sv != null) {
            sv.setOnQueryTextListener(new SearchView.OnQueryTextListener() {
                @Override
                public boolean onQueryTextSubmit(String s) {
                    return false;
                }

                @Override
                public boolean onQueryTextChange(String s) {
                    search(s);
                    return false;
                }
            });
        }

    }


    //Search method
    private void search(String str) {
        ArrayList<Games> searchGames = new ArrayList<Games>();
        for (Games object : list) {
            if (object.getName().toLowerCase().contains(str.toLowerCase())) {
                searchGames.add(object);
            }
        }
        CustomListAdapter customAdapter = new CustomListAdapter(searchGames);
        gamesListView.setAdapter(customAdapter);

        gamesListView.setOnItemClickListener(new AdapterView.OnItemClickListener() {

            @Override
            public void onItemClick(AdapterView<?> parent, final View view,
                                    int position, long id) {

                Intent i = new Intent(getApplicationContext(), GamePageActivity.class);

                i.putExtra("Key", (Serializable) searchGames.get(position));
                startActivity(i);

            }

        });

    }

    //Method to control the navbar to go to another activity when selected
    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        Intent i;

        switch (item.getItemId()) {
            case R.id.home:

                i = new Intent(getApplicationContext(), MainActivity.class);
                startActivity(i);
                break;
            case R.id.game_list:

                return true;

        }
        return false;
    }


}