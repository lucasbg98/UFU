package com.example.listviewexample;

import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.DialogFragment;
import androidx.fragment.app.FragmentManager;

import android.app.Activity;
import android.content.Context;
import android.graphics.Color;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Random;

public class MainActivity extends AppCompatActivity{

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        final ListView listview = (ListView) findViewById(R.id.listview);



        String[] values = new String[] { "Lewis Hamilton", "Valteri Bottas", "Max Verstappen",
                "Sergio Perez", "Lando Norris", "Daniel Ricciardo", "Charles Leclerc", "Carlos Sainz",
                "Sebastian Vettel", "Lance Stroll", "Fernando Alonso", "Sebastian Ocon", "Pierre Gasly", "Yuki Tsunoda",
                "Toni Giovinazzi", "Kimi Raikkonen", "George Russell", "Nicholas Latifi", "Mick Schumacher", "Niki Mazepin",
                };

        final ArrayList<String> list = new ArrayList<String>();
        for (int i = 0; i < values.length; ++i) {
            list.add(values[i]);
        }

        FloatingActionButton fab = findViewById(R.id.floatingActionButton);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                NewNameDialogFragment newFragment = new NewNameDialogFragment();
                newFragment.show(getSupportFragmentManager(),NewNameDialogFragment.TAG);

                newFragment.setDialogResult(new NewNameDialogFragment.OnMyDialogResult() {
                    @Override
                    public void finish(String result) {
                        list.add(result);
                    }
                });

            }
        });

        final ArrayAdapter adapter = new ArrayAdapter(this,
                android.R.layout.simple_list_item_1, list);
        listview.setAdapter(adapter);

        listview.setOnItemClickListener(new AdapterView.OnItemClickListener() {

            @Override
            public void onItemClick(AdapterView<?> parent, final View view,
                                    int position, long id) {
                Random rnd = new Random();
                view.setBackgroundColor(Color.argb(0x80, rnd.nextInt(256), rnd.nextInt(256), rnd.nextInt(256)));

            }



        });
        }





}