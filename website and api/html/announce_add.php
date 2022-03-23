<div id="htmlContent">
<?php
require "DataBase.php";
$db = new DataBase();
$at = new Action();

if(isset($_POST['submit'])){
  if(isset($_FILES['accounce_add_demo_image_input']) && isset($_POST['accounce_add_demo_title_input']) && isset($_POST['accounce_add_demo_details_input']) && !empty($_FILES['accounce_add_demo_image_input']['name']) && !empty($_POST['accounce_add_demo_title_input']) && !empty($_POST['accounce_add_demo_details_input']) && $_FILES['accounce_add_demo_image_input']["error"] === UPLOAD_ERR_OK ){
    if ($db->dbConnect()) {
      $file = $_FILES['accounce_add_demo_image_input'];
      $title = $_POST['accounce_add_demo_title_input'];
      $details = $_POST['accounce_add_demo_details_input'];

      $upload_path = $at->announce_add_demo_image_to_server($file,"image");
      $path = $db->announce_add_demo_image_to_sql($upload_path);
      if ($db->announce_add_demo($title,$path,$details)) {
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'home';
        header("Location: http://$host$uri/$extra");
        exit;
      }
    } else echo "Error: Database connection";
  } else echo "All fields are required";
}

?>
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header custom-card-header">
          <h4>添加 訊息模板</h4>
        </div>
        <div class="card-body">
          <!--  <form class="row g-3"> -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="row announce_form-group">
              <div class="col col-md-3">
                <label for="accounce_add_demo_title" class=" form-control-label">Title</label>
              </div>
              <div class="col-12 col-md-9">
                <input type="text" id="accounce_add_demo_title" name="accounce_add_demo_title_input" placeholder="The Post Title" class="form-control" onchange="document.getElementById('accounce_demo_post_title').innerHTML = this.value;">
                <small class="form-text text-muted"></small>
              </div>
            </div>
            <div class="row announce_form-group">
              <div class="col col-md-3">
                <label for="accounce_add_demo_image" class=" form-control-label">Image</label>
              </div>
              <div class="col-12 col-md-9">
                <input accept="image/*" type="file" id="accounce_add_demo_image" name="accounce_add_demo_image_input" class="form-control-file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                <small class="form-text text-muted"></small>
              </div>
            </div>
            <div class="row announce_form-group">
              <div class="col col-md-3">
                <label for="accounce_add_demo_details" class=" form-control-label">Details</label>
              </div>
              <div class="col-12 col-md-9">
                <textarea id="accounce_add_demo_details" name="accounce_add_demo_details_input" rows="9" placeholder="The Post Content..." class="form-control" onchange="document.getElementById('accounce_demo_post_detail').innerHTML = this.value;"></textarea>
                <small class="form-text text-muted"></small>
              </div>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-success" name="submit" value="INSERT">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4">

      <div class="card">
          <div class="card-body">
              <blockquote class="blockquote mb-0">
                  <p>封面</p>
              </blockquote>
          </div>
      </div>

      <div class="card accounce_demo_post">
        <div class="card-header accounce_demo_header">
          <img src="announce_icon\68747470733a2f2f662e636c6f75642e6769746875622e636f6d2f6173736574732f353938343731392f313537363835312f38616137613866612d353136322d313165332d396163362d3536653261383264323565362e6a7067.jpg" alt="company_name" width="auto" height="40" class="custom-card-header-demo-icon">
          <strong class="custom-card-header-demo-title">Card Outline</strong>
          <p class="custom-card-header-demo-time">2 mins ago</p>
        </div>
        <img id="blah" class="" src="images/v-28-512.png" alt="Card image cap" width="100%" height="350px">
        <div class="card-body">
          <h4 class="card-title mb-3" id="accounce_demo_post_title">Card Image Title</h4>
          <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
        </div>
      </div>

      <div class="card">
          <div class="card-body">
              <blockquote class="blockquote mb-0">
                <p>內容</p>
              </blockquote>
          </div>
      </div>

      <div class="card">
          <div class="card-body">
              <blockquote class="blockquote mb-0">
                  <p id="accounce_demo_post_detail"></p>
              </blockquote>
          </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" id="contentScript">
</script>
