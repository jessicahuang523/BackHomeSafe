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

import com.vishnusivadas.advanced_httpurlconnection.PutData;

public class ShopRegisterActivity extends AppCompatActivity {

    EditText textInputEditTextshop_name,textInputEditTextShop_reg_id,textInputEditTextTelephone;
    EditText textInputEditTextshop_lat,textInputEditTextshop_long;
    Button buttonShop_Reg_Submit;
    ProgressBar shop_reg_progressbar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.shop_register);

        textInputEditTextshop_name = findViewById(R.id.shop_reg_input_name);
        textInputEditTextShop_reg_id = findViewById(R.id.shop_reg_input_rid);
        textInputEditTextTelephone = findViewById(R.id.shop_reg_input_telephone);
        textInputEditTextshop_lat = findViewById(R.id.shop_reg_input_lat);
        textInputEditTextshop_long = findViewById(R.id.shop_reg_input_long);
        buttonShop_Reg_Submit = findViewById(R.id.shop_reg_submit);
        shop_reg_progressbar = findViewById(R.id.shop_reg_progressbar);

        buttonShop_Reg_Submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String shop_name,shop_rid,shop_telephone,shop_lat,shop_long;
                shop_name = String.valueOf(textInputEditTextshop_name.getText());
                shop_rid = String.valueOf(textInputEditTextShop_reg_id.getText());
                shop_telephone = String.valueOf(textInputEditTextTelephone.getText());
                shop_lat = String.valueOf(textInputEditTextTelephone.getText());
                shop_long = String.valueOf(textInputEditTextTelephone.getText());

                if(!shop_name.equals("") && !shop_rid.equals("") && !shop_telephone.equals("")) {
                    shop_reg_progressbar.setVisibility(View.VISIBLE);
                    Handler handler = new Handler(Looper.getMainLooper());
                    handler.post(new Runnable() {

                        @Override
                        public void run() {
                            String[] field = new String[5];
                            field[0] = "shop_name";
                            field[1] = "shop_reg_id";
                            field[2] = "shop_telephone";
                            field[3] = "shop_lat";
                            field[4] = "shop_lng";
                            String[] data = new String[5];
                            data[0] = shop_name;
                            data[1] = shop_rid;
                            data[2] = shop_telephone;
                            data[3] = shop_lat;
                            data[4] = shop_long;

                            PutData shop_reg_input = new PutData("https://backhomesafe.herokuapp.com/shopregister.php", "POST", field, data);
                            if (shop_reg_input.startPut()) {

                                if (shop_reg_input.onComplete()) {
                                    shop_reg_progressbar.setVisibility(View.GONE);
                                    String result = shop_reg_input.getResult();
                                    //if(result.equals("Form Submit Success")){
                                    if(result.contains(".png")){
                                        //Intent page = new Intent(getApplicationContext(),WelcomeActivity.class);
                                        Intent page = new Intent(getApplicationContext(),QRCodeActivity.class);
                                        page.putExtra("qr_code_address",result);
                                        startActivity(page);
                                        Toast.makeText(getApplicationContext(),"Submit Success",Toast.LENGTH_SHORT).show();
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
        });
    }
}