package club.wen0750.finalproject_v3.ui.announcement;

import android.content.Context;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.squareup.picasso.Picasso;

import java.util.ArrayList;

import club.wen0750.finalproject_v3.R;

class AnnounceAdapter extends RecyclerView.Adapter<AnnounceAdapter.mViewHolder>{

    private OnItemClickListener onItemClickListener;
    private Context context;
    private ArrayList<AnnounceEntity> announceEntities;

    public AnnounceAdapter(Context context, ArrayList<AnnounceEntity> announceEntities){
        this.context = context;
        this.announceEntities = announceEntities;
    }

    @NonNull
    @Override
    public AnnounceAdapter.mViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType){
        View itemView = View.inflate(context, R.layout.fragment_announce_row,null);
        return new mViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull AnnounceAdapter.mViewHolder mholder, int position) {
        AnnounceEntity data = announceEntities.get(position);
        //mholder.mItemPostId.setText(data.announce_id);
        mholder.mItemPostDp.setText(data.announce_post_dp);
        //mholder.mItemPostDpIcon.setImageResource(R.drawable.ic_code_scanner_auto_focus_off);
        Picasso.get().load(data.announce_post_dp_icon).into(mholder.mItemPostDpIcon);
        mholder.mItemPostTime.setText(data.announce_post_time);
        //mholder.mItemPostImg.setImageResource(R.drawable.ic_code_scanner_auto_focus_off);
        Picasso.get().load(data.announce_image_address).into(mholder.mItemPostImg);
        mholder.mItemPostTitle.setText(data.announce_title);
    }

    @Override
    public int getItemCount() { return announceEntities.size();    }

    class mViewHolder extends RecyclerView.ViewHolder{

        //private TextView mItemPostId;
        private TextView mItemPostDp;
        private ImageView mItemPostDpIcon;
        private TextView mItemPostTime;
        private ImageView mItemPostImg;
        private TextView mItemPostTitle;

        public mViewHolder(@NonNull View itemView){
            super(itemView);
            //mItemPostId = itemView.findViewById(R.id.Announce_id);
            mItemPostDp = itemView.findViewById(R.id.Announce_Dp);
            mItemPostDpIcon = itemView.findViewById(R.id.Announce_Dp_icon);
            mItemPostTime = itemView.findViewById(R.id.Announce_time);
            mItemPostImg = itemView.findViewById(R.id.Announce_img);
            mItemPostTitle = itemView.findViewById(R.id.Announce_Title);

            itemView.setOnClickListener(new View.OnClickListener(){
                @Override
                public void onClick(View v){
                    if (onItemClickListener != null){
                        onItemClickListener.OnItemClick(v,announceEntities.get(getLayoutPosition()));
                    }
                }
            });
        }
    }

    public interface OnItemClickListener{
        public void OnItemClick(View view, AnnounceEntity data);
    }

    public void setOnItemClickListener(OnItemClickListener onItemClickListener) {
        this.onItemClickListener = onItemClickListener;
    }
}
