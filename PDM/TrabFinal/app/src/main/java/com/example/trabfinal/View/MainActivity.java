package com.example.trabfinal.View;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.GridView;
import android.widget.SearchView;

import com.example.trabfinal.Model.Games;
import com.example.trabfinal.Model.GamesList;
import com.example.trabfinal.Model.ImageAdapter;
import com.example.trabfinal.R;
import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

import java.io.Serializable;
import java.util.ArrayList;

public class MainActivity extends AppCompatActivity implements BottomNavigationView.OnNavigationItemSelectedListener {

    BottomNavigationView bnv;
    ImageAdapter adapter;
    GamesList gameList = new GamesList();
    ArrayList<Games> list = gameList.getList(); // Recieves an arraylist of games that was setted on another class
    GridView gamesGridView;
    SearchView sv;

    private DatabaseReference mDatabase;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        //get the reference from the Database
        mDatabase = FirebaseDatabase.getInstance().getReference();

        sv = (SearchView) findViewById(R.id.search_view);

        //controls the bottomNavigationView and sets the selected "page" as home so indicates what page the user is
        bnv = findViewById(R.id.bottomNavigationView);
        bnv.setOnNavigationItemSelectedListener(this);
        bnv.setSelectedItemId(R.id.home);


        adapter = new ImageAdapter(this, list);

        //Insert the elements from the arrayList to the Database
        for (int i = 0; i < list.size(); i++) {
            mDatabase.child("Games").child(list.get(i).getName()).setValue(list.get(i));
        }

        gamesGridView = (GridView) findViewById(R.id.grid_view);
        gamesGridView.setAdapter(adapter);

        gamesGridView.setOnItemClickListener(new AdapterView.OnItemClickListener() {

            //sends to the activity using intent with Serializable, wich makes so you can pass the whole object through intent
            @Override
            public void onItemClick(AdapterView<?> parent, final View view,
                                    int position, long id) {

                Intent i = new Intent(getApplicationContext(), GamePageActivity.class);

                i.putExtra("Key", (Serializable) list.get(position));
                startActivity(i);

            }

        });
    }

    //Controls the SearchView with TextListener
    @Override
    protected void onStart() {
        super.onStart();
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
        ImageAdapter imgadp = new ImageAdapter(this, searchGames);
        gamesGridView.setAdapter(imgadp);

        gamesGridView.setOnItemClickListener(new AdapterView.OnItemClickListener() {

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
            case R.id.game_list:

                 i = new Intent(getApplicationContext(), GamesListActivity.class);
                 startActivity(i);
            break;
            case R.id.home:

                return true;

        }
        return false;
    }
}