package club.owo.finalproject_v3;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.Manifest;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.budiyev.android.codescanner.CodeScanner;
import com.budiyev.android.codescanner.CodeScannerView;
import com.budiyev.android.codescanner.DecodeCallback;
import com.google.zxing.Result;
import com.karumi.dexter.Dexter;
import com.karumi.dexter.PermissionToken;
import com.karumi.dexter.listener.PermissionDeniedResponse;
import com.karumi.dexter.listener.PermissionGrantedResponse;
import com.karumi.dexter.listener.PermissionRequest;
import com.karumi.dexter.listener.single.PermissionListener;
import com.vishnusivadas.advanced_httpurlconnection.PutData;

import org.json.JSONArray;

import java.time.LocalDateTime;
import java.time.ZoneId;
import java.time.format.DateTimeFormatter;

public class ScannerActivity extends AppCompatActivity {

    private CodeScanner mCodeScanner;
    CodeScannerView scanView;
    TextView resultData;
    Button check_out_btn;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.scanner);

        scanView = findViewById(R.id.scanner_view);
        mCodeScanner = new CodeScanner(this,scanView);
        resultData = findViewById(R.id.tv_textView);
        check_out_btn = findViewById(R.id.scanner_check_out_btn);

        mCodeScanner.setDecodeCallback(new DecodeCallback() {
            @Override
            public void onDecoded(@NonNull final Result result) {

                String uid = getSharedPreferences("temp_user_data", MODE_PRIVATE).getString("temp_id", "");
                String ukey = getSharedPreferences("temp_user_data", MODE_PRIVATE).getString("temp_key", "");
                String sresult = result.getText();

                Handler handler = new Handler(Looper.getMainLooper());
                handler.post(new Runnable() {

                    @Override
                    public void run() {

                        //Starting Write and Read data with URL
                        //Creating array for parameters
                        String[] field = new String[4];
                        field[0] = "uuid";
                        field[1] = "pass_key";
                        field[2] = "at_type";
                        field[3] = "qrid";
                        //Creating array for data
                        String[] data = new String[4];
                        data[0] = uid;
                        data[1] = ukey;
                        data[2] = "qr_processing";
                        data[3] = sresult;

                        PutData putData = new PutData("https://backhomesafe.herokuapp.com/acsm.php", "POST", field, data);
                        if (putData.startPut()) {
                            if (putData.onComplete()) {
                                String dresult = putData.getResult();
                                //resultData.setText(dresult);

                                try {
                                    JSONArray response = new JSONArray(dresult);
                                    String shop_id = response.getString(0);
                                    String shop_name = response.getString(1);

                                    resultData.setText(shop_name);

                                    if (! shop_name.isEmpty() && !shop_name.equals("")){
                                        check_out_btn.setVisibility(View.VISIBLE);
                                    }

                                    SharedPreferences myPrefs;

                                    myPrefs = getSharedPreferences("temp_scanner_data", Context.MODE_PRIVATE);
                                    SharedPreferences.Editor editor = myPrefs.edit();
                                    editor.putString("shop_id", shop_id);
                                    editor.apply();

                                } catch(Exception e) {e.printStackTrace();}
                            }
                        }
                        //End Write and Read data with URL
                    }
                });
            }
        });

        scanView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mCodeScanner.startPreview();
            }
        });

        check_out_btn.setOnClickListener(new Button.OnClickListener() {
            @Override
            public void onClick(View v) {

                String uid = getSharedPreferences("temp_user_data", MODE_PRIVATE).getString("temp_id", "");
                String ukey = getSharedPreferences("temp_user_data", MODE_PRIVATE).getString("temp_key", "");
                String shop_id = getSharedPreferences("temp_scanner_data", MODE_PRIVATE).getString("shop_id", "");

                LocalDateTime instance = LocalDateTime.now( ZoneId.of("Asia/Hong_Kong") );
                DateTimeFormatter formatter = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss");

                System.out.println(formatter.format(instance));

                String time = formatter.format(instance);

                Handler handler = new Handler(Looper.getMainLooper());
                handler.post(new Runnable() {

                    @Override
                    public void run() {

                        //Starting Write and Read data with URL
                        //Creating array for parameters
                        String[] field = new String[5];
                        field[0] = "uuid";
                        field[1] = "pass_key";
                        field[2] = "shop_id";
                        field[3] = "data_time_checkout";
                        field[4] = "at_type";

                        //Creating array for data
                        String[] data = new String[5];
                        data[0] = uid;
                        data[1] = ukey;
                        data[2] = shop_id;
                        data[3] = time;
                        data[4] = "user_check_out";

                        PutData putData = new PutData("https://backhomesafe.herokuapp.com/acsm.php", "POST", field, data);
                        if (putData.startPut()) {
                            if (putData.onComplete()) {
                                String result = putData.getResult();

                                if(result.equals("Action Update Success")){
                                    Intent page = new Intent(getApplicationContext(),MainActivity.class);
                                    startActivity(page);
                                    Toast.makeText(getApplicationContext(),"Action Success",Toast.LENGTH_SHORT).show();
                                    finish();
                                }else {
                                    Toast.makeText(getApplicationContext(),result,Toast.LENGTH_SHORT).show();
                                }
                            }
                        }
                        //End Write and Read data with URL
                    }
                });


            }
        });
    }

    @Override
    protected void onResume() {
        super.onResume();
        requrestForCamera();
    }

    public void requrestForCamera() {
        Dexter.withContext(this).withPermission(Manifest.permission.CAMERA).withListener(new PermissionListener() {
            @Override
            public void onPermissionGranted(PermissionGrantedResponse permissionGrantedResponse) {
                mCodeScanner.startPreview();
            }

            @Override
            public void onPermissionDenied(PermissionDeniedResponse permissionDeniedResponse) {
                Toast.makeText(getApplicationContext(),"Camera Permission is Required",Toast.LENGTH_LONG).show();
            }

            @Override
            public void onPermissionRationaleShouldBeShown(PermissionRequest permissionRequest, PermissionToken permissionToken) {
                permissionToken.continuePermissionRequest();
            }
        }).check();
    }


    @Override
    protected void onPause() {
        mCodeScanner.releaseResources();
        super.onPause();
    }
}