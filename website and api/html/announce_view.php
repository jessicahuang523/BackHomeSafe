<div id="htmlContent">
  <div class="row">
    <?php
    require "DataBase.php";
    $db = new DataBase();
    $at = new Action();

    if ($db->dbConnect()) {
      $db->announce_list_all_demo();
    }

    ?>

    <!-- <div class="col-md-3">
      <div class="card accounce_demo_post">
        <div class="card-header accounce_demo_header">
          <img src="announce_icon\68747470733a2f2f662e636c6f75642e6769746875622e636f6d2f6173736574732f353938343731392f313537363835312f38616137613866612d353136322d313165332d396163362d3536653261383264323565362e6a7067.jpg" alt="company_name" width="auto" height="40" class="custom-card-header-demo-icon">
          <strong class="custom-card-header-demo-title">Card Outline</strong>
          <p class="custom-card-header-demo-time">2 mins ago</p>
        </div>
        <img class="" src="https://i.imgur.com/ue0AB6J.png" alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title mb-3">Card Image Title</h4>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="accounce_demo_post_content">
          <button type="button" class="btn btn-primary accounce_demo_post_content_btn">檢視</button>
          <button type="button" class="btn btn-success accounce_demo_post_content_btn">修改</button>
          <button type="button" class="btn btn-danger accounce_demo_post_content_btn">刪除</button>
        </div>
      </div>
    </div> -->
  </div>
</div>
<script src="assets/js/announce.js" id="contentScript"></script>
