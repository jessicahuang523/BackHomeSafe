package club.owo.finalproject_v3;

import android.Manifest;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.karumi.dexter.Dexter;
import com.karumi.dexter.PermissionToken;
import com.karumi.dexter.listener.PermissionDeniedResponse;
import com.karumi.dexter.listener.PermissionGrantedResponse;
import com.karumi.dexter.listener.PermissionRequest;
import com.karumi.dexter.listener.single.PermissionListener;

public class WelcomeActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.welcome);
    }

    public void welcome_button(View view) {
        if (view.getId() == R.id.welcome_button_login) {
            Intent page = new Intent(this, club.owo.finalproject_v3.SignInActivity.class);
            startActivity(page);
        } else if (view.getId() == R.id.welcome_button_user_reg) {
            Intent page = new Intent(this, club.owo.finalproject_v3.SignUpActivity.class);
            startActivity(page);
        } else if (view.getId() == R.id.welcome_button_shop_reg) {
            Intent page = new Intent(this, club.owo.finalproject_v3.ShopRegisterActivity.class);
            startActivity(page);
        } else if (view.getId() == R.id.welcome_button_report_unsafe) {
            Intent page = new Intent(this, club.owo.finalproject_v3.ReportUnsafeActivity.class);
            startActivity(page);
        } else if (view.getId() == R.id.welcome_button_report_safe) {
            Intent page = new Intent(this, club.owo.finalproject_v3.ReportSafeActivity.class);
            startActivity(page);
        }
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
        super.onPause();
    }
}