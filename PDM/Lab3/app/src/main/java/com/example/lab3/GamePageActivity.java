package com.example.lab3;

import android.app.Activity;
import android.content.Intent;
import android.media.Image;
import android.os.Bundle;
import android.widget.ImageView;
import android.widget.TextView;

import java.io.Serializable;


public class GamePageActivity extends Activity implements Serializable {

    TextView tv1;
    TextView tv2;
    ImageView iv;


    public GamePageActivity(){

    }


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.game_page);

        Intent i = getIntent();
        Games g = (Games) i.getSerializableExtra("Key");
        tv1 = (TextView) findViewById(R.id.description);
        tv1.setText(g.getDescription());

        tv2 = (TextView) findViewById(R.id.name);
        tv2.setText(g.getName());

        iv = (ImageView) findViewById(R.id.image);
        iv.setImageResource(g.getImage2());


    }

}
