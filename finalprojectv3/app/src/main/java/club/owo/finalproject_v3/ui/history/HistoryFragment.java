package club.owo.finalproject_v3.ui.history;

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

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

import club.owo.finalproject_v3.R;

public class HistoryFragment extends Fragment {

    private View view;
    private ArrayList<HistoryEntity> historyEntities = new ArrayList<HistoryEntity>();
    private RecyclerView HistoryRV;
    private HistoryAdapter adapter;
    private TextView textView;
    private ProgressBar gethistory_progressbar;

    public HistoryFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        view = inflater.inflate(R.layout.fragment_history, container, false);

        initRecyclerView();
        initData();

        return view;
    }

    private void initRecyclerView() {
        HistoryRV = (RecyclerView)view.findViewById(R.id.recyclerView);
        adapter = new HistoryAdapter(getActivity(),historyEntities);
        HistoryRV.setAdapter(adapter);
        HistoryRV.setLayoutManager(new LinearLayoutManager(getActivity(), LinearLayoutManager.VERTICAL,false));

        HistoryRV.addItemDecoration(new DividerItemDecoration(getActivity(),DividerItemDecoration.VERTICAL));

        adapter.setOnItemClickListener(new HistoryAdapter.OnItemClickListener() {
            @Override
            public void OnItemClick(View view, HistoryEntity data) {
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
                data[2] = "get_history";

                PutData putData = new PutData("https://backhomesafe.herokuapp.com/acsm.php", "POST", field, data);
                if (putData.startPut()) {
                    if (putData.onComplete()) {
                        String dresult = putData.getResult();

                        SharedPreferences temp_user_data = getActivity().getSharedPreferences("temp_history_data", Activity.MODE_PRIVATE);
                        SharedPreferences.Editor editor = temp_user_data.edit();
                        editor.putString("history", dresult);
                        editor.apply();
                    }
                }
            }
        });
        try {
            SharedPreferences get_history_data = getActivity().getSharedPreferences("temp_history_data", Activity.MODE_PRIVATE);  //Frequent to get SharedPreferences need to add a step getActivity () method
            String history_data = get_history_data.getString("history", "");

            JSONObject response = new JSONObject(history_data);
            JSONArray history = response.getJSONArray("history");

            //JSONArray history = new JSONArray(history_data);

            for (int i=0;i<history.length();i++){
                JSONObject index = history.getJSONObject(i);
                String id = index.getString("id");
                String shop_name = index.getString("company_name");
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
                String check_in = "Enter:" + format.format(new_check_in);
                String check_out = format.format(new_check_out);

                HistoryEntity historyEntity = new HistoryEntity();
                //historyEntity.setHistory_id(id);
                historyEntity.setHistory_shop_name(shop_name);
                if (contain != null && contain != "null") {
                    historyEntity.setHistory_shop_address("Customer Number: " + contain);                    
                }
                else {
                    historyEntity.setHistory_shop_address("Customer Number: 0");
                }
                //historyEntity.setHistory_shop_address("Null");
                historyEntity.setHistory_check_in(check_in);
                if (check_out.equals("01/01 00:00")){
                    check_out = "Exit:empty";
                }else {
                    check_out = "Exit:" + check_out;
                }
                historyEntity.setHistory_check_out(check_out);
                historyEntity.setHistory_health(health);

                historyEntities.add(historyEntity);
            }
        } catch(Exception e) {e.printStackTrace();}

    }
}