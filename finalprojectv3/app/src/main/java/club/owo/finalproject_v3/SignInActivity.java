package club.owo.finalproject_v3;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.vishnusivadas.advanced_httpurlconnection.PutData;

import org.json.JSONArray;
import org.json.JSONObject;

public class SignInActivity extends AppCompatActivity {

    EditText textInputEditTextEmail,textInputEditTextPw;
    Button buttonLoginSubmit;
    ProgressBar user_login_progressbar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.signin);

        textInputEditTextEmail = findViewById(R.id.user_login_form_input_email);
        textInputEditTextPw = findViewById(R.id.user_login_form_input_pw);
        buttonLoginSubmit = findViewById(R.id.user_login_confirm);
        user_login_progressbar = findViewById(R.id.user_login_progressbar);

        buttonLoginSubmit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                String email,password;
                email = String.valueOf(textInputEditTextEmail.getText());
                password = String.valueOf(textInputEditTextPw.getText());

                if(!email.equals("") && !password.equals("")) {

                    user_login_progressbar.setVisibility(View.VISIBLE);
                    //Start ProgressBar first (Set visibility VISIBLE)
                    Handler handler = new Handler(Looper.getMainLooper());
                    handler.post(new Runnable() {

                        @Override
                        public void run() {
                            //Starting Write and Read data with URL
                            //Creating array for parameters
                            String[] field = new String[2];
                            field[0] = "email";
                            field[1] = "password";
                            //Creating array for data
                            String[] data = new String[2];
                            data[0] = email;
                            data[1] = password;

                            PutData putData = new PutData("https://wen0750.club/y3_project/login.php", "POST", field, data);
                            if (putData.startPut()) {
                                if (putData.onComplete()) {
                                    user_login_progressbar.setVisibility(View.GONE);

                                    String result = putData.getResult();

                                    try {
                                        JSONObject response = new JSONObject(result);

                                        //This is the response of the login status
                                        JSONArray login_check = response.getJSONArray("login_status");
                                        JSONObject login_check_status = login_check.getJSONObject(0);
                                        String login_check_status_data = login_check_status.getString("login_check");

                                        //This is the response of the temp user bypass
                                        JSONArray temp_user_bypass = response.getJSONArray("user_data");
                                        JSONObject temp_user_bypass_data = temp_user_bypass.getJSONObject(0);
                                        String temp_user_bypass_data_uuid = temp_user_bypass_data.getString("uuid");
                                        String temp_user_bypass_data_atkey = temp_user_bypass_data.getString("ac_key");

                                        Log.d("Check_data_id", temp_user_bypass_data_uuid);
                                        Log.d("Check_data_key", temp_user_bypass_data_atkey);

                                        //Save the temp data of user action id and key
                                        SharedPreferences temp_user;
                                        temp_user = getSharedPreferences("temp_user_data", Context.MODE_PRIVATE);
                                        SharedPreferences.Editor editor = temp_user.edit();
                                        editor.putString("temp_id", temp_user_bypass_data_uuid);
                                        editor.putString("temp_key", temp_user_bypass_data_atkey);
                                        editor.apply();

                                        if(login_check_status_data.equals("Success")){
                                            Intent page = new Intent(getApplicationContext(),MainActivity.class);
                                            startActivity(page);
                                            Toast.makeText(getApplicationContext(),"Login Success",Toast.LENGTH_SHORT).show();
                                            finish();
                                        }else {
                                            Toast.makeText(getApplicationContext(),result,Toast.LENGTH_SHORT).show();
                                        }

                                    } catch(Exception e) {e.printStackTrace();}
                                    // (Throwable t) { Log.e("My App", "Could not parse malformed JSON: \"" + t + "\"");}


                                }
                            }
                            //End Write and Read data with URL
                        }

                    });
                }else {
                    Toast.makeText(getApplicationContext(), "All Filds Required", Toast.LENGTH_SHORT).show();
                }
            }
        });
    }
}