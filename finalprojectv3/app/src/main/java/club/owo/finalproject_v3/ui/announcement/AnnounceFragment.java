package club.owo.finalproject_v3.ui.announcement;

import android.app.Activity;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.DividerItemDecoration;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.vishnusivadas.advanced_httpurlconnection.PutData;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;

import club.owo.finalproject_v3.R;

public class AnnounceFragment extends Fragment {

    private View view;
    private ArrayList<AnnounceEntity> announceEntities = new ArrayList<AnnounceEntity>();
    private RecyclerView AnnounceRV;
    private AnnounceAdapter adapter;
    private TextView textView;
    private ProgressBar gethistory_progressbar;

    public AnnounceFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        view = inflater.inflate(R.layout.fragment_announce, container, false);

        initRecyclerView();
        initData();

        return view;
    }

    private void initRecyclerView() {
        AnnounceRV = (RecyclerView)view.findViewById(R.id.recyclerView2);
        adapter = new AnnounceAdapter(getActivity(),announceEntities);
        AnnounceRV.setAdapter(adapter);
        AnnounceRV.setLayoutManager(new LinearLayoutManager(getActivity(), LinearLayoutManager.VERTICAL,false));

        AnnounceRV.addItemDecoration(new DividerItemDecoration(getActivity(),DividerItemDecoration.VERTICAL));

        adapter.setOnItemClickListener(new AnnounceAdapter.OnItemClickListener() {
            @Override
            public void OnItemClick(View view, AnnounceEntity data) {
                Toast.makeText(getActivity(),"", Toast.LENGTH_SHORT).show();
            }
        });
    }

    private void initData(){
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
                data[2] = "get_announce";

                PutData putData = new PutData("https://backhomesafe.herokuapp.com/acsm.php", "POST", field, data);
                if (putData.startPut()) {
                    if (putData.onComplete()) {
                        String dresult = putData.getResult();

                        SharedPreferences temp_user_data = getActivity().getSharedPreferences("temp_announce_data", Activity.MODE_PRIVATE);
                        SharedPreferences.Editor editor = temp_user_data.edit();
                        editor.putString("announce", dresult);
                        editor.apply();
                    }
                }
            }
        });
        try {
            SharedPreferences get_history_data = getActivity().getSharedPreferences("temp_announce_data", Activity.MODE_PRIVATE);  //Frequent to get SharedPreferences need to add a step getActivity () method
            String history_data = get_history_data.getString("announce", "");

            JSONObject response = new JSONObject(history_data);
            JSONArray history = response.getJSONArray("announce");

            //JSONArray history = new JSONArray(history_data);

            for (int i=0;i<history.length();i++){
                JSONObject index = history.getJSONObject(i);
                //String post_id = index.getString("post_id");
                String post_dp = "CHP";
                String post_ic = index.getString("depart_icon");
                String post_tm = index.getString("post_time");
                String post_im = index.getString("post_image");
                String post_tt = index.getString("post_title");

                AnnounceEntity announceEntity = new AnnounceEntity();
                //announceEntity.setAnnounce_id(post_id);
                announceEntity.setAnnounce_post_dp(post_dp);
                announceEntity.setAnnounce_post_dp_icon(post_ic);
                announceEntity.setAnnounce_post_time(post_tm);
                announceEntity.setAnnounce_image_address(post_im);
                announceEntity.setAnnounce_title(post_tt);

                announceEntities.add(announceEntity);
            }
        } catch(Exception e) {e.printStackTrace();}

    }
}
