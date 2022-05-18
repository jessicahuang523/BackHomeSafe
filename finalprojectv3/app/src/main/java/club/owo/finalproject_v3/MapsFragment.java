package club.owo.finalproject_v3;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.fragment.app.Fragment;

import android.Manifest;
import android.app.Activity;
import android.content.Context;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.location.Address;
import android.location.Geocoder;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.LatLngBounds;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;
import com.vishnusivadas.advanced_httpurlconnection.PutData;

import org.json.JSONArray;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.Locale;
import java.util.Stack;


public class MapsFragment extends Fragment implements LocationListener {

    private GoogleMap mMap;

    private List<String[]> mShopData = new ArrayList<String[]>();
    private List<Marker> mMapMarkers = new ArrayList<Marker>();
    private double[] mSWBounds = {0,0};
    private double[] mNEBounds = {0,0};
    private LatLngBounds mMapBounds;
    private Stack<Marker> mMarkerStack = new Stack<Marker>();
    private LocationManager mLocationManager;
    private void enableMyLocation() {
        if (ContextCompat.checkSelfPermission(this.getContext(),
                Manifest.permission.ACCESS_FINE_LOCATION)
                == PackageManager.PERMISSION_GRANTED) {
            mMap.setMyLocationEnabled(true);
        } else {
            ActivityCompat.requestPermissions(this.getActivity(), new String[]
                            {Manifest.permission.ACCESS_FINE_LOCATION},
                    1);
        }
    }
    @Override
    public void onRequestPermissionsResult(int requestCode,
                                           @NonNull String[] permissions,
                                           @NonNull int[] grantResults) {
        // Check if location permissions are granted and if so enable the
        // location data layer.
        switch (requestCode) {
            case 1:
                if (grantResults.length > 0
                        && grantResults[0]
                        == PackageManager.PERMISSION_GRANTED) {
                    enableMyLocation();
                    break;
                }
        }}
    private OnMapReadyCallback callback = new OnMapReadyCallback() {

        /**
         * Manipulates the map once available.
         * This callback is triggered when the map is ready to be used.
         * This is where we can add markers or lines, add listeners or move the camera.
         * In this case, we just add a marker near Sydney, Australia.
         * If Google Play services is not installed on the device, the user will be prompted to
         * install it inside the SupportMapFragment. This method will only be triggered once the
         * user has installed Google Play services and returned to the app.
         */
        @Override
        public void onMapReady(GoogleMap googleMap) {
            mMap = googleMap;
//            LatLng cuhk_shb = new LatLng(22.418014,	114.207259);
//            mMap.moveCamera(CameraUpdateFactory.newLatLng(cuhk_shb));
            initMapData();
            enableMyLocation();
        }
    };

    public void goToMarkerClicked(Marker marker) {
        mMap.animateCamera(CameraUpdateFactory.newLatLngZoom(marker.getPosition(), 18));
        marker.showInfoWindow();
    }

    public void resetMap(){
        //mMap.animateCamera(CameraUpdateFactory.newLatLngBounds(mMapBounds, 0));
        //mMap.animateCamera(CameraUpdateFactory.zoomTo(16));
        mMap.animateCamera(CameraUpdateFactory.newLatLngZoom(mMapBounds.getCenter(), 16));

        for (Marker m : mMapMarkers){
            m.hideInfoWindow();
        }

        mMarkerStack.clear();
    }

