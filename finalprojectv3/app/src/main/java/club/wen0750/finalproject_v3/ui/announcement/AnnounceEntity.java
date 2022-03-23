package club.wen0750.finalproject_v3.ui.announcement;

import java.io.Serializable;

class AnnounceEntity implements Serializable{
    public String announce_id;
    public String announce_post_dp;
    public String announce_post_dp_icon;
    public String announce_post_time;
    public String announce_image_address;
    public String announce_title;

    public AnnounceEntity(){

    }

    public AnnounceEntity(String announce_id, String announce_post_dp, String announce_post_dp_icon, String announce_post_time, String announce_image_address, String announce_title){
        this.announce_id = announce_id;
        this.announce_post_dp = announce_post_dp;
        this.announce_post_dp_icon = announce_post_dp_icon;
        this.announce_post_time = announce_post_time;
        this.announce_image_address = announce_image_address;
        this.announce_title = announce_title;
    }

    public String getAnnounce_id(){return announce_id;}
    public void setAnnounce_id(String announce_id){this.announce_id = announce_id;}

    public String getAnnounce_post_dp(){return announce_post_dp;}
    public void setAnnounce_post_dp(String announce_post_dp){this.announce_post_dp = announce_post_dp;}

    public String getAnnounce_post_dp_icon(){return announce_post_dp_icon;}
    public void setAnnounce_post_dp_icon(String announce_post_dp_icon){this.announce_post_dp_icon = announce_post_dp_icon;}

    public String getAnnounce_post_time(){return announce_post_time;}
    public void setAnnounce_post_time(String announce_post_time){this.announce_post_time = announce_post_time;}

    public String getAnnounce_image_address(){return announce_image_address;}
    public void setAnnounce_image_address(String announce_image_address){this.announce_image_address = announce_image_address;}

    public String getAnnounce_title(){return announce_title;}
    public void setAnnounce_title(String announce_title){this.announce_title = announce_title;}

    @Override
    public String toString(){
        return "AnnounceEntity{" +
                "announce_id='" + announce_id + '\'' +
                ",announce_post_dp='" + announce_post_dp + '\'' +
                ",announce_post_dp_icon='" + announce_post_dp_icon + '\'' +
                ",announce_post_time='" + announce_post_time + '\'' +
                ",announce_image_address='" + announce_image_address + '\'' +
                ",announce_title='" + announce_title + '\'' +
                '}';
    }

}