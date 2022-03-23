<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['submit'])) {
  if ($db->dbConnect()) {
    if (isset($_POST['submit'] == "announce_post_single")) {
      // code...
      $db->announce_add_post($uid, $post_department, $post_title, $post_img, $post_details, $check_time, $anthour)
    }elseif (isset($_POST['submit'] == "announce_post_relation")) {
      // code...
    }elseif (isset($_POST['submit'] == "")) {
      // code...
    }elseif (condition) {
      // code...
    }
  }
}
?>
