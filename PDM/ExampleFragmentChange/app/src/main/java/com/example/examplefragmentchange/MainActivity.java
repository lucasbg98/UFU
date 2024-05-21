package com.example.examplefragmentchange;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;

public class MainActivity extends AppCompatActivity {

    FirstFragment f1 = new FirstFragment();
    SecondFragment f2 = new SecondFragment();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        getSupportFragmentManager().beginTransaction()
                .replace(R.id.flFragment, f1, null)
                .commit();
    }

    public void buttonFirst(View v){
        getSupportFragmentManager().beginTransaction()
                .replace(R.id.flFragment, f1, null)
                .addToBackStack(null)
                .commit();
    }

    public void buttonSecond(View v){
        getSupportFragmentManager().beginTransaction()
                .replace(R.id.flFragment, f2, null)
                .addToBackStack(null)
                .commit();
    }
}