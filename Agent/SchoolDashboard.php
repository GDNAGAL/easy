<?php 
$schoolID = $_GET['schoolID'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
  <link rel="icon" type="icon" sizes="16x16" href="icons/favicon.ico">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="custom/css/style.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
    table, td{
      /* border : 1px solid #999; */
      padding:4px;
    }
    td{
      background:#f5eeed;
    }
    tr{
      border : 4px solid white;
      border-radius:5px;
    }
    .scard{
      display:inline-block;
      padding:2px 5px;
      margin: 3px;
      border-radius:5px;
      color:white;
      font-size:10px;
      font-weight:bold;
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php require("includes/header.php")?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-4">
          <div class="box box-primary">
            <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="../dist/img/user4-128x128.png" alt="User profile picture">
              <br>
              <input type="hidden" value="<?php echo $schoolID;?>" id='schoolinputId'/> 
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>School Name</b> <a class="pull-right" id="idSchoolName"></a>
                </li>
                <li class="list-group-item">
                  <b>Head Master </b> <a class="pull-right" id="idHMName"></a>
                </li>
                <li class="list-group-item">
                  <b>Mobile</b> <a class="pull-right" id="idMobile"></a>
                </li>
                <li class="list-group-item">
                  <b>Address</b> <a class="pull-right" id="idAddress"></a>
                </li>
                <li class="list-group-item">
                  <b>School Status</b> <span class="pull-right" id="sstatus"></span>
                  <input type="hidden" id="url" value="<?php echo $url; ?>">
                </li>
                <li class="list-group-item" id="lbtn">
                  
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-8">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#initialSteps" data-toggle="tab">Account Activation</a></li>
              <li><a href="#settings" data-toggle="tab">Profile Settings</a></li>
            </ul>


            <div class="tab-content">


              <div class="active tab-pane" id="initialSteps">
                <ul class="timeline timeline-inverse">
                  <li>
                    <i id="classStatusLogo" class="fa fa-clock-o bg-red"></i>

                    <div class="timeline-item" style='background:none;border:none;'>
                    <div class="box box-danger collapsed-box" id="classBox">
                      <div class="box-header with-border" data-widget="collapse" style="cursor:pointer">
                        <h3 class="timeline-header box-title"><a id="classHeading" class="text-red" href="javascript:void(0)">ClassRooms</a></h3>
                        <span class="time pull-right text-red" id="classStatusIcon"><i class="fa fa-clock-o"></i> Pending</span>
                      </div>
                      <div class="box-body timeline-body" id="classlist" style="overflow-x:scroll"></div>
                      </div> 
                    </div>
                  </li>
                  <li>
                    <i id="subjectStatusLogo" class="fa fa-clock-o bg-red"></i>

                    <div class="timeline-item" style='background:none;border:none;'>
                    <div class="box box-danger collapsed-box" id="subjectBox">
                      <div class="box-header with-border" data-widget="collapse" style="cursor:pointer">
                        <h3 class="timeline-header box-title"><a id="subjectHeading" class="text-red" href="javascript:void(0)">Subjects</a></h3>
                        <span class="time pull-right text-red" id="subjectStatusIcon"><i class="fa fa-clock-o"></i> Pending</span>
                      </div>
                      <div class="box-body timeline-body" id="Subjectlist"></div>
                      </div> 
                    </div>
                  </li>
                  <li>
                    <i id="examStatusLogo" class="fa fa-clock-o bg-red"></i>

                    <div class="timeline-item" style='background:none;border:none;'>
                      <div class="box box-danger collapsed-box" id="examBox">
                        <div class="box-header with-border" data-widget="collapse" style="cursor:pointer">
                          <h3 class="timeline-header box-title"><a id="examHeading" class="text-red" href="javascript:void(0)">Exams Details</a></h3>
                          <span class="time pull-right text-red" id="examStatusIcon"><i class="fa fa-clock-o"></i> Pending</span>
                        </div>

                        <div class="box-body timeline-body" id="examlist"></div>
                      </div> 
                    </div>
                  </li>
                  <li>
                    <i id="activateAccountStatusLogo" class="fa fa-clock-o bg-red"></i>

                    <div class="timeline-item" style='background:none;border:none;'>
                      <div class="box box-danger collapsed-box" id="activateAccountBox">
                        <div class="box-header with-border" data-widget="collapse" style="cursor:pointer">
                          <h3 class="timeline-header box-title"><a id="activateAccountHeading" class="text-red" href="javascript:void(0)">Activate Account</a></h3>
                          <span class="time pull-right text-red" id="activateAccountStatusIcon"><i class="fa fa-clock-o"></i> Pending</span>
                        </div>

                        <div class="box-body timeline-body" id="activateAccountlist"></div>
                      </div> 
                    </div>
                  </li>
                  <li>
                    <i id="finalStatusLogo" class="fa fa-clock-o bg-red"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" id="updateSchoolForm" autocomplete="off">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">School Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="schoolName" placeholder="School Name" name="SchoolName">
                      <input type="hidden" class="form-control" id="sid" name="SchoolID">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">School Address</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="schoolAddress" placeholder="School Address" name="SchoolAddress">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Principal Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="principal" placeholder="Principal Name" name="SchoolHeadName">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Mobile No.</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="headmobile" placeholder="School Mobile No." name="SchoolHeadMobile">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">School Status</label>

                    <div class="col-sm-10">
                      <select class="form-control" id="statusSelect"  name="SchoolStatus"></select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">User Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="username" placeholder="Username" name="SchoolUserName">
                      <span id="validateusername"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="password" placeholder="Password" name="SchoolPassword">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" id="updatebtn" class="btn btn-danger">Update School</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
      </div>
     

    </section>
  </div>
</div>



<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>

<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="custom/js/schoolDashboard.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#ClassTeacherSelectBox').select2()
  })
</script>
</body>
</html>
