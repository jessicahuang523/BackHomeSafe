package club.wen0750.finalproject_v3.ui.history;

import android.content.Context;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.cardview.widget.CardView;
import androidx.recyclerview.widget.RecyclerView;

import java.util.ArrayList;

import club.wen0750.finalproject_v3.R;

class HistoryAdapter extends RecyclerView.Adapter<HistoryAdapter.myViewHolder> {

    private OnItemClickListener onItemClickListener;
    private Context context;
    private ArrayList<HistoryEntity> historyEntities;

    public HistoryAdapter(Context context,ArrayList<HistoryEntity> historyEntities){
        this.context = context;
        this.historyEntities = historyEntities;
    }

    @NonNull
    @Override
    public HistoryAdapter.myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View itemView = View.inflate(context, R.layout.fragment_history_row_iteam,null);
        return new myViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull HistoryAdapter.myViewHolder holder, int position) {
        HistoryEntity data = historyEntities.get(position);
        //holder.mItemId.setText(data.history_id);
        holder.mItemShopName.setText(data.history_shop_name);
        holder.mItemShopAddress.setText(data.history_shop_address);
        holder.mItemCheckIn.setText(data.history_check_in);
        holder.mItemCheckOut.setText(data.history_check_out);
        if (data.history_health.equals("1")){
            holder.mItemHealth.setCardBackgroundColor(context.getResources().getColor(R.color.health_dg));
        }else{
            holder.mItemHealth.setCardBackgroundColor(context.getResources().getColor(R.color.health_save));
        }
    }

    @Override
    public int getItemCount() {
        return historyEntities.size();
    }

    class myViewHolder extends RecyclerView.ViewHolder {

        //private TextView mItemId;
        private TextView mItemShopName;
        private TextView mItemShopAddress;
        private TextView mItemCheckIn;
        private TextView mItemCheckOut;
        private CardView mItemHealth;

        public myViewHolder(@NonNull View itemView) {
            super(itemView);
            //mItemId = itemView.findViewById(R.id.history_list_id);
            mItemShopName = itemView.findViewById(R.id.history_list_shop_name);
            mItemShopAddress = itemView.findViewById(R.id.history_list_shop_address_data);
            mItemCheckIn = itemView.findViewById(R.id.history_list_check_in_data);
            mItemCheckOut = itemView.findViewById(R.id.history_list_check_out_data);
            mItemHealth = itemView.findViewById(R.id.history_body);

            itemView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {

                    if (onItemClickListener!=null){

                        onItemClickListener.OnItemClick(v,historyEntities.get(getLayoutPosition()));
                    }
                }
            });

        }
    }

    public interface OnItemClickListener {
        public void OnItemClick(View view, HistoryEntity data);
    }

    public void setOnItemClickListener(OnItemClickListener onItemClickListener) {
        this.onItemClickListener = onItemClickListener;
    }
}