    public void initMapData(){
        SharedPreferences preferences = getActivity().getSharedPreferences("temp_user_data", Activity.MODE_PRIVATE);  //Frequent to get SharedPreferences need to add a step getActivity () method
        String uid = preferences.getString("temp_id", "");
        String ukey = preferences.getString("temp_key", "");

        Handler handler = new Handler(Looper.getMainLooper());
        handler.post(new Runnable() {

            @Override
            public void run() {
                //Starting Write and Read data with URL
                //Creating array for parameters
                String[] field = new String[3];
                field[0] = "uuid";
                field[1] = "pass_key";
                field[2] = "at_type";
                //Creating array for data
                String[] data = new String[3];
                data[0] = uid;
                data[1] = ukey;
                data[2] = "get_history";

                PutData putData = new PutData("https://backhomesafe.herokuapp.com/acsm.php", "POST", field, data);
                if (putData.startPut()) {
                    if (putData.onComplete()) {
                        String dresult = putData.getResult();

                        SharedPreferences temp_user_data = getActivity().getSharedPreferences("temp_history_data", Activity.MODE_PRIVATE);
                        SharedPreferences.Editor editor = temp_user_data.edit();
                        editor.putString("history", dresult);
                        editor.apply();
                        try {
                            SharedPreferences get_history_data = getActivity().getSharedPreferences("temp_history_data", Activity.MODE_PRIVATE);  //Frequent to get SharedPreferences need to add a step getActivity () method
                            String history_data = get_history_data.getString("history", "");

                            //JSONObject response = new JSONObject(dresult);
                            JSONObject response = new JSONObject(history_data);
                            JSONArray history = response.getJSONArray("history");
                            boolean firstWrite = true;

                            //JSONArray history = new JSONArray(history_data);

                            for (int i=0;i<history.length();i++){
                                JSONObject index = history.getJSONObject(i);
                                String id = index.getString("id");
                                String shop_name = index.getString("company_name");
                                String shop_lat = index.getString("lat");
                                String shop_long = index.getString("lng");
                                String str_check_in = index.getString("check_in");
                                String str_check_out = index.getString("check_out");
                                String health = index.getString("health");
                                String contain = index.getString("contain");

                                if (str_check_out.length() < 5){
                                    str_check_out = "2000-01-01 00:00:00";
                                }

                                SimpleDateFormat format = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
                                Date new_check_in = format.parse(str_check_in);
                                Date new_check_out = format.parse(str_check_out);
                                format = new SimpleDateFormat("MM/dd HH:mm");
                                String check_in = format.format(new_check_in);
                                String check_out = format.format(new_check_out);

                                String[] shopData = {shop_name, health, shop_lat, shop_long};
                                mShopData.add(shopData);
                                if (firstWrite) {
                                    mSWBounds[0] = Double.parseDouble(shopData[2]);
                                    mSWBounds[1] = Double.parseDouble(shopData[3]);
                                    mNEBounds[0] = Double.parseDouble(shopData[2]);
                                    mNEBounds[1] = Double.parseDouble(shopData[3]);
                                    firstWrite = false;
                                }
                                if(mSWBounds[0] > Double.parseDouble(shopData[2])){
                                    mSWBounds[0] = Double.parseDouble(shopData[2]);
                                }
                                if(mSWBounds[1] > Double.parseDouble(shopData[3])){
                                    mSWBounds[1] = Double.parseDouble(shopData[3]);
                                }
                                if(mNEBounds[0] < Double.parseDouble(shopData[2])){
                                    mNEBounds[0] = Double.parseDouble(shopData[2]);
                                }
                                if(mNEBounds[1] < Double.parseDouble(shopData[3])){
                                    mNEBounds[1] = Double.parseDouble(shopData[3]);
                                }
                            }
                            if (mShopData != null && !mShopData.isEmpty()) {
                                LatLngBounds mapBounds = new LatLngBounds(
                                        new LatLng(mSWBounds[0], mSWBounds[1]), // SW bounds
                                        new LatLng(mNEBounds[0], mNEBounds[1])  // NE bounds
                                );
                                mMapBounds = mapBounds;
                                mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(mapBounds.getCenter(), 15));

                                int tagNumber = 0;
                                for (String[] f : mShopData) {
                                    LatLng fLocation = new LatLng(Double.parseDouble(f[2]), Double.parseDouble(f[3]));
                                    if (f[1].equals("1") ) {
                                        Marker fMarker = mMap.addMarker(new MarkerOptions()
                                                .position(fLocation)
                                                .icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_RED))
                                                .title(f[0] + " (Unsafe)"));
                                        fMarker.setTag(Integer.toString(tagNumber));
                                        mMapMarkers.add(fMarker);
                                    } else {
                                        Marker fMarker = mMap.addMarker(new MarkerOptions()
                                                .position(fLocation)
                                                .icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_GREEN))
                                                .title(f[0]));
                                        fMarker.setTag(Integer.toString(tagNumber));
                                        mMapMarkers.add(fMarker);
                                    }
                                    tagNumber++;
                                }

                                mMap.setOnMarkerClickListener(new GoogleMap.OnMarkerClickListener() {
                                    @Override
                                    public boolean onMarkerClick(Marker marker) {
                                        mMarkerStack.push(marker);
                                        String markerTag = (String) marker.getTag();

                                        goToMarkerClicked(marker);
                                        return true;
                                    }
                                });

                                mMap.setOnMapClickListener(new GoogleMap.OnMapClickListener() {
                                    @Override
                                    public void onMapClick(LatLng point) {
                                        resetMap();
                                    }
                                });
                            }
                        }
                        catch(Exception e) {e.printStackTrace();}
                    }
                }
            }
        });
    }

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater,
                             @Nullable ViewGroup container,
                             @Nullable Bundle savedInstanceState) {
        try{        mLocationManager=(LocationManager) this.getActivity().getSystemService(Context.LOCATION_SERVICE);
            mLocationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER,5000,5,this);}
        catch (Exception e){e.printStackTrace();}

        return inflater.inflate(R.layout.fragment_maps, container, false);
    }

    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);
        SupportMapFragment mapFragment =
                (SupportMapFragment) getChildFragmentManager().findFragmentById(R.id.map);
        if (mapFragment != null) {
            mapFragment.getMapAsync(callback);
        }
    }

    @Override
    public void onLocationChanged(@NonNull Location location) {

        try{
//            Geocoder geocoder = new Geocoder(getActivity(), Locale.getDefault());
//            List<Address> addresses = geocoder.getFromLocation(location.getLatitude(),location.getLongitude(),1);
//            String address=addresses.get(0).getAddressLine(0);
//            Toast.makeText(this.getActivity(), address, Toast.LENGTH_SHORT).show();
            //thresold暫定為0.00047
            boolean isSafe=true;
            for (String[] f : mShopData){
                if(Math.abs(location.getLatitude()-Double.parseDouble(f[2]))+Math.abs(location.getLongitude()-Double.parseDouble(f[3]))<0.00047){
                    isSafe=false;
                }
            }
           if(isSafe==false){ Toast.makeText(this.getActivity(), "you are near to an unsafe shop!", Toast.LENGTH_SHORT).show();}
           else Toast.makeText(this.getActivity(), "you are safe", Toast.LENGTH_SHORT).show();
        }catch (Exception e){
            e.printStackTrace();
        }
    }
}