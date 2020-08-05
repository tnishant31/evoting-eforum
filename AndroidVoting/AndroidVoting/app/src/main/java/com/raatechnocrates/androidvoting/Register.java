package com.raatechnocrates.androidvoting;

import android.app.Activity;
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
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;


public class Register extends Activity {

    // Progress Dialog
    private ProgressDialog pDialog;

    JSONParser jsonParser = new JSONParser();

    // url to create new product
    private static String url_create_product = "http://www.proitce.com/EVoting/APP/create_user.php";

    // JSON Node names
    private static final String TAG_SUCCESS = "success";



    EditText username_et;
    EditText email_et;
    EditText mobile_et;
    EditText password_et;
    EditText repassword_et;
    EditText address_et;
    EditText class_et;
    EditText division_et;

    public static String username = "";
    public static String email = "";
    public static String mobile = "";
    public static String password = "";
    public static String repassword = "";
    public static String address = "";
    public static String uclass = "";
    public static String division = "";

    Button btnLogin;
    // Asyntask
    AsyncTask<Void, Void, Void> mRegisterTask;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);


        username_et = (EditText)findViewById(R.id.et_register_name);
        email_et = (EditText)findViewById(R.id.et_register_email);
        mobile_et = (EditText)findViewById(R.id.et_register_mobile);
        password_et = (EditText)findViewById(R.id.et_register_password);
        repassword_et = (EditText)findViewById(R.id.et_register_repassword);
        address_et = (EditText)findViewById(R.id.et_register_address);
        class_et = (EditText)findViewById(R.id.et_register_class);
        division_et = (EditText)findViewById(R.id.et_register_division);

        btnLogin=(Button)findViewById(R.id.btn_login);

        btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                username = username_et.getText().toString().trim();
                email = email_et.getText().toString().trim();
                mobile = mobile_et.getText().toString().trim();
                password = password_et.getText().toString().trim();
                repassword = repassword_et.getText().toString().trim();
                address = address_et.getText().toString().trim();
                uclass = class_et.getText().toString().trim();
                division = division_et.getText().toString().trim();

                if (username.length()<=0) {
                    Toast.makeText(Register.this, "Enter Name", Toast.LENGTH_SHORT).show();
                    username_et.requestFocus();
                }
                else if(email.length()<=0) {
                    Toast.makeText(Register.this,"Enter Email ID", Toast.LENGTH_SHORT).show();
                    email_et.requestFocus();
                }
                else if(mobile.length()<=0) {
                    Toast.makeText(Register.this,"Enter Mobile No", Toast.LENGTH_SHORT).show();
                    mobile_et.requestFocus();
                }
                else if(address.length()<=0) {
                    Toast.makeText(Register.this,"Enter Address", Toast.LENGTH_SHORT).show();
                    address_et.requestFocus();
                }
                else if(uclass.length()<=0) {
                    Toast.makeText(Register.this,"Enter Class", Toast.LENGTH_SHORT).show();
                    class_et.requestFocus();
                }
                else if(division.length()<=0) {
                    Toast.makeText(Register.this,"Enter Division", Toast.LENGTH_SHORT).show();
                    division_et.requestFocus();
                }
                else if(password.length()<=0) {
                    Toast.makeText(Register.this,"Enter Password", Toast.LENGTH_SHORT).show();
                    password_et.requestFocus();
                }
                else if(repassword.length()<=0) {
                    Toast.makeText(Register.this,"Retype Password", Toast.LENGTH_SHORT).show();
                    repassword_et.requestFocus();
                }
                else if(password.equals(repassword) == false) {
                    Toast.makeText(Register.this,"Password Mismatch", Toast.LENGTH_SHORT).show();
                    repassword_et.setText("");
                    repassword_et.requestFocus();
                }
                else {

                    new CreateNewUser().execute();
                }
            }
        });
    }


    public void loginBack(View v){
        Intent i = new Intent(this, Login.class);
        startActivity(i);
        finish();
    }

    /**
     * Background Async Task to Create new product
     * */
    class CreateNewUser extends AsyncTask<String, String, String> {

        /**
         * Before starting background thread Show Progress Dialog
         * */
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(Register.this);
            pDialog.setMessage("Registering User.. Please Wait..");
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
            params.add(new BasicNameValuePair("emailid", email));
            params.add(new BasicNameValuePair("mobileno", mobile));
            params.add(new BasicNameValuePair("password", password));
            params.add(new BasicNameValuePair("address", address));
            params.add(new BasicNameValuePair("uclass", uclass));
            params.add(new BasicNameValuePair("division", division));


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
                    Intent i = new Intent(getApplicationContext(), Login.class);
                    startActivity(i);
                    finish();


                } else {
                    if (success==2)
                    {
                        email_et.post(new Runnable() {
                            @Override
                            public void run() {
                                email_et.requestFocus();
                            }
                        });
                    }
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
