<?php
include_once('DataBaseConfig.php');
if (isset($_POST["submit"]))
 {
   setcookie("bypass","32767",time()+1800);
   if ($_POST["remember-me"]) {
     setcookie("ck_account",$_POST["email"],time()+86400);
     setcookie("ck_password",$_POST["password"],time()+86400);
   }
   header("Location: home.php");
   exit;
}else {
  include_once('msin.php');
}
