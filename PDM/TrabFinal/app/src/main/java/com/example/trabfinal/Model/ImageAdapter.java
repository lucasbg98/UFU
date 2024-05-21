package com.example.trabfinal.Model;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.example.trabfinal.R;

import java.util.ArrayList;

//Adapter class for the images on the MainActivity
public class ImageAdapter extends BaseAdapter {
    private Context context; //context
    private ArrayList<Games> games; //data source of the list adapter

    //public constructor
    public ImageAdapter(Context context, ArrayList<Games> games) {
        this.context = context;
        this.games = games;
    }

    @Override
    public int getCount() {
        return games.size(); //returns total of items in the list
    }

    @Override
    public Object getItem(int position) {
        return games.get(position); //returns list item at the specified position
    }

    @Override
    public long getItemId(int position) {
        return position;
    }


    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        // inflate the layout for each list row
        if (convertView == null) {
            convertView = LayoutInflater.from(context).
                    inflate(R.layout.grid_layout, parent, false);
        }

        // get current item to be displayed
        Games currentItem = (Games) getItem(position);

        // get the TextView for item name and item description
        AspectRatioImageView imageViewGames = (AspectRatioImageView)
                convertView.findViewById(R.id.grid_item_image);

        TextView textViewItemName = (TextView)
                convertView.findViewById(R.id.grid_item_label);
        //TextView textViewItemDescription = (TextView)
                //convertView.findViewById(R.id.text_view_item_description);

        //sets the text for item name and item description from the current item object
        textViewItemName.setText(currentItem.getName());
        //textViewItemDescription.setText(currentItem.getDescription());

        imageViewGames.setImageResource(currentItem.getImage2());
        //imageViewGames.setScaleType(ImageView.ScaleType.CENTER_CROP);
        //imageViewGames.setLayoutParams(new GridView.LayoutParams(70, 70));


        // returns the view for the current row
        return convertView;
    }

}


