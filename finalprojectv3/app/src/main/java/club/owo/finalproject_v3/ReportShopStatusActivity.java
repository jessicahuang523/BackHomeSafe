package club.owo.finalproject_v3;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.ProgressBar;
import android.widget.Toast;

import com.vishnusivadas.advanced_httpurlconnection.PutData;

public class ReportShopStatusActivity extends AppCompatActivity {

    EditText textInputEditShopID;
    //RadioButton radioButtonSafe, radioButtonUnsafe;
    Button reportStatusBtn;
    ProgressBar status_report_progressbar;
    Boolean isSafe = true;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_report_shop_status);

        textInputEditShopID = findViewById(R.id.shop_id_input_name);
        reportStatusBtn = findViewById(R.id.report_status_submit);
        status_report_progressbar = findViewById(R.id.status_report_progressbar);

        reportStatusBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String shop_id, shop_status;
                shop_id = String.valueOf(textInputEditShopID.getText());
                if (!isSafe) {
                    shop_status = "danger";
                }
                else {
                    shop_status = "safe";
                }

                if(!shop_id.equals("")) {
                    status_report_progressbar.setVisibility(View.VISIBLE);
                    Handler handler = new Handler(Looper.getMainLooper());
                    handler.post(new Runnable() {

                        @Override
                        public void run() {
                            String[] field = new String[2];
                            field[0] = "register_id";
                            field[1] = "shop_status";
                            String[] data = new String[2];
                            data[0] = shop_id;
                            data[1] = shop_status;

                            PutData shop_status_input = new PutData("https://backhomesafe.herokuapp.com/reportdanger.php", "POST", field, data);
                            if (shop_status_input.startPut()) {

                                if (shop_status_input.onComplete()) {
                                    status_report_progressbar.setVisibility(View.GONE);
                                    String result = shop_status_input.getResult();
                                    if(result.equals("Successfully reported!")){
                                        Intent page = new Intent(getApplicationContext(),WelcomeActivity.class);
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
                    Toast.makeText(getApplicationContext(), "Please input shop ID", Toast.LENGTH_SHORT).show();
                }
            }
        });

    }

    public void onRadioButtonClicked(View view) {
        // Is the button now checked?
        boolean checked = ((RadioButton) view).isChecked();

        // Check which radio button was clicked
        switch(view.getId()) {
            case R.id.radio_safe:
                if (checked){
                    isSafe = true;
                    break;
                }
            case R.id.radio_unsafe:
                if (checked) {
                    isSafe = false;
                    break;
                }
        }
    }

}