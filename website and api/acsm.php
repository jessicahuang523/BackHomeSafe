<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['uuid']) && isset($_POST['pass_key']) && isset($_POST['at_type'])) {
	if ($db->dbConnect()) {
		if ($db->user_pm_check($_POST['uuid'], $_POST['pass_key'])) {


			if ($_POST['at_type'] == "user_check_in") {
				if (isset($_POST['uuid']) && isset($_POST['shop_id'])) {
					echo "string1";
					if ($db->uat_checkin($_POST['uuid'], $_POST['shop_id'])) {
						echo "Action Update Success";
					} else echo "Action Failed";
				} else echo "Missing Data";
			} else if ($_POST['at_type'] == "user_check_out") {
				if (isset($_POST['uuid']) && isset($_POST['shop_id']) && isset($_POST['data_time_checkout'])) {
					if ($db->uat_checkout($_POST['uuid'], $_POST['shop_id'], $_POST['data_time_checkout'])) {
						echo "Action Update Success";
					} else echo "Action Failed";
				} else echo "Missing Data";
			} else if ($_POST['at_type'] == "get_history") {
				if (isset($_POST['uuid'])) {
					if ($db->uat_gethistory($_POST['uuid'])) {
						print_r($db->uat_gethistory($_POST['uuid']));
					} else echo "Action Failed";
				} else echo "Missing Data";
			} else if ($_POST['at_type'] == "get_announce") {
				// code...
				if (isset($_POST['uuid'])) {
					if ($db->list_announce($_POST['uuid'])) {
						print_r($db->list_announce($_POST['uuid']));
					} else echo "Action Failed";
				} else echo "Missing Data";


				//When scan the QR Code and checkin action
			} else if ($_POST['at_type'] == "qr_processing") {
				if (isset($_POST['qrid'])) {
					if ($db->qr_mating($_POST['qrid'])) {
						$result = $db->qr_mating($_POST['qrid']);
						if ($db->uat_checkin($_POST['uuid'], $result[0])) {
							echo json_encode($result);
						} else echo "Check In Failed";
					} else echo "QrCode Check Failed";
				} else echo "Missing Data";
			} else if ($_POST['at_type'] == "test-ci") {
			} else if ($_POST['at_type'] == "test-co") {
				# code...
			} else if ($_POST['at_type'] == "test-gh") {
				# code...
			} else {
				echo "Error #A001; Please Contact Us email:kodyglock@gmail.com";
			}
		} else echo "action Delay";
	} else echo "Error: Database connection";
} else echo "All fields are required";
