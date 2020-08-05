package com.raatechnocrates.androidvoting;

import android.app.Activity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

/**
 * Created by Nikul on 02/10/2016.
 */
public class CustomAdapter extends ArrayAdapter<String> {
    private final Activity context;
    private final String[] mnuList;
    private final int[] icons;

    public CustomAdapter(Activity context, String[] mnuList, int[] icons){
        super(context, R.layout.list_view,mnuList);
        this.context = context;
        this.mnuList= mnuList;
        this.icons=icons;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        LayoutInflater inflater = context.getLayoutInflater();
        View rowView = inflater.inflate(R.layout.list_view, null, true);
        ImageView icon= (ImageView) rowView.findViewById(R.id.imgView);
        TextView list= (TextView) rowView.findViewById(R.id.list_item);

        icon.setImageResource(icons[position]);
        list.setText(mnuList[position]);

        return rowView;
    }
}
