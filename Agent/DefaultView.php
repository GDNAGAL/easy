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
              <div style="display:inline-block">
                <h3 class="box-title">Subjects</h3>
                <h4 class="box-title" style="display:block;"><b style="color:#3c8dbc">ClassRoomGroup : </b><span id="ClassRoomGroupTitle"></span></h4>
              </div>
              <button type="button" id="addSubjectBtn" class="btn btn-success btn-flat pull-right" >Add Subject</button>
            </div>
            <div class="box-body">
              <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th>Subject Name</th>
                  <th class="text-center">Subject Type</th>
                  <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="subjectTable">
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Papers</h3>
              <button type="button" id="addPaperBtn" style="display:none" class="btn btn-success btn-flat pull-right">Add Paper</button>
            </div>
            <div class="box-body" id="paperTableBody">
              Select Subject To View Papers.
            </div>
          </div>
        </div>  
      </div>
    </section>
  </div>
</div>




<!-- Add Subject Modal -->
<div class="modal fade" id="addSubjectModal">
  <div class="modal-dialog">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Add Subjects</h3>
      </div>
      <div class="box-body">
        <form action="" method="POST" id="addSubjectForm" autocomplete="off">
          <div class="form-group">
            <input type="text" placeholder="Enter Subject Name" class="form-control" name="subjectName" required>
          </div>
          <div class="form-group">
            <select class="form-control" name="subjectTypeName" required>
              <option value="">Select Subject Type</option>
              <option value="1">Mandatory</option>
              <option value="2">Optional</option>
            </select>
          </div>
          <button type="submit" id="" class="btn btn-success btn-flat">Add Subject</button>
          <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Add Paper Modal -->
<div class="modal fade" id="addPaperModal">
  <div class="modal-dialog">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Add Exams</h3>
      </div>
      <div class="box-body">
        <form action="" method="POST" id="addPaperForm" autocomplete="off">
          <div class="form-group">
            <select id="ExamSelect" class="form-control" name="ExamID" required>

            </select>
          </div>
          <div class="form-group">
            <input type="hidden" id="setSubjectID" class="form-control" name="subjectIDName" required>
            <input type="text" placeholder="Enter Paper Name (In English)" class="form-control" name="paperName" required>
          </div>
          <div class="form-group">
            <input type="text" placeholder="परीक्षा का नाम (हिंदी में)" class="form-control" name="paperNameHindi" required>
          </div>
          <div class="form-group">
            <input type="number" placeholder="Maximun Marks" class="form-control" name="MaxMarksName" required>
          </div>
          <button type="submit" id="" class="btn btn-success btn-flat">Add Paper</button>
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
<script src="custom/js/DefaultView.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('.select2').select2()
  })
</script>
</body>
</html>
