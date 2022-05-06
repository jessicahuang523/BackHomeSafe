package club.owo.finalproject_v3;

import android.content.Intent;
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

import com.google.android.material.textfield.TextInputEditText;
import com.vishnusivadas.advanced_httpurlconnection.PutData;

public class SignUpActivity extends AppCompatActivity {

    TextInputEditText textInputEditTextIdcid;
    EditText textInputEditTextEmail,textInputEditTextPw,textInputEditTextCfpw,textInputEditTextFullname,textInputEditTextTelephone,textInputEditTextAddress;
    Button buttonRegisterSubmit;
    ProgressBar user_reg_progressbar;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.signup);
    }

    public void reg_submit(View view){

        textInputEditTextEmail = findViewById(R.id.user_reg_input_email);
        textInputEditTextPw = findViewById(R.id.user_reg_input_pw);
        textInputEditTextCfpw = findViewById(R.id.user_reg_input_cfpw);
        textInputEditTextFullname = findViewById(R.id.user_reg_input_name);
        textInputEditTextTelephone = findViewById(R.id.user_reg_input_phone);
        textInputEditTextAddress = findViewById(R.id.user_reg_input_address);
        textInputEditTextIdcid = findViewById(R.id.user_reg_input_idcid);
        buttonRegisterSubmit = findViewById(R.id.user_register_confirm);
        user_reg_progressbar = findViewById(R.id.user_reg_progressbar);

        String email,password,cf_password,fullname,telephone,address,idcid;
        email = String.valueOf(textInputEditTextEmail.getText());
        password = String.valueOf(textInputEditTextPw.getText());
        cf_password = String.valueOf(textInputEditTextCfpw.getText());
        fullname = String.valueOf(textInputEditTextFullname.getText());
        telephone = String.valueOf(textInputEditTextTelephone.getText());
        address = String.valueOf(textInputEditTextAddress.getText());
        idcid = String.valueOf(textInputEditTextIdcid.getText());

        if(!email.equals("") && !password.equals("") && !fullname.equals("") && !telephone.equals("") && !address.equals("") && !idcid.equals("")) {

            user_reg_progressbar.setVisibility(View.VISIBLE);
            //Start ProgressBar first (Set visibility VISIBLE)
            Handler handler = new Handler(Looper.getMainLooper());
            handler.post(new Runnable() {

                @Override
                public void run() {
                    //Starting Write and Read data with URL
                    //Creating array for parameters
                    String[] field = new String[6];
                    field[0] = "email";
                    field[1] = "password";
                    field[2] = "fullname";
                    field[3] = "telephone";
                    field[4] = "address";
                    field[5] = "idcid";
                    //Creating array for data
                    String[] data = new String[6];
                    data[0] = email;
                    data[1] = password;
                    data[2] = fullname;
                    data[3] = telephone;
                    data[4] = address;
                    data[5] = idcid;

                    PutData putData = new PutData("https://backhomesafe.herokuapp.com/signup.php", "POST", field, data);
                    if (putData.startPut()) {
                        if (putData.onComplete()) {
                            user_reg_progressbar.setVisibility(View.GONE);
                            String result = putData.getResult();
                            if(result.equals("Sign Up Success")){
                                Intent page = new Intent(getApplicationContext(), club.owo.finalproject_v3.SignInActivity.class);
                                startActivity(page);
                                Toast.makeText(getApplicationContext(),"Account Created",Toast.LENGTH_SHORT).show();
                                finish();
                            }else {
                                Toast.makeText(getApplicationContext(),result,Toast.LENGTH_SHORT).show();
                            }
                            Log.i("PutData", result);
                        }
                    }
                    //End Write and Read data with URL
                }
            });
        }else {
            Toast.makeText(getApplicationContext(), "All Filds Required", Toast.LENGTH_SHORT).show();
        }

    }
}