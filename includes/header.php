<?php
require("configData.php");

if(isset($_COOKIE['Token'])){
  $token = $_COOKIE['Token'];
  if($token == "undefined"){
    setcookie("Token", "", time()-3600);
    header("Location: login");
  }
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => $APIurl.'/getLoginUserData',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
      'Authorization: Bearer '.$token
    ),
  ));
  
  $response = curl_exec($curl);
  curl_close($curl);
  $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $responseJSON = json_decode($response,true);
  if($http_status != 200){
    setcookie("Token", "", time()-3600);
    header("Location: login");
    exit();
  }

  $SchoolID = $responseJSON[0]['SchoolID'];
  $SchoolHeadName = $responseJSON[0]['SchoolHeadName'];
  $CurrentYear = $responseJSON[0]['CurrentYear'];
  $SchoolName = $responseJSON[0]['SchoolName'];
  $SchoolAddress = $responseJSON[0]['SchoolAddress'];

}else{
  header("Location: login");
  exit();
}

?>
<div id="cover-spin"></div>

<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>School</b> Admin</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <?php
      if($appMode != "PRODUCTION"){
        echo "<div class='testenv'>
                Test Environments
              </div>";
      }
      ?> 
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $SchoolHeadName; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $SchoolName; ?>
                  <small><?php echo $SchoolAddress; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
              </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $SchoolHeadName; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form" autocomplete="off">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="javascript:void(0)" onclick="window.open('index.php','_self')">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <!-- <li class="treeview">
          <a href="">
            <i class="fa fa-users"></i>
            <span>Students</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="AddStudents"><i class="fa fa-dot-circle-o"></i> Add Students</a></li>
            <li><a href="students"><i class="fa fa-dot-circle-o"></i> View Students</a></li>
          </ul>
        </li> -->
        <li class="treeview">
          <a href="javascript:void(0)" onclick="window.open('AddStudents','_self')">
            <i class="fa fa-users"></i>
            <span>Add Students</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="javascript:void(0)" onclick="window.open('students','_self')">
            <i class="fa fa-users"></i>
            <span>View Students</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="javascript:void(0)" onclick="window.open('teachers','_self')">
            <i class="fa fa-users"></i>
            <span>Teachers</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="javascript:void(0)" onclick="window.open('Classes','_self')">
            <i class="fa fa-graduation-cap"></i>
            <span>Classes</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-calendar"></i>
            <span>Examination</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="FillMarksSelectClass"><i class="fa fa-dot-circle-o"></i> Fill Marks</a></li>
            <li><a href=""><i class="fa fa-dot-circle-o"></i> Time-Table</a></li>
            <li><a href="CustomMarksheetList"><i class="fa fa-dot-circle-o"></i> Design Marksheets</a></li>
            <li><a href=""><i class="fa fa-dot-circle-o"></i> Print ResultSheet</a></li>
          </ul>
        </li> -->
        <li class="treeview">
          <a href="javascript:void(0)" onclick="window.open('FillMarksSelectClass','_self')">
            <i class="fa fa-list-ol"></i>
            <span>Fill Marks</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <!-- <li class="treeview">
          <a href="javascript:void(0)" onclick="window.open('CustomMarksheetList','_self')">
            <i class="fa fa-file-text"></i>
            <span>Design Marksheet</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cog"></i>
            <span>Setting</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li> -->
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <div>
    <input type="hidden" id="url" value="<?php echo $APIurl; ?>">
  </div>
<script>
  if(performance.navigation.type == 2){
   location.reload(true);
  }

  var Alert = undefined;

(function(Alert) {
  var alert, error, trash, info, success, warning, _container;
  info = function(message, title, options) {
    return alert("info", message, title, "fa fa-info-circle", options);
  };
  warning = function(message, title, options) {
    return alert("warning", message, title, "fa fa-warning", options);
  };
  error = function(message, title, options) {
    return alert("error", message, title, "fa fa-exclamation-circle", options);
  };

  trash = function(message, title, options) {
    return alert("trash", message, title, "fa fa-trash-o", options);
  };

  success = function(message, title, options) {
    return alert("success", message, title, "fa fa-check-circle", options);
  };
  alert = function(type, message, title, icon, options) {
    var alertElem, messageElem, titleElem, iconElem, innerElem, _container;
    if (typeof options === "undefined") {
      options = {};
    }
    options = $.extend({}, Alert.defaults, options);
    if (!_container) {
      _container = $("#alerts");
      if (_container.length === 0) {
        _container = $("<ul>").attr("id", "alerts").appendTo($("body"));
      }
    }
    if (options.width) {
      _container.css({
        width: options.width
      });
    }
    alertElem = $("<li>").addClass("alert").addClass("alert-" + type);
    setTimeout(function() {
      alertElem.addClass('open');
    }, 1);
    if (icon) {
      iconElem = $("<i>").addClass(icon);
      alertElem.append(iconElem);
    }
    innerElem = $("<div>").addClass("alert-block");
    //innerElem = $("<i>").addClass("fa fa-times");
    alertElem.append(innerElem);
    if (title) {
      titleElem = $("<div>").addClass("alert-title").append(title);
      innerElem.append(titleElem);
      
    }
    if (message) {
      messageElem = $("<div>").addClass("alert-message").append(message);
      //innerElem.append("<i class="fa fa-times"></i>");
      innerElem.append(messageElem);
      //innerElem.append("<em>Click to Dismiss</em>");
//      innerElemc = $("<i>").addClass("fa fa-times");

    }
    if (options.displayDuration > 0) {
      setTimeout((function() {
        leave();
      }), options.displayDuration);
    } else {
      innerElem.append("<em>Click to Dismiss</em>");
    }
    alertElem.on("click", function() {
      leave();
    });

    function leave() {
      alertElem.removeClass('open');
      alertElem.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function() {
        return alertElem.remove();
      });
    }
    return _container.prepend(alertElem);
  };
  Alert.defaults = {
    width: "",
    icon: "",
    displayDuration: 3000,
    pos: ""
  };
  Alert.info = info;
  Alert.warning = warning;
  Alert.error = error;
  Alert.trash = trash;
  Alert.success = success;
  return _container = void 0;

})(Alert || (Alert = {}));

this.Alert = Alert;

</script>

 


