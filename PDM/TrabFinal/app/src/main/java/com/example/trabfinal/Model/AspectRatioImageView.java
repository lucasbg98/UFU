package com.example.trabfinal.Model;

import android.content.Context;
import android.util.AttributeSet;
import android.widget.ImageView;

//This Class is what makes the Home Activty looks that way with the images all same size using all the screen
public class AspectRatioImageView extends androidx.appcompat.widget.AppCompatImageView
{
    public AspectRatioImageView(Context context)
    {
        super(context);
    }

    public AspectRatioImageView(Context context, AttributeSet attrs)
    {
        super(context, attrs);
    }

    public AspectRatioImageView(Context context, AttributeSet attrs, int defStyle)
    {
        super(context, attrs, defStyle);
    }


    @Override
    protected void onMeasure(int widthMeasureSpec, int heightMeasureSpec)
    {
        super.onMeasure(widthMeasureSpec, heightMeasureSpec);
        setMeasuredDimension(getMeasuredWidth(), getMeasuredWidth() + (getMeasuredWidth() / 2));
    }
}
