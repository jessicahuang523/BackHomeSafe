package club.wen0750.finalproject_v3.ui.history;

import java.io.Serializable;

class HistoryEntity implements Serializable {
    public String history_id;
    public String history_shop_name; //shop name
    public String history_shop_address; //shop address
    public String history_check_in; //time user check in
    public String history_check_out; //time user check out
    public String history_health; //time health status

    public HistoryEntity(){

    }

    public HistoryEntity(String history_id,String history_shop_name, String history_shop_address, String history_check_in, String history_check_out, String history_health){
        this.history_id = history_id;
        this.history_shop_name = history_shop_name;
        this.history_shop_address = history_shop_address;
        this.history_check_in = history_check_in;
        this.history_check_out = history_check_out;
        this.history_health = history_health;
    }

    public String getHistory_id(){ return history_id;}
    public void setHistory_id(String history_id){this.history_id = history_id;}

    public String getHistory_shop_name(){ return history_shop_name;}
    public void setHistory_shop_name(String history_shop_name){this.history_shop_name = history_shop_name;}

    public String getHistory_shop_address(){ return history_shop_address;}
    public void setHistory_shop_address(String history_shop_address){this.history_shop_address = history_shop_address;}

    public String getHistory_check_in(){ return history_check_in;}
    public void setHistory_check_in(String history_check_in){this.history_check_in = history_check_in;}

    public String getHistory_check_out(){ return history_check_out;}
    public void setHistory_check_out(String history_check_out){this.history_check_out = history_check_out;}

    public String getHistory_health(){ return history_health;}
    public void setHistory_health(String history_health){this.history_health = history_health;}

    @Override
    public String toString() {
        return "HistoryEntity{" +
                "history_id='" + history_id + '\'' +
                ", history_shop_name='" + history_shop_name + '\'' +
                ", history_shop_address='" + history_shop_address + '\'' +
                ", history_check_in='" + history_check_in + '\'' +
                ", history_check_out='" + history_check_out + '\'' +
                ", history_health='" + history_health + '\'' +
                '}';
    }

}