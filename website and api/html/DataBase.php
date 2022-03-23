<?php
require "DataBaseConfig.php";

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
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename) or die ("could not connect to mysql");
        return $this->connect;
    }

    function prepareData($data)
    {
        return mysqli_real_escape_string($this->connect, stripslashes(htmlspecialchars($data)));
    }

    // login system //
    function logIn($table, $username, $password)
    {
    }
    function register()
    {
    }
    function register_data_check()
    {
    }
    function register_check()
    {
    }
    function signUp($table, $fullname, $idcid, $email, $telephone, $address)
    {
    }
    function acCreate($table, $email, $password, $idcid)
    {
    }
    function acCheck($table, $email, $idcid)
    {
    }

    // action_key //
    function action_key_check()
    {
    }
    function action_key_update()
    {
    }
    function action_key_save()
    {
    }

    // ******************** //
    //    access history    //
    // ******************** //

    function check_access_history($uuid)
    {
      $uuid = $this->prepareData($uuid);
      $this->sql = "SELECT A.uuid,sd.company_name,A.check_in,A.check_out,A.health FROM user_check_time AS A LEFT JOIN shop_data as sd ON sd.id = A.shop_id WHERE A.uuid = '". $uuid ."' ORDER BY A.id DESC";

      $result = mysqli_query($this->connect, $this->sql);
      if(mysqli_num_rows($result) > 0){
        echo '<div class="card"><div class="card-header" style="padding: 20px;"><div class="row m-0"><div class="col-sm-4"><div class="float-left"><div class="page-title"><h4>Result</h4></div></div></div><div class="col-sm-8"><div class="float-right" style="float: right;"><div class="d-flex"><div class="access_history_result_color_box"><div class="bg-success"></div><strong>安全</strong></div><div class="access_history_result_color_box"><div class="bg-warning"></div><strong>低風險</strong></div><div class="access_history_result_color_box"><div class="bg-danger"></div><strong>高風險</strong></div></div></div></div></div></div><div class="card-body"><table class="table table-hover"><thead><tr><th scope="col">SHOP NAME</th><th scope="col">進入</th><th scope="col">離開</th></tr></thead><tbody>';
        while($row = mysqli_fetch_assoc($result)){
          if ($row["health"] == 0) {
            $health_color_class = "table-success";
          }
          if ($row["health"] == 1) {
            $health_color_class = "table-warning";
          }
          if ($row["health"] == 2) {
            $health_color_class = "table-danger";
          }
          echo '<tr class="'.$health_color_class.'">
          <td>'. $row["company_name"] .'</td>
          <td>'. $row["check_in"] .'</td>
          <td>'. $row["check_out"] .'</td>
          </tr>';
        }
        echo "</tbody></table></div></div>";
      } else return false;
    }

    // ** announce ** //
    // announce add //
    function announce_add_demo($title,$image,$details){
      $title = $this->prepareData($title);
      $image = $this->prepareData($image);
      $details = $this->prepareData($details);

      if(!empty($title && $image && $details)){
        $this->sql = "INSERT INTO announce_demo (title,detail,image) VALUES ('". $title ."','". $details ."','". $image ."')";
        if (mysqli_query($this->connect, $this->sql)) {
          return true;
        }else echo $this->sql;
      }else {
        echo "Some fields are empty <br>"."title : ".$title."<br> details : ".$details."<br> image : ".$image;
        print_r($image);
      }
    }

    function announce_add_demo_image_to_sql($path)
    {
      if(is_array($path) || empty($path)){
        return print_r($path);
      }else {
        $npath = $this->prepareData($path);
        $this->sql = "INSERT INTO announce_image_path (path) VALUES ('". $npath ."')";
        if (mysqli_query($this->connect, $this->sql)) {
          $this->sql = "SELECT MAX(img_id) as image_id FROM announce_image_path WHERE path = '". $npath ."'";
          $result = mysqli_query($this->connect, $this->sql);
          if (mysqli_query($this->connect, $this->sql)) {
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){
                $img_id = $row['image_id'];
                return $img_id;
              }
            } else return false;
          } else return false;
        } else return false;
      }
    }

    // announce post //
    function announce_get_demo_list()
    {
      $this->sql = "SELECT id,title FROM announce_demo ORDER BY id DESC";
      $result = mysqli_query($this->connect, $this->sql);
      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          echo '<option value="'. $row['id'] .'">#'. $row['id'].' '.$row['title'] .'</option>';
        }
        return true;
      } else return false;
    }
    function announce_get_cur_department()
    {
    }
    function announce_get_all_department()
    {
      $this->sql =  "SELECT forward_id,meta_value FROM panel_department WHERE meta_key = '_department_name'";
      $result = mysqli_query($this->connect, $this->sql);

      if (mysqli_num_rows($result) > 0) {
        return $result;
      }else return false;
    }
    function announce_add_post($uid, $post_department, $post_title, $post_img, $post_details, $check_time, $anthour)
    {
      if (!empty($uid) && !empty($post_department) && !empty($post_title) && !empty($post_img) && !empty($post_details) && !empty($check_time_id) && !empty($anthour)) {
        $post_title = $this->prepareData($post_title);
        $post_details = $this->prepareData($post_details);

        $this->sql = "INSERT INTO announce_post ('uid', 'post_department_id', 'post_title', 'post_img', 'post_details', 'check_time_id', 'author_id') VALUES ('". $uid ."', '". $post_department ."', '". $post_title ."', '". $post_img ."', '". $post_details ."', '". $check_time ."', '". $anthour ."')";
        if (mysqli_query($this->connect, $this->sql)) {
          return true;
        }else echo $this->sql;

      }else return "error";
    }
    function announce_post_check_diagnos($idcid,$time_one,$time_two)
    {
      $idcid = $this->prepareData($idcid);
      $time_one = $this->prepareData($time_one);
      $time_two = $this->prepareData($time_two);

      $uid = $this->announce_post_check_uid_by_idcid($idcid);

      announce_post_check_diagnose_4($uid);
      announce_post_check_diagnose_3($time_one,$time_two);
      announce_post_check_diagnose_2();


    }
    function announce_post_check_diagnose_2()
    {
      announce_post_check_close_relation($uid);
    }
    function announce_post_check_diagnose_3()
    {
      announce_post_check_close_relation($uid);
      announce_post_check_same_time();
    }
    function announce_post_check_diagnose_4($action_1,$post_1,$action_2,$post_2,$action_3,$post_3,$action_4,$post_4,$idcid)
    {
      announce_post_check_close_relation($uid);
      announce_post_check_same_time();
      announce_post_check_same_day();

    }
    function announce_post_check_uid_by_idcid($idcid)
    {
      $this->sql = "SELECT id FROM user_data WHERE idcid = '".$idcid."'";
      $result = mysqli_query($this->connect, $this->sql);
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
          return $row["id"];
        }
      }else return false;
    }
    function announce_post_check_close_relation($uid)
    {
      $this->sql = "SELECT GROUP_CONCAT(CASE WHEN ur.meta_key = '_close_contacts' THEN ur.meta_value ELSE null END) AS close_contacts FROM user_relation as ur WHERE fid = ".$uid." GROUP BY ur.meta_id";
      $result = mysqli_query($this->connect, $this->sql);
      if (mysqli_num_rows($result) > 0) {
        $stack = array();
        while($row = mysqli_fetch_assoc($result)){
          array_push($stack, $row["close_contacts"]);
        }
        return $stack;
      }else return false;
    }
    function announce_post_check_same_time()
    {
      $this->sql = "UPDATE user_check_time SET health = 2 WHERE (check_in BETWEEN '2021-04-22 22:30:00' AND '2021-04-22 23:30:00') OR (check_out BETWEEN '2021-04-22 22:30:00' AND '2021-04-22 23:30:00')";
      $this->sql = "SELECT id FROM user_check_time WHERE (check_in BETWEEN '2021-04-22 22:30:00' AND '2021-04-22 23:30:00') OR (check_out BETWEEN '2021-04-22 22:30:00' AND '2021-04-22 23:30:00')";
    }
    function announce_post_check_same_day($health,$shop_id,$in_time,$out_time)
    {
      $this->sql = "UPDATE user_check_time SET health = 1 WHERE check_in > '2021-04-22 23:30:00' AND check_in < '2021-04-23 00:00:00' AND shop_id = '1'";
      $this->sql = "SELECT * FROM user_check_time WHERE check_in > '2021-04-22 23:30:00' AND check_in < '2021-04-23 00:00:00' AND shop_id = '1'";
    }
    // Announce List Post //
    function list_announce()
    {
      $this->sql = "SELECT ap.id,ap.post_time,u.fullname,ap.post_title,ap.post_department_id,ap.author_id FROM announce_post AS ap LEFT JOIN user_data AS u ON u.id = ap.uid ORDER BY ap.id DESC";

      $result = mysqli_query($this->connect, $this->sql);
      if(mysqli_num_rows($result) > 0){
        echo '<table class="table table-hover"><thead><tr><th scope="col">Id</th><th scope="col">Post Time</th><th scope="col">Full Name</th><th scope="col">Title</th><th scope="col">Post Department</th><th scope="col">Author</th></tr></thead><tbody>';
        while($row = mysqli_fetch_assoc($result)){
          echo '<tr">
          <td>'. $row["id"] .'</td>
          <td>'. $row["post_time"] .'</td>
          <td>'. $row["fullname"] .'</td>
          <td>'. $row["post_title"] .'</td>
          <td>'. $row["post_department_id"] .'</td>
          <td>'. $row["author_id"] .'</td>
          </tr>';
        }
        echo "</tbody></table>";
      } else return false;
    }

    // announce view //
    function announce_list_all_demo()
    {
      $this->sql = "SELECT id,title,img.path as image FROM announce_demo LEFT JOIN announce_image_path as img ON img.img_id = image ORDER BY id DESC";
      $result = mysqli_query($this->connect, $this->sql);
      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          echo '<div class="col-md-3">
            <div class="card accounce_demo_post">
              <div class="card-header accounce_demo_header">
                <img src="announce_icon\1200px-Centre_for_Health_Protection.svg.png" alt="company_name" width="auto" height="40" class="custom-card-header-demo-icon">
                <strong class="custom-card-header-demo-title">衞生防護中心</strong>
                <p class="custom-card-header-demo-time">2 mins ago</p>
              </div>
              <img class="accounce_demo_post_image" src="'. $row['image'] .'" alt="Card image cap">
              <div class="card-body">
                <h4 class="card-title mb-3">'. $row['title'] .'</h4>
              </div>
              <div class="accounce_demo_post_content">
                <button type="button" class="btn btn-primary accounce_demo_post_content_btn" onclick="alert('. $row['id'] .')">檢視</button>
                <button type="button" class="btn btn-success accounce_demo_post_content_btn" onclick="alert('. $row['id'] .')">修改</button>
                <button type="button" class="btn btn-danger accounce_demo_post_content_btn" onclick="alert('. $row['id'] .')">刪除</button>
              </div>
            </div>
          </div>';
        }
        return true;
      } else return false;
      $time = aaa;
      if (time) {
        // code...
      }
    }
    function announce_list_cur_department_demo()
    {
    }
    // announce edit //
}

