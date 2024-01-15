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
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-8">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#initialSteps" data-toggle="tab">Account Activation</a></li>
              <li><a href="#activity" data-toggle="tab">Timeline</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Shared publicly - 7:30 PM today</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore the hate as they create awesome
                    tools to help create filler text for everyone from bacon lovers
                    to Charlie Sheen fans.
                  </p>
                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        (5)</a></li>
                  </ul>

                  <input class="form-control input-sm" type="text" placeholder="Type a comment">
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Ross</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Sent you a message - 3 days ago</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore the hate as they create awesome
                    tools to help create filler text for everyone from bacon lovers
                    to Charlie Sheen fans.
                  </p>

                  <form class="form-horizontal">
                    <div class="form-group margin-bottom-none">
                      <div class="col-sm-9">
                        <input class="form-control input-sm" placeholder="Response">
                      </div>
                      <div class="col-sm-3">
                        <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Adam Jones</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Posted 5 photos - 5 days ago</span>
                  </div>
                  <!-- /.user-block -->
                  <div class="row margin-bottom">
                    <div class="col-sm-6">
                      <img class="img-responsive" src="../../dist/img/photo1.png" alt="Photo">
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-6">
                          <img class="img-responsive" src="../../dist/img/photo2.png" alt="Photo">
                          <br>
                          <img class="img-responsive" src="../../dist/img/photo3.jpg" alt="Photo">
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                          <img class="img-responsive" src="../../dist/img/photo4.jpg" alt="Photo">
                          <br>
                          <img class="img-responsive" src="../../dist/img/photo1.png" alt="Photo">
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->

                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        (5)</a></li>
                  </ul>

                  <input class="form-control input-sm" type="text" placeholder="Type a comment">
                </div>
                <!-- /.post -->
              </div>
              <div class="active tab-pane" id="initialSteps">
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <!-- <li class="time-label">
                        <span class="bg-green">
                          Complete Below Steps 
                        </span>
                  </li> -->
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i id="classStatusLogo" class="fa fa-clock-o bg-red"></i>

                    <div class="timeline-item" style='background:none;border:none;'>
                    <div class="box box-danger collapsed-box" id="classBox">
                      <div class="box-header with-border" data-widget="collapse" style="cursor:pointer">
                        <h3 class="timeline-header box-title"><a id="classHeading" class="text-red" href="javascript:void(0)">ClassRooms</a></h3>
                        <span class="time pull-right text-red" id="classStatusIcon"><i class="fa fa-clock-o"></i> Pending</span>
                      </div>
                      <div class="box-body timeline-body" id="classlist"></div>
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
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
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
