package com.example.lab3;

import android.media.Image;

import java.io.Serializable;

public class Games implements Serializable {

    private String name;
    private String description;
    private int image, image2;


    public Games(String name, String description, int image, int image2){
        this.name = name;
        this.description = description;
        this.image = image;
        this.image2 = image2;

    }

    public String getName(){
        return this.name;
    }

    public String getDescription(){
        return this.description;
    }

    public int getImage(){
        return this.image;
    }

    public int getImage2() {
        return this.image2;
    }
}
