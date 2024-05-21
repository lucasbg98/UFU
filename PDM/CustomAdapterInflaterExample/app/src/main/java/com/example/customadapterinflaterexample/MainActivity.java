package com.example.customadapterinflaterexample;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.widget.ListView;

import java.util.ArrayList;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Setup the data source
        ArrayList<Item> itemsArrayList = new ArrayList<>();
        itemsArrayList.add(new Item("Item A", "Esta é a descrição do item A."));
        itemsArrayList.add(new Item("Item B", "Agora vamos para a descrição do item B..."));
        itemsArrayList.add(new Item("Item C", "E agora a do item C, inesperado, não é?"));
        itemsArrayList.add(new Item("Item D", "O item D também tem descrição..."));
        itemsArrayList.add(new Item("Item E", "O item E, adivinha..."));
        itemsArrayList.add(new Item("Item F", "E por fim a do item F, que criatividade!"));


        // instantiate the custom list adapter
        CustomListAdapter adapter = new CustomListAdapter(this, itemsArrayList);

        // get the ListView and attach the adapter
        ListView itemsListView  = (ListView) findViewById(R.id.list_view_items);
        itemsListView.setAdapter(adapter);
    }
}