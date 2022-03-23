<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['shop_name']) && isset($_POST['shop_reg_id']) && isset($_POST['shop_telephone'])) {
    if ($db->dbConnect()) {
    	if($db->shop_check($_POST['shop_reg_id'])){
    		if ($db->shop_register($_POST['shop_name'], $_POST['shop_reg_id'], $_POST['shop_telephone'])) {
    			//get the shop_id with the shop_register_id
    			if ($db->get_sid_wrid($_POST['shop_reg_id'])) {

    				//Creat the shop QR Code
	    			if ($db->qr_insert($db->get_sid_wrid($_POST['shop_reg_id']))) {

	    				//out put the shop QR Code
	    				if ($db->qr_check_qrid_sid($_POST['shop_reg_id'])) {

	    				}else echo "string";

	    			}else echo "error #qr013";
	    			//#qr013 is the qr_code or shop_id wrong
	    		}else echo "Get the shop_id fault";
    		} else echo "Form Submit Fault";
    	} else echo "That Shop Was Registered";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
