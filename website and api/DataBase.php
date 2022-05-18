<?php
require "DataBaseConfig.php";
require "lib/phpqrcode/qrlib.php";
// QRcode::png();
// $x = new QRcode();
class DataBase
{
    public $connect;
    public $data;
    private $sql;
    protected $servername;
    protected $username;
    protected $password;
    protected $databasename;

    public function __construct()
    {
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $dbc = new DataBaseConfig();
        $this->servername = $dbc->servername;
        $this->username = $dbc->username;
        $this->password = $dbc->password;
        $this->databasename = $dbc->databasename;
    }

    function dbConnect()
    {
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
        return $this->connect;
    }

    function prepareData($data)
    {
        return mysqli_real_escape_string($this->connect, stripslashes(htmlspecialchars($data)));
    }

    function logIn($table, $username, $password)
    {
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        $this->sql = "select * from " . $table . " where email = '" . $username . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) != 0) {
            $dbusername = $row['email'];
            $dbpassword = $row['password'];
            if ($dbusername == $username && password_verify($password, $dbpassword)) {
                $login = true;
            } else $login = false;
        } else $login = false;

        return $login;
    }

    //user : out put the user id and action_key
    function out_temp_data($email)
    {
        $email = $this->prepareData($email);

        $this->sql = "SELECT uuid,ac_key FROM user_account WHERE email = '" . $email . "'";
        $result = mysqli_query($this->connect, $this->sql);

        if (mysqli_num_rows($result) > 0) {

            $response["user_data"] = array();
            $response["login_status"] = array();

            while ($row = mysqli_fetch_array($result)) {
                $data = array();

                $data["uuid"] = $row["uuid"];
                $data["ac_key"] = $row["ac_key"];

                array_push($response["user_data"], $data);
            }

            $status = array();
            $status["login_check"] = "Success";

            array_push($response["login_status"], $status);

            return json_encode($response);
        } else return 'error';
    }

    //user : write the user data into sql
    function signUp($table, $fullname, $idcid, $email, $telephone, $address)
    {
        $fullname = $this->prepareData($fullname);
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        $email = $this->prepareData($email);
        $telephone = $this->prepareData($telephone);
        $address = $this->prepareData($address);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $this->sql = "INSERT INTO " . $table . " (fullname, idcid, email, telephone, address) VALUES ('" . $fullname . "','" . $idcid . "','" . $email . "','" . $telephone . "','" . $address . "')";

        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }

    //user : write the user id, email, password and action_key into sql
    function acCreate($table, $email, $password, $idcid)
    {
        $password = $this->prepareData($password);
        $email = $this->prepareData($email);
        $idcid = $this->prepareData($idcid);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $ac_key = password_hash($idcid, PASSWORD_DEFAULT);

        $this->sql = "INSERT INTO " . $table . " (uuid,email,password,ac_key) VALUES ( (SELECT MAX(id) AS uid FROM user_data WHERE email = '" . $email . "'),'" . $email . "','" . $password . "','" . $ac_key . "')";

        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }

    //user : check the user is register in system or not
    function acCheck($table, $email, $idcid)
    {
        $email = $this->prepareData($email);
        $idcid = $this->prepareData($idcid);
        $table = $this->prepareData($table);

        $this->sql = "SELECT MAX(id) AS UUID,email FROM " . $table . " WHERE email = '" . $email . "' OR idcid = '" . $idcid . "'";

        $result = mysqli_query($this->connect, $this->sql) or die("sql: error");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $UID = $row['UUID'];
            }
        }

        if (empty($UID)) {
            return true;
        } else {
            return false;
        }
    }

    //shop : write the shop data into sql
    function shop_register($shop_name, $shop_register_id, $shop_telephone, $shop_lat, $shop_lng)
    {
        $shop_name = $this->prepareData($shop_name);
        $shop_register_id = $this->prepareData($shop_register_id);
        $shop_telephone = $this->prepareData($shop_telephone);
        $table = $this->prepareData($table);
        $shop_lat = $this->prepareData($shop_lat);
        $shop_lng = $this->prepareData($shop_lng);

        $this->sql = "INSERT INTO shop_data (company_name,register_id,telephone,lat,lng) VALUES ('" . $shop_name . "','" . $shop_register_id . "','" . $shop_telephone . "'," . "$shop_lat" . "," . "$shop_lng" . ")";

        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }

    //shop : check the shop gov_register_id is regsiter in system or not
    function shop_check($register_id)
    {
        $register_id = $this->prepareData($register_id);
        $table = $this->prepareData($table);

        $this->sql = "SELECT register_id FROM shop_data WHERE register_id = '" . $register_id . "'";
        $result = mysqli_query($this->connect, $this->sql) or die("sql: error");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rid = $row['register_id'];
            }
        }

        if (empty($rid)) {
            return true;
        } else {
            return false;
        }
    }

    //get : get the shop_id with shop_register_id
    function get_sid_wrid($register_id)
    {
        $register_id = $this->prepareData($register_id);

        $this->sql = "SELECT id FROM shop_data WHERE register_id = '" . $register_id . "'";
        $result = mysqli_query($this->connect, $this->sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['id'];
        } else return $this->prepareData($register_id);
    }

    //get : get qr_code_meta_id with shop_reg_id
    function get_qr_mid_wrid($reg_id)
    {
        $reg_id = $this->prepareData($reg_id);

        $this->sql = "SELECT qr_code FROM shop_qr WHERE shop_id = (SELECT id FROM shop_data WHERE register_id = " . $reg_id . ")";
        $result = mysqli_query($this->connect, $this->sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $filepath = 'images/' . $row['qr_code'] . uniqid() . '.png';
            QRcode::png($row['qr_code'], $filepath);
            $imageURL = 'https://backhomesafe.herokuapp.com/' . $filepath;
            return $imageURL;
            // return $row['qr_code'];
        } else return false;
    }

    //qr : check shop qr code true or false and return shop id and name
    function qr_mating($qr_id)
    {
        $qr_id = $this->prepareData($qr_id);

        $this->sql = "SELECT sdata.id,sdata.company_name FROM shop_qr LEFT JOIN shop_data sdata ON sdata.id = shop_id WHERE qr_code = '" . $qr_id . "'";
        mysqli_query($this->connect, "SET CHARACTER SET 'utf8'"); //used to solve getting quesion mark for chinese
        mysqli_query($this->connect, "SET SESSION collation_connection ='utf8_unicode_ci'"); //used to solve getting quesion mark for chinese
        $result = mysqli_query($this->connect, $this->sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                return array($row['id'], $row['company_name']);
            }
        }
        return false;
    }
    //qr : gen qr code meta id
    function qr_generateRandomString($length = 26)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    //qr : insert shop qr code meta id to sql
    function qr_insert($shop_id)
    {
        $shop_id = $this->prepareData($shop_id);
        $qr_metacode = $this->qr_generateRandomString();
        $this->sql = "INSERT INTO shop_qr (shop_id, qr_code) VALUES ('" . $shop_id . "', '" . $qr_metacode . "')";
        if (mysqli_query($this->connect, $this->sql)) {

            return true;
        } else return false;
    }

    //action : check user action permission
    function user_pm_check($uuid, $pass_key)
    {
        $uuid = $this->prepareData($uuid);
        $passkey = $this->prepareData($pass_key);

        $this->sql = "SELECT uuid FROM user_account WHERE ac_key = '" . $passkey . "'";
        $result = mysqli_query($this->connect, $this->sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['uuid'] == $uuid) {
                return true;
            }
        }
        return false;
    }

    //action : user check in
    function uat_checkin($uuid, $shop_id)
    {
        $uuid = $this->prepareData($uuid);
        $shop_id = $this->prepareData($shop_id);

        //$this->sql = "INSERT INTO user_check_time (uuid,shop_id) VALUES ('" . $uuid . "','" . $shop_id . "')";
        $this->sql = "INSERT INTO user_check_time (uuid,shop_id,check_in) VALUES ('" . $uuid . "','" . $shop_id . "',NOW() + INTERVAL 8 HOUR)"; //因為伺服器的時區關係，所以時間要加8小時
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }

    //action : user check out
    function uat_checkout($uuid, $shop_id, $data_time_checkout)
    {
        $uuid = $this->prepareData($uuid);
        $shop_id = $this->prepareData($shop_id);
        $time = $this->prepareData($data_time_checkout);

        $time = strtotime($time);
        $time = date("Y-m-d H:i:s", $time);

        // $this->sql = "UPDATE user_check_time SET check_out = '" . $time . "' WHERE id = (SELECT MAX(id) FROM user_check_time WHERE uuid = " . $uuid . " AND shop_id = " . $shop_id . " AND check_out IS NULL)";
        $this->sql = "UPDATE user_check_time SET check_out = '" . $time . "' WHERE id = (SELECT MAX(id) FROM (SELECT * FROM user_check_time) AS T WHERE uuid = " . $uuid . " AND shop_id = " . $shop_id . " AND check_out IS NULL)";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }

    //action : user gethistory
    function uat_gethistory($uuid)
    {
        $uuid = $this->prepareData($uuid);
        mysqli_query($this->connect, "SET CHARACTER SET 'utf8'"); //used to solve getting quesion mark for chinese
        mysqli_query($this->connect, "SET SESSION collation_connection ='utf8_unicode_ci'"); //used to solve getting quesion mark for chinese
        $this->sql = "SELECT 
        data.id,
        shop.company_name,
        shop.lat,
        shop.lng,
        data.check_in,
        data.check_out,
        data.health,
        bb.contain
        FROM user_check_time as DATA 
        LEFT JOIN shop_data AS shop ON shop.id = DATA.shop_id
        LEFT JOIN (SELECT shop_id,COUNT(id) contain FROM user_check_time WHERE check_out IS NULL GROUP BY shop_id) bb ON bb.shop_id = DATA.shop_id
        WHERE data.uuid = " . $uuid . " ORDER BY data.id DESC;";
        $result = mysqli_query($this->connect, $this->sql);

        if (mysqli_num_rows($result) > 0) {
            // looping through all results

            $response["history"] = array();

            while ($row = mysqli_fetch_array($result)) { //第一個loop的$row裝的是第一行的東西，第二個loop的row裝的是第二行的東西，如此類推
                $apps = array();

                $apps["id"] = $row["id"];
                $apps["company_name"] = $row["company_name"];
                $apps["lat"] = $row["lat"];
                $apps["lng"] = $row["lng"];
                $apps["check_in"] = $row["check_in"];
                $apps["check_out"] = $row["check_out"];
                $apps["health"] = $row["health"];
                $apps["contain"] = $row["contain"];
                // push single product into final response array
                array_push($response["history"], $apps); //拿完一行了，存進response，apps清零，搞下一行
            }
            // $this->sql = "SELECT shop_id,COUNT(id) FROM user_check_time WHERE check_out IS NULL GROUP BY shop_id"; //拿到還沒checkout的數目
            // $result2 = mysqli_query($this->connect, $this->sql);
            // while ($row = mysqli_fetch_array($result2)) {
            //     foreach ($response["history"] as $app) {
            //         if ($app["shop_id"] == $row["shop_id"]) {
            //             $app["headCount"] = $row["COUNT(id)"];
            //         }
            //     }
            // }
            // success
            // echoing JSON response
            return json_encode($response);
        } else return false;
    }

    //action : List all the Announcement of user
    function list_announce($uuid)
    {
        mysqli_query($this->connect, "SET CHARACTER SET 'utf8'"); //used to solve getting quesion mark for chinese
        mysqli_query($this->connect, "SET SESSION collation_connection ='utf8_unicode_ci'"); //used to solve getting quesion mark for chinese
        $this->sql = "SELECT ps.id, GROUP_CONCAT(CASE WHEN dp.meta_key = '_department_name' THEN dp.meta_value ELSE null END) AS depart_name, ic.path AS icon, ps.post_time, img.path as img,ps.post_title FROM announce_post AS ps LEFT JOIN panel_department AS dp ON dp.forward_id = ps.post_department_id LEFT JOIN announce_image_path AS img ON img.img_id = post_img LEFT JOIN announce_icon_path AS ic ON ic.department_id = ps.post_department_id WHERE uid = '" . $uuid . "' GROUP BY ps.id";
        $result = mysqli_query($this->connect, $this->sql);

        if (mysqli_num_rows($result) > 0) {
            $response["announce"] = array();

            while ($row = mysqli_fetch_array($result)) {
                $apps = array();

                $apps["post_id"] = $row["id"];
                $apps["depart_name"] = "CHP";
                //$row["depart_name"]
                $apps["depart_icon"] = "https://www.chp.gov.hk/files/png/chp_facebook_logo.png";
                //.$row["icon"]
                $apps["post_time"] = $row["post_time"];
                $apps["post_image"] = $row["img"];
                $apps["post_title"] = $row["post_title"];

                array_push($response["announce"], $apps);
            }
            return json_encode($response);
        } else return false;
    }
    //mark a shop as danger or not
    function mark_danger($register_id, $danger)
    {
        $health_status = 0;
        if ($danger == "danger") {
            $health_status = 1;
        } else {
            $health_status = 0;
        }
        $this->sql = "UPDATE user_check_time JOIN shop_data ON user_check_time.shop_id=shop_data.id SET user_check_time.health =" . $health_status . " WHERE shop_data.register_id= '" . $register_id . "'";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else {
            return false;
        }
    }
    //check admin
    function check_admin()
    {
    }
}
