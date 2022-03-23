<?php
require "DataBaseConfig.php";
if (isset($_COOKIE["bypass"]) && $_COOKIE["bypass"] == "32767") {
  // code...
  setcookie("bypass","32767",time()+900);
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Ela Admin - HTML5 Admin Template</title>
      <meta name="description" content="Ela Admin - HTML5 Admin Template">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="apple-touch-icon" href="images/logop.svg">
      <link rel="shortcut icon" href="images/logop.svg">

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/home-cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/home-style.css">
      <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
      <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

      <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
      <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

      <!-- For FontAwesome Icon -->
      <script src="https://kit.fontawesome.com/afe58591e2.js" crossorigin="anonymous"></script>

      <script type="text/javascript">
      function getData(targetDivName, url) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", url+".php", true);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == XMLHttpRequest.DONE) {
                if (xmlhttp.status == 200) {
                  var content = document.createElement("div");
                  content.innerHTML = xmlhttp.responseText
                  var div = content.querySelector("#htmlContent");
                  var contentScript = content.querySelector("#contentScript");
                  var script = document.createElement("script");
                  script.textContent = contentScript.textContent;
                    document.getElementById(targetDivName).innerHTML = div.innerHTML;
                    document.body.appendChild(script);
                }
            }
        };
        xmlhttp.send();
      }
      </script>

      <style>
      #weatherWidget .currentDesc {
          color: #ffffff!important;
      }
      .traffic-chart {
          min-height: 335px;
      }
      #flotPie1  {
          height: 150px;
      }
      #flotPie1 td {
          padding:3px;
      }
      #flotPie1 table {
          top: 20px!important;
          right: -10px!important;
      }
      .chart-container {
          display: table;
          min-width: 270px ;
          text-align: left;
          padding-top: 10px;
          padding-bottom: 10px;
      }
      #flotLine5  {
           height: 105px;
      }

      #flotBarChart {
          height: 150px;
      }
      #cellPaiChart{
          height: 160px;
      }
      </style>
  </head>

  <body onload="getData('content','dashboard');">
      <!-- Left Panel -->
      <aside id="left-panel" class="left-panel">
          <nav class="navbar navbar-expand-sm navbar-default">
              <div id="main-menu" class="main-menu collapse navbar-collapse">
                  <ul class="nav navbar-nav">

                      <!-- menu-title -->
                      <li class="menu-title">用戶管理</li>

                      <!-- menu-itme -->
                      <li>
                          <a href="#" onclick="getData('content','user-add');"> <i class="menu-icon fas fa-2x fa-user-plus"></i>添加 新用戶</a>
                          <a href="#" onclick="getData('content','user-index');"> <i class="menu-icon fas fa-2x fa-user-edit"></i>查看 用戶</a>
                      </li>

                      <!-- menu-title -->
                      <li class="menu-title">部門管理</li>

                      <!-- menu-itme -->
                      <li>
                          <a href="#" onclick="getData('content','depm-add');"> <i class="menu-icon fas fa-2x fa-plus-square"></i>新增 部門</a>
                          <a href="#" onclick="getData('content','depm-index');"> <i class="menu-icon fas fa-2x fa-pen-square"></i>查看 部門</a>
                      </li>

                      <!-- menu-title -->
                      <li class="menu-title">部門及機構</li>

                      <!-- menu-itme -->
                      <li class="menu-item-has-children dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-2x fa-microscope fa-2x"></i>核酸檢測機構</a>
                          <ul class="sub-menu children dropdown-menu">
                            <li onclick="getData('content','Tornado');"><i class="fas fa-2x fa-users"></i><a href="#">查看預約狀態</a></li>
                            <li onclick="getData('content','Tornado');"><i class="fas fa-2x fa-edit"></i><a href="#">添加訂單</a></li>
                            <li onclick="getData('content','Tornado');"><i class="fas fa-2x fa-eye"></i><a href="#">檢查舊訂單</a></li>
                            <li onclick="getData('content','Tornado');"><i class="fas fa-2x fa-scroll"></i><a href="#">輸入報告</a></li>
                          </ul>
                      </li>
                      <li class="menu-item-has-children dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-2x fa-syringe fa-2x"></i>疫苗接種機構</a>
                          <ul class="sub-menu children dropdown-menu">
                            <li onclick="getData('content','Tornado');"><i class="fas fa-2x fa-users"></i></i><a href="#">查看預約狀態</a></li>
                            <li onclick="getData('content','Tornado');"><i class="fas fa-2x fa-table"></i><a href="#">Basic Table</a></li>
                            <li onclick="getData('content','Tornado');"><i class="fas fa-2x fa-table"></i><a href="#">Data Table</a></li>
                          </ul>
                      </li>
                      <li class="menu-item-has-children dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-2x fa-biohazard fa-2x"></i>衛生署 - 疾控中心</a>
                          <ul class="sub-menu children dropdown-menu">
                            <li onclick="getData('content','access_history');"><i class="menu-icon fas fa-2x fa-bullhorn"></i><a href="#">到訪記錄</a></li>
                            <li onclick="getData('content','announce_post');"><i class="menu-icon fas fa-2x fa-bullhorn"></i><a href="#">信息發佈</a></li>
                            <li onclick="getData('content','announce_list_post');"><i class="menu-icon fas fa-2x fa-bullhorn"></i><a href="#">信息發佈記錄</a></li>
                            <li onclick="getData('content','announce_view');"><i class="menu-icon fas fa-2x fa-th"></i><a href="#">檢視 訊息模板</a></li>
                            <li onclick="getData('content','announce_add');"><i class="menu-icon fas fa-2x fa-th"></i><a href="#">添加 訊息模板</a></li>
                          </ul>
                      </li>
                  </ul>
              </div><!-- /.navbar-collapse -->
          </nav>
      </aside>
      <!-- /#left-panel -->
      <!-- Right Panel -->
      <div id="right-panel" class="right-panel">
          <!-- Header-->
          <header id="header" class="header">
              <div class="top-left">
                  <div class="navbar-header">
                      <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                      <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
                      <a id="menuToggle" class="menutoggle"><i class="fas fa-bars"></i></a>
                  </div>
              </div>
              <div class="top-right">
                  <div class="header-menu">
                      <div class="header-left">
                          <button class="search-trigger"><i class="fas fa-search"></i></button>
                          <div class="form-inline">
                              <form class="search-form">
                                  <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                  <button class="search-close" type="submit"><i class="fas fa-close"></i></button>
                              </form>
                          </div>

                          <div class="dropdown for-notification">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-bell"></i>
                                  <span class="count bg-danger">3</span>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="notification">
                                  <p class="red">You have 3 Notification</p>
                                  <a class="dropdown-item media" href="#">
                                      <i class="fas fa-check"></i>
                                      <p>Server #1 overloaded.</p>
                                  </a>
                                  <a class="dropdown-item media" href="#">
                                      <i class="fas fa-info"></i>
                                      <p>Server #2 overloaded.</p>
                                  </a>
                                  <a class="dropdown-item media" href="#">
                                      <i class="fas fa-warning"></i>
                                      <p>Server #3 overloaded.</p>
                                  </a>
                              </div>
                          </div>

                          <div class="dropdown for-message">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-envelope"></i>
                                  <span class="count bg-primary">4</span>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="message">
                                  <p class="red">You have 4 Mails</p>
                                  <a class="dropdown-item media" href="#">
                                      <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                                      <div class="message media-body">
                                          <span class="name float-left">Jonathan Smith</span>
                                          <span class="time float-right">Just now</span>
                                          <p>Hello, this is an example msg</p>
                                      </div>
                                  </a>
                                  <a class="dropdown-item media" href="#">
                                      <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                                      <div class="message media-body">
                                          <span class="name float-left">Jack Sanders</span>
                                          <span class="time float-right">5 minutes ago</span>
                                          <p>Lorem ipsum dolor sit amet, consectetur</p>
                                      </div>
                                  </a>
                                  <a class="dropdown-item media" href="#">
                                      <span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
                                      <div class="message media-body">
                                          <span class="name float-left">Cheryl Wheeler</span>
                                          <span class="time float-right">10 minutes ago</span>
                                          <p>Hello, this is an example msg</p>
                                      </div>
                                  </a>
                                  <a class="dropdown-item media" href="#">
                                      <span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
                                      <div class="message media-body">
                                          <span class="name float-left">Rachel Santos</span>
                                          <span class="time float-right">15 minutes ago</span>
                                          <p>Lorem ipsum dolor sit amet, consectetur</p>
                                      </div>
                                  </a>
                              </div>
                          </div>
                      </div>

                      <div class="user-area dropdown float-right">
                          <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                          </a>

                          <div class="user-menu dropdown-menu">
                              <a class="nav-link" href="#"><i class="fas fa-user"></i>My Profile</a>

                              <a class="nav-link" href="#"><i class="fas fa-bell"></i>Notifications <span class="count">13</span></a>

                              <a class="nav-link" href="#"><i class="fas fa-cog"></i>Settings</a>

                              <a class="nav-link" href="#"><i class="fas fa-power-off"></i>Logout</a>
                          </div>
                      </div>

                  </div>
              </div>
          </header>
          <!-- /#header -->
          <!-- Content -->
          <div class="content">
              <!-- Animated -->
              <div id="content" class="animated fadeIn">
                  <!-- Widgets  -->
              </div>

              <!-- .animated -->
          </div>
          <!-- /.content -->
          <div class="clearfix"></div>
          <!-- Footer -->
          <footer class="site-footer">
              <div class="footer-inner bg-white">
                  <div class="row">
                      <div class="col-sm-6"> Copyright &copy; 2021 <a href="https://wen0750.club">wen0750</a> All Rights Reserved</div>
                      <div class="col-sm-6 text-right">Designed by <a href="https://wen0750.club"> Wilson WAN (WAN KA CHUEN)</a></div>
                  </div>
              </div>
          </footer>
          <!-- /.site-footer -->
      </div>
      <!-- /#right-panel -->

      <!-- Scripts -->
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
      <script src="assets/js/home-main.js"></script>

      <!--  Chart js -->
      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

      <!--Chartist Chart-->
      <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
      <script src="assets/js/init/weather-init.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
      <script src="assets/js/init/fullcalendar-init.js"></script>

      <!--Local Stuff-->
  </body>
</html>
<?php
}else {
  echo "Error";
}
?>
