<?php
if (isset($_GET["ww"])) {
  // code...
}else {
  ?>
  <div id="htmlContent">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header custom-card-header">
            <h4>Add Announcement</h4>
          </div>
          <div class="card-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">建立單個</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">建立關係鏈</a>
              </li>
              <!--
              <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">建立單個</a>
              </li>
            -->
            </ul>
            <hr>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <form class="row g-3" method="get" action="home.php">
                  <!-- row 1 -->
                  <div class="col-12">
                    <div class="col-md-4">
                      <label for="exampleFormControlInput1" class="form-label">HKIDC ID</label>
                      <input type="text" class="form-control" id="check_history_idcid" placeholder="M123456(7)">
                    </div>
                  </div>

                  <!-- row 2 -->
                  <div class="col-md-4">
                    <label for="inputFullName4" class="form-label">對象</label>
                    <select id="inputDepartment" name="announce_add_post" class="form-select">
                      <option selected>確診者</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="inputFullName4" class="form-label">行動</label>
                    <select id="inputDepartment" name="" class="form-select">
                      <option selected>強制檢疫</option>
                      <option>居家隔離</option>
                      <option>建議檢疫</option>
                      <option>予以通知</option>
                      <option>不作行動</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="inputFullName4" class="form-label">信息模板</label>
                    <select id="inputDepartment" name="" class="form-select">
                      <?php
                      require "DataBase.php";
                      $db = new DataBase();

                      if ($db->dbConnect()) {
                        // code...
                        $db->announce_get_demo_list();
                      ?>
                    </select>
                  </div>

                  <!-- row 3 -->
                  <div class="col-md-6">
                    <label for="inputDepartment" class="form-label">發佈 部門或機構</label>
                    <select id="inputDepartment" class="form-select">
                      <option selected>疾控中心</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="col-12">
                    <button type="submit" name="submit" value="announce_post_single" class="btn btn-success">Submit</button>
                  </div>
                </form>
              </div>

              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <form class="row g-3">
                  <!-- row 0 -->
                  <div class="col-12">
                    <div class="col-md-4">
                      <label for="exampleFormControlInput1" class="form-label">HKIDC ID</label>
                      <input type="text" class="form-control" id="check_history_idcid" placeholder="M123456(7)">
                    </div>
                  </div>

                  <!-- row 1 -->
                  <div class="col-md-4">
                    <label for="inputFullName4" class="form-label">對象</label>
                    <select id="inputDepartment" name="announce_add_post" class="form-select">
                      <option selected>確診者</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="inputFullName4" class="form-label">行動</label>
                    <select id="inputDepartment" name="" class="form-select">
                      <option selected>強制檢疫</option>
                      <option>居家隔離</option>
                      <option>建議檢疫</option>
                      <option>予以通知</option>
                      <option>不作行動</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="inputFullName4" class="form-label">信息模板</label>
                    <select id="inputDepartment" name="" class="form-select">
                      <?php $db->announce_get_demo_list(); ?>
                    </select>
                  </div>

                  <!-- row 2 -->
                  <div class="col-md-4">
                    <label for="inputFullName4" class="form-label">對象</label>
                    <select id="inputDepartment" class="form-select">
                      <option selected>密切接觸者</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="inputFullName4" class="form-label">行動</label>
                    <select id="inputDepartment" class="form-select">
                      <option>強制檢疫</option>
                      <option selected>居家隔離</option>
                      <option>建議檢疫</option>
                      <option>予以通知</option>
                      <option>不作行動</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="inputFullName4" class="form-label">信息模板</label>
                    <select id="inputDepartment" class="form-select">
                      <?php $db->announce_get_demo_list(); ?>
                    </select>
                  </div>

                  <!-- row 3 -->
                  <div class="col-md-4">
                    <label for="inputFullName4" class="form-label">對象</label>
                    <select id="inputDepartment" class="form-select">
                      <option selected>高風險人士</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="inputFullName4" class="form-label">行動</label>
                    <select id="inputDepartment" class="form-select">
                      <option>強制檢疫</option>
                      <option>居家隔離</option>
                      <option selected>建議檢疫</option>
                      <option>予以通知</option>
                      <option>不作行動</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="inputFullName4" class="form-label">信息模板</label>
                    <select id="inputDepartment" class="form-select">
                      <?php $db->announce_get_demo_list(); ?>
                    </select>
                  </div>

                  <!-- row 4 -->
                  <div class="col-md-4">
                    <label for="inputFullName4" class="form-label">對象</label>
                    <select id="inputDepartment" class="form-select">
                      <option selected>低風險人士</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="inputFullName4" class="form-label">行動</label>
                    <select id="inputDepartment" class="form-select">
                      <option>強制檢疫</option>
                      <option>居家隔離</option>
                      <option>建議檢疫</option>
                      <option selected>予以通知</option>
                      <option>不作行動</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="inputFullName4" class="form-label">信息模板</label>
                    <select id="inputDepartment" class="form-select">
                      <?php $db->announce_get_demo_list();} ?>
                    </select>
                  </div>

                  <!-- row 5 -->
                  <div class="col-md-6">
                    <label for="inputDepartment" class="form-label">發佈 部門或機構</label>
                    <select id="inputDepartment" class="form-select">
                      <option selected>疾控中心</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="col-12">
                    <button type="submit" name="submit" value="announce_post_relation" class="btn btn-success">Submit</button>
                  </div>
                </form>
              </div>
              <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
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
      xmlhttp.open("GET", "accounce_post.php?IDCID=" + idcid, true);
      xmlhttp.send();
    }
  }
  </script>
  <?php
}
?>
