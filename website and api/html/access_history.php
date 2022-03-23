<?php
if (isset($_GET["IDCID"])) {
  $idcid = $_GET["IDCID"];
  //if (isset($idcid) && !empty($idcid))
  if (isset($idcid) && !empty($idcid)) {
    // code...
    require "DataBase.php";
    $db = new DataBase();

    if ($db->dbConnect()) {
      // code...
      $uid = $db->announce_post_check_uid_by_idcid($idcid);
      $db->check_access_history($uid);
    }
  }
}else{
?>
<div id="htmlContent">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header custom-card-header">
          <h4>Check User Visit Record</h4>
        </div>
        <div class="card-body">
          <div class="row g-3" id="check_history_form">
            <!-- row 1 -->
            <div class="col-md-4">
              <label for="exampleFormControlInput1" class="form-label">HKIDC ID</label>
              <input type="text" class="form-control" id="check_history_idcid" placeholder="M123456(7)" onchange="access_history_sm(this.value);">
            </div>
            <div class="col-12">
              <button type="submit" id="submit" class="btn btn-success">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" id="contentScript">
function access_history_sm(idcid){
  var content = document.getElementById("content");
  var subcontent = document.getElementById("subcontent");
  if (!subcontent) {
    var div = document.createElement("div");
    div.id = 'subcontent';
    content.appendChild(div);
  }
  if (idcid == "") {
    alert('Please Fill All feils');
  }else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("subcontent").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "access_history.php?IDCID=" + idcid, true);
    xmlhttp.send();
  }
}
</script>
<?php
} ?>
