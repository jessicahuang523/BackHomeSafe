<?php
require "DataBase.php";
$db = new DataBase();
$at = new Action();

if ($db->dbConnect()) {
?>
<div class="col-md-4">
  <label for="inputFullName4" class="form-label">信息模板</label>
  <select id="inputDepartment" name="" class="form-select">
    <option selected>Choose...</option>
    <?php $db->announce_get_demo_list(); ?>
  </select>
</div>
<?php
$idcid = "Z1263456";
if ($db->announce_post_check_uid_by_idcid($idcid)) {
  print_r($db->announce_post_check_uid_by_idcid($idcid));
  print_r($db->announce_post_check_close_relation($db->announce_post_check_uid_by_idcid($idcid)));
}else echo "HKIDCID wrong";

}
?>
