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
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
   <!-- Select2 -->
<link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="custom/css/style.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
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
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php require("includes/header.php")?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content-header">
      <!-- <h1>
        Classes 
        <small>Details</small>
        <button class="btn btn-flat btn-success" id="createnewclass" style="float: right;">Add New Class</button>
      </h1> -->

    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-4">
          <div class="box">
            <div class="box-body">
              <form action="" method="POST" id="addTeacherForm" autocomplete="off">
                <h4 class="modal-title">Add Teacher</h4><br>
                <span class="text-danger" id="validationSpan"></span>
                <div class="form-group">
                  <input type="text" id="teacherNameInput" placeholder="Enter Teacher Name" class="form-control" name="teacherName">
                </div>
                <div class="form-group">
                  <input type="text" id="teacherDesignationInput" placeholder="Enter Designation" class="form-control" name="teacherDesignation">
                </div>
                <div class="form-group">
                  <input type="text" id="teacherMobileInput" placeholder="Enter Mobile No." class="form-control" name="teacherMobile">
                </div>
                  <button type="submit" id="" class="btn btn-primary">Add Teacher</button>
              </form>
            </div>
          </div>
        </div>


        <div class="col-md-8">
          <div class="box">
            <div class="box-body">
              <table id="class_table" class="table table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Class Name</th>
                  <th>Class Teacher</th>
                  <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="classRoomTableBody">
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
     

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php //require("includes/footer.php");?>
</div>
<!-- ./wrapper -->


<!-- Modal -->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <form action="" method="post" id="editclassform" autocomplete="off">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Update Class Name</h4>
              <div class="modal-body">
                <label>Class Name :</label>
                <input type="hidden" id="modal_class_Id" class="form-control" name="class_id">
                <input type="text" id="modal_class_name" class="form-control" name="class_name">
                <div class="form-group">
                  <label>Select Class :</label>
                  <select class="form-control select2" id="class_teacher_list" name="class_teacher" style="width: 100%;">
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" id="editclasssubmit" name="updateclass" class="btn btn-primary">Save Changes</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

        <!-- Modal End -->




<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>

<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="custom/js/teachers.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#ClassTeacherSelectBox').select2()
  })
</script>
</body>
</html>
