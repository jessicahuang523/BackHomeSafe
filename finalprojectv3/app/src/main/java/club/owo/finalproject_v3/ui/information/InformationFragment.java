package club.owo.finalproject_v3.ui.information;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.lifecycle.ViewModelProvider;

import club.owo.finalproject_v3.R;
import club.owo.finalproject_v3.ScannerActivity;

public class InformationFragment extends Fragment {

    private InformationViewModel informationViewModel;

    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        informationViewModel = new ViewModelProvider(this).get(InformationViewModel.class);
        View root = inflater.inflate(R.layout.fragment_information, container, false);

        ImageButton btn_open_scnner = (ImageButton)root.findViewById(R.id.info_btn_1);
//        ImageButton button_a = (ImageButton)root.findViewById(R.id.info_btn_2);
//        ImageButton button_b = (ImageButton)root.findViewById(R.id.info_btn_3);
//        ImageButton button_c = (ImageButton)root.findViewById(R.id.info_btn_4);

        btn_open_scnner.setOnClickListener(this::onClick);
//        button_a.setOnClickListener(this::onClick);
//        button_b.setOnClickListener(this::onClick);
//        button_c.setOnClickListener(this::onClick);

        return root;
    }

    public void onClick(View root) {
        switch (root.getId()) {
            case R.id.info_btn_1:

                Intent page = new Intent(getActivity(), ScannerActivity.class);
                startActivity(page);

                break;
//            case R.id.info_btn_2:
//
//                break;
//            case R.id.info_btn_3:
//
//                break;
//            case R.id.info_btn_4:
//
//                break;
        }
    }
}