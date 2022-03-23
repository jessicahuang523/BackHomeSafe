<div id="htmlContent">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header custom-card-header">
          <h4>Announcement Record</h4>
        </div>
        <div class="card-body">
          <?php
          require "DataBase.php";
          $db = new DataBase();

          if ($db->dbConnect()) {
            // code...
            $db->list_announce();
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" id="contentScript"></script>
