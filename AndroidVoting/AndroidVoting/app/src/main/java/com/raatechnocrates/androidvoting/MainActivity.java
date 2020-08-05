package com.raatechnocrates.androidvoting;

import android.content.Intent;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;


public class MainActivity extends AppCompatActivity {

    SqliteController controller = new SqliteController(this);

    ListView lv;
    public static int[] icons={R.drawable.ic_user,R.drawable.ic_vote,R.drawable.ic_result,R.drawable.ic_forum,R.drawable.ic_changepassword,R.drawable.ic_exit};
    public static String[] mnuList={"View Candidates","Cast Vote","View Results","Forums","Change Password","Exit"};

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        CustomAdapter customAdapter=new CustomAdapter(MainActivity.this,mnuList,icons);
        lv=(ListView)findViewById(R.id.listView);
        lv.setAdapter(customAdapter);
        lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                if(mnuList[position].equals("View Candidates")){
                    Intent intent=new Intent(MainActivity.this,ViewCandidates.class);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                }
                else if(mnuList[position].equals("Cast Vote")){
                    Intent intent=new Intent(MainActivity.this,CastVote.class);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                }
                else if(mnuList[position].equals("View Results")){
                    Intent intent=new Intent(MainActivity.this,ViewResults.class);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                }
                else if(mnuList[position].equals("Forums")){
                    Intent intent=new Intent(MainActivity.this,Forum.class);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                }
                else if(mnuList[position].equals("Change Password")){
                    Intent intent=new Intent(MainActivity.this,ChangePassword.class);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                }
                else if(mnuList[position].equals("Exit")){
                    //Toast.makeText(getApplicationContext(),mnuList[position],Toast.LENGTH_SHORT);
                    controller.funLogout();
                    finish();

                }
            }
        });
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }
}
