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
   <!-- DataTables -->
   <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="custom/css/style.css">
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
      z-index: 2;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php require("includes/header.php")?>

  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">ClassRooms</h3>
              <button type="button" id="addClassRoomGroupBtn" class="btn btn-success btn-flat pull-right" style="margin-left:10px">Add Class Room Group</button> 
              <button type="button" id="addClassRoomBtn" class="btn btn-success btn-flat pull-right" >Add Class Room</button>
            </div>
            <div class="box-body">
              <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th>Class Room Name</th>
                  <th class="text-center">Class Room Group</th>
                  <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="classRoomTable">
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Exams</h3>
              <button type="button" id="addExamModalBtn" class="btn btn-success btn-flat pull-right">Add Exam</button>
            </div>
            <div class="box-body">
              <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th>Exam Name</th>
                  <th class="text-center">Exam Name in Hindi</th>
                  <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="examTable">
                </tbody>
              </table>
            </div>
          </div>
        </div>  
      </div>
    </section>
  </div>
</div>




<!-- Add classRoomGroup Modal -->
<div class="modal fade" id="addClassRoomGroupModal">
  <div class="modal-dialog">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Add Class Room Group</h3>
      </div>
      <div class="box-body">
        <form action="" method="POST" id="addClassRoomGroupForm" autocomplete="off">
          <div class="form-group">
            <input type="text" placeholder="Enter ClassRoom Group Name" class="form-control" name="classRoomGroupName" required>
          </div>
          <button type="submit" id="" class="btn btn-success btn-flat">Add ClassRoom Group</button>
          <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Add classRoom Modal -->
<div class="modal fade" id="addClassRoomModal">
  <div class="modal-dialog">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Add Class Room</h3>
      </div>
      <div class="box-body">
        <form action="" method="POST" id="addClassRoomForm" autocomplete="off">
          <div class="form-group">
            <select class="form-control" id="classRoomGroupSelectBox" name="classRoomNameGroupName" required>
              <option value="">Select ClassRoom Group</option>
            </select>
          </div>
          <div class="form-group">
            <input type="text" placeholder="Enter ClassRoom Name" class="form-control" name="classRoomName" required>
          </div>
          <button type="submit" id="" class="btn btn-success btn-flat">Add ClassRoom</button>
          <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Add classRoom Modal -->
<div class="modal fade" id="addExamModal">
  <div class="modal-dialog">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Add Exams</h3>
      </div>
      <div class="box-body">
        <form action="" method="POST" id="addExamForm" autocomplete="off">
          <div class="form-group">
            <input type="text" placeholder="Enter Exam Name (In English)" class="form-control" name="examName" required>
          </div>
          <div class="form-group">
            <input type="text" placeholder="परीक्षा का नाम (हिंदी में)" class="form-control" name="examNameHindi" required>
          </div>
          <button type="submit" id="" class="btn btn-success btn-flat">Add Exam</button>
          <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
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
<script src="custom/js/Defaults.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('.select2').select2()
  })
</script>
</body>
</html>
