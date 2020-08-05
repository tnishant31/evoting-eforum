package com.raatechnocrates.androidvoting;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Handler;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;


public class Login extends ActionBarActivity {

    SqliteController controller = new SqliteController(this);

    // Progress Dialog
    private ProgressDialog pDialog;

    JSONParser jsonParser = new JSONParser();

    // url to create new product
    private static String url_create_product = "http://www.proitce.com/EVoting/APP/check_user_login.php";

    // JSON Node names
    private static final String TAG_SUCCESS = "success";

    EditText username_et;
    EditText password_et;

    String username;
    String password;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        //int cnt = controller.directLogin();
        //if (cnt > 0) {
            Intent i = new Intent(this, MainActivity.class);
            startActivity(i);
          //  finish();
        //}

    }

    public void loginCheck(View v){

        username_et = (EditText)findViewById(R.id.et_login_username);
        password_et = (EditText)findViewById(R.id.et_login_password);

        username = username_et.getText().toString().trim();
        password = password_et.getText().toString().trim();

        if (username.length()<=0) {
            Toast.makeText(this, "Enter Email Id", Toast.LENGTH_SHORT).show();
            username_et.requestFocus();
        }
        else if(password.length()<=0) {
            Toast.makeText(this,"Enter Password", Toast.LENGTH_SHORT).show();
            password_et.requestFocus();
        }
        else {
            //controller.insertUser(username,password);
            //Toast.makeText(this,"Account Created Successfully", Toast.LENGTH_SHORT).show();
            //Intent i = new Intent(this, Login.class);
            //startActivity(i);
            //finish();

            new CheckUser().execute();
        }

    }

    public void register(View v){
        Intent i = new Intent(this, Register.class);
        startActivity(i);
        finish();
    }

    public void resetPassword(View v){

    }

    class CheckUser extends AsyncTask<String, String, String> {

        /**
         * Before starting background thread Show Progress Dialog
         * */
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(Login.this);
            pDialog.setMessage("Validating User.. Please Wait..");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(false);
            pDialog.show();
        }

        /**
         * Creating product
         * */
        protected String doInBackground(String... args) {

            // Building Parameters
            List<NameValuePair> params = new ArrayList<NameValuePair>();
            params.add(new BasicNameValuePair("username", username));
            params.add(new BasicNameValuePair("password", password));

            // getting JSON Object
            // Note that create product url accepts POST method
            JSONObject json = jsonParser.makeHttpRequest(url_create_product, "POST", params);

            // check log cat fro response
            Log.d("Create Response", json.toString());

            // check for success tag
            try {
                int success = json.getInt(TAG_SUCCESS);
                final String message = json.getString("message");
                if (success == 1) {
                    // successfully created product
                    //Toast.makeText(getApplicationContext(),"Account Created Successfully", Toast.LENGTH_SHORT).show();
                    Handler handler =  new Handler(getApplicationContext().getMainLooper());
                    handler.post( new Runnable(){
                        public void run(){
                            Toast.makeText(getApplicationContext(), message,Toast.LENGTH_SHORT).show();
                        }
                    });
                    controller.checkLogin(username);
                    Intent i = new Intent(getApplicationContext(), MainActivity.class);
                    startActivity(i);
                    finish();
                } else {
                    password_et.post(new Runnable() {
                        @Override
                        public void run() {
                            password_et.setText("");
                        }
                    });
                    username_et.post(new Runnable() {
                        @Override
                        public void run() {
                            username_et.requestFocus();
                        }
                    });
                    Handler handler =  new Handler(getApplicationContext().getMainLooper());
                    handler.post( new Runnable(){
                        public void run(){
                            Toast.makeText(getApplicationContext(),message, Toast.LENGTH_LONG).show();
                        }
                    });



                }
            } catch (JSONException e) {
                e.printStackTrace();
            }

            return null;
        }

        /**
         * After completing background task Dismiss the progress dialog
         * **/
        protected void onPostExecute(String file_url) {
            // dismiss the dialog once done
            pDialog.dismiss();
        }

    }
}
