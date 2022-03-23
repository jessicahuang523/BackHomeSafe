<?php
require "DataBase.php";
$db = new DataBase();

echo "AT get_sid_wrid :";
$test = 123;
print_r($db->get_sid_wrid($test));
?>