class Action
{
  function announce_add_demo_image_to_server($file,$from)
  {
    $upload_locat = $from;

    # 檢查檔案是否上傳成功
    if ($file["error"] === UPLOAD_ERR_OK && $upload_locat){

      # 伺服器配置 (default = image)
      $max_img_size = 8388608;
      $allow_file_type = ["jpg","jpeg","png","webp","gif","svg"];
      $full_path = "https://wen0750.club/y3_project/html/";
      $path = "announce_img/";

      if ($upload_locat == "icon") {
        // Icon upload setting
        $path = "announce_icon/";
        $allow_file_type = ["jpg","jpeg","png","webp","svg"];
      }

      # 檢查檔案是否已經存在
      if (file_exists($path . $file["name"])){
        echo "檔案已存在。<br/>";
      } else {
        $file_name = $file["name"];
        $file_temp = $file["tmp_name"];
        $file_type = $file["type"];
        $exp_file_type = explode(".", $file["name"]);
        $file_ext = strtolower(end($exp_file_type));
        $file_size = $file["size"];

        $md5file = md5_file($file_temp);
        $newfilename = date("Y-m-d"). "_" .$md5file . "." . end($exp_file_type);

        # 檢查檔案是否滿足上傳條件
        if (!in_array($file_ext, $allow_file_type)) {
          $errors[] = "The Extension is not allowed: " . $file_name . "";
        }
        if ($file_size > $max_img_size) {
          $errors[] = "File size exceeds limit: " . $file_name . "";
        }
        if (file_exists($path . $newfilename)) {
          $errors[] = "The file was uploaded a time today: " . $file_name . "";
        }

        # 將檔案移至指定位置
        if (empty($errors)) {
          move_uploaded_file($file_temp, $path . $newfilename);
          $server_path = $full_path . $path . $newfilename;
          return $server_path;
        }else return $errors;
      }

    } else {
      echo "錯誤代碼：" . $file["error"] . "<br/>";
    }
  }
}
?>
