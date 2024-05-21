package com.example.trabfinal.View;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.example.trabfinal.Model.Games;
import com.example.trabfinal.R;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

import java.io.Serializable;


public class GamePageActivity extends Activity implements Serializable {

    TextView tv1;
    TextView tv2;
    ImageView iv;
    Button btn_add, btn_remove;
    Intent i;
    Games g;

    private DatabaseReference ref;


    public GamePageActivity(){

    }


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_game_page);


         i = getIntent();
         g = (Games) i.getSerializableExtra("Key");

         ref = FirebaseDatabase.getInstance().getReference();

        btn_add = (Button) findViewById(R.id.btn_add);
        btn_remove = (Button) findViewById(R.id.btn_remove);

        tv1 = (TextView) findViewById(R.id.description);
        tv1.setText(g.getDescription());

        tv2 = (TextView) findViewById(R.id.name);
        tv2.setText(g.getName());

        iv = (ImageView) findViewById(R.id.image);
        iv.setImageResource(g.getImage2());



    }


    //Method called when clicked on the button Add
    public void clickAdd(View view) {

        ref = FirebaseDatabase.getInstance().getReference().child("List"); // Gets the reference from the child "List" in the database
        ref.child(g.getName()).setValue(g); //Add the object into the database

        Toast.makeText(this,  g.getName() +" was added to your List!",
                Toast.LENGTH_LONG).show();

        i = new Intent(getApplicationContext(), GamesListActivity.class); //calls an intent to the GamesListActivity
        startActivity(i);

    }

    //Method called when clicked on the button Remove
    public void clickRemove(View view){
       ref = FirebaseDatabase.getInstance().getReference().child("List"); // Gets the reference from the child "List" in the database
       ref.child(g.getName()).removeValue(); // Remove the child where the name is equal to g.getName()

        Toast.makeText(this, "Game was removed from your List!",
                Toast.LENGTH_LONG).show();

        i = new Intent(getApplicationContext(), GamesListActivity.class); // calls an intent to the GamesListActivity
        startActivity(i);

    }
}