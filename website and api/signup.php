<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['fullname']) && isset($_POST['telephone']) && isset($_POST['address']) && isset($_POST['idcid'])) {
    if ($db->dbConnect()) {
    	if ($db->acCheck("user_data", $_POST['email'], $_POST['idcid'])){	
    		if ($db->signUp("user_data", $_POST['fullname'], $_POST['idcid'], $_POST['email'], $_POST['telephone'], $_POST['address']) && $db->acCreate("user_account", $_POST['email'], $_POST['password'], $_POST['idcid'])) {
    			echo "Sign Up Success";
    		} else echo "Sign up Failed";
    	}else echo "Account Was Created";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
