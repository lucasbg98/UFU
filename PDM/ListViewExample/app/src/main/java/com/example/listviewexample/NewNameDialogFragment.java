package com.example.listviewexample;

import android.app.AlertDialog;
import android.app.Dialog;
import android.content.DialogInterface;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Build;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;

import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;


import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.annotation.RequiresApi;
import androidx.fragment.app.DialogFragment;

public class NewNameDialogFragment extends DialogFragment {

    public String s;
    OnMyDialogResult r;

    @RequiresApi(api = Build.VERSION_CODES.LOLLIPOP)
    @NonNull
    @Override

    public Dialog onCreateDialog(@Nullable Bundle savedInstanceState) {

        AlertDialog.Builder builder = new AlertDialog.Builder(getActivity());
        LayoutInflater inflater = requireActivity().getLayoutInflater();
        View v = inflater.inflate(R.layout.fragment_new_name, null);


        final TextView etName = (EditText) v.findViewById(R.id.newname);

        builder.setView(v)
                .setPositiveButton("done", new DialogInterface.OnClickListener(){
                    @Override
                    public void onClick(DialogInterface dialog, int id) {
                        if( etName.getText().toString().length() < 4 ) {
                            Toast.makeText(getContext().getApplicationContext(), "invalid name!", Toast.LENGTH_LONG).show();
                            dialog.dismiss();
                        }else {
                            s = etName.getText().toString();
                            r.finish(s);
                            Toast.makeText(getContext().getApplicationContext(), s + " was added to the list!", Toast.LENGTH_LONG).show();
                        }
                    }

                });
        return builder.create();
    }

    public void setDialogResult(OnMyDialogResult dialogResult){
        r = dialogResult;
    }

    public interface OnMyDialogResult{
        void finish(String result);
    }

    public static String TAG = "PurchaseConfirmationDialog";
}


