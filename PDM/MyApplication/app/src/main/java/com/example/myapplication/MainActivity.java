package com.example.myapplication;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.Random;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
    }

    Random rand = new Random();

    int soma = 0;


    public void rolarDado(View view) {
        int x = 0;
        String text;
        ImageView im = (ImageView) findViewById(R.id.imageView);
        TextView tx = (TextView) findViewById(R.id.textView);

        while(x == 0){
            x = rand.nextInt(7);
        }

        switch(x) {
            case 1:
                soma += x;
                text = "Soma total: " + soma;

                im.setImageResource(R.drawable.dado1);

                tx.setText(text);
                break;
            case 2:
                soma += x;
                text = "Soma total: " + soma;

                im.setImageResource(R.drawable.dado2);

                tx.setText(text);
                break;
            case 3:
                soma += x;
                text = "Soma total: " + soma;

                im.setImageResource(R.drawable.dado3);

                tx.setText(text);
                break;
            case 4:
                soma += x;
                text = "Soma total: " + soma;

                im.setImageResource(R.drawable.dado4);

                tx.setText(text);
                break;
            case 5:
                soma += x;
                text = "Soma total: " + soma;

                im.setImageResource(R.drawable.dado5);

                tx.setText(text);
                break;
            case 6:
                soma += x;
                text = "Soma total: " + soma;

                im.setImageResource(R.drawable.dado6);

                tx.setText(text);
                break;
        }
    }

    public void limparDado(View view){
        soma = 0;
        String text = "Soma total: " + soma;

        ImageView im = (ImageView) findViewById(R.id.imageView);
        TextView tx = (TextView) findViewById(R.id.textView);

        tx.setText(text);
        im.setImageResource(R.drawable.init);

    }
}