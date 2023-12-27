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
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
    input[type="text"]{
  text-transform: capitalize !important;
}

</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php require("includes/header.php")?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Fill Marks
        <small></small>
      </h1>
      
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
            <!-- /.box-header -->
      
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Select Class And Fill Marks</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body ">
              <table class="table table-condensed">
                <tr>
                  <th style="width: 20px">#</th>
                  <th style="width: 20%">Class</th>
                  <th style="width: 30%">Progress</th>
                  <th class="text-center" style="width: 40%">Select Examination</th>
                </tr>
                <tbody id='exambody'>

                </tbody>
                
               <!-- <tr>
                  <td>2.</td>
                  <td>PP 4+</td>
                  <td>
                    <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-danger" style="width: 90%"></div>
                    </div>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-primary btn-flat">1st Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">2nd Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">3rd Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">Half-Yearly</button>
                    <button class="btn btn-sm btn-primary btn-flat">Yearly</button>
                  </td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>PP 5+</td>
                  <td>
                    <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-danger" style="width: 90%"></div>
                    </div>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-primary btn-flat">1st Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">2nd Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">3rd Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">Half-Yearly</button>
                    <button class="btn btn-sm btn-primary btn-flat">Yearly</button>
                  </td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>First</td>
                  <td>
                    <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-danger" style="width: 90%"></div>
                    </div>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-primary btn-flat">1st Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">2nd Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">3rd Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">Half-Yearly</button>
                    <button class="btn btn-sm btn-primary btn-flat">Yearly</button>
                  </td>
                </tr>
                <tr>
                  <td>5.</td>
                  <td>Second</td>
                  <td>
                    <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-danger" style="width: 90%"></div>
                    </div>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-primary btn-flat">1st Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">2nd Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">3rd Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">Half-Yearly</button>
                    <button class="btn btn-sm btn-primary btn-flat">Yearly</button>
                  </td>
                </tr>
                <tr>
                  <td>6.</td>
                  <td>Third</td>
                  <td>
                    <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-danger" style="width: 30%"></div>
                    </div>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-primary btn-flat">1st Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">2nd Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">3rd Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">Half-Yearly</button>
                    <button class="btn btn-sm btn-primary btn-flat">Yearly</button>
                  </td>
                </tr>
                <tr>
                  <td>7.</td>
                  <td>Fourth</td>
                  <td>
                    <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-danger" style="width: 90%"></div>
                    </div>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-primary btn-flat">1st Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">2nd Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">3rd Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">Half-Yearly</button>
                    <button class="btn btn-sm btn-primary btn-flat">Yearly</button>
                  </td>
                </tr>
                <tr>
                  <td>8.</td>
                  <td>Sixth</td>
                  <td>
                    <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-danger" style="width: 0%"></div>
                    </div>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-primary btn-flat">1st Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">2nd Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">3rd Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">Half-Yearly</button>
                    <button class="btn btn-sm btn-primary btn-flat">Yearly</button>
                  </td>
                </tr>
                <tr>
                  <td>9.</td>
                  <td>Seventh</td>
                  <td>
                    <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-danger" style="width: 90%"></div>
                    </div>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-primary btn-flat">1st Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">2nd Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">3rd Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">Half-Yearly</button>
                    <button class="btn btn-sm btn-primary btn-flat">Yearly</button>
                  </td>
                </tr>
                <tr>
                  <td>10.</td>
                  <td>Eighth</td>
                  <td>
                    <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-danger" style="width: 90%"></div>
                    </div>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-primary btn-flat">1st Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">2nd Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">3rd Test</button>
                    <button class="btn btn-sm btn-primary btn-flat">Half-Yearly</button>
                    <button class="btn btn-sm btn-primary btn-flat">Yearly</button>
                  </td>
                </tr> -->
              </table>
            </div>
            <!-- /.box-body -->
          </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php //require("includes/footer.php");?>
</div>
<!-- ./wrapper -->


<!-- Modal -->
<div class="modal fade rounded" id="addExamModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <form action="" method="post" id="addExamForm" autocomplete="off">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add Exam</h4><br>
                <label>Enter Exam Name :</label>
                <input type="hidden" id="classId" class="form-control" placeholder="Enter Class Room" name="ClassRoomID">
                <input type="text" id="modal_exam_name" class="form-control" placeholder="Enter Exam Name" name="exam_name" required><br>
              <div>
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
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="custom/js/FillMarksSelectClass.js"></script>
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- page script -->

<script>
  $(function () {
    $('.select2').select2()
  })
  //Date picker
  $('#datepicker').datepicker({
      autoclose: true
    })
</script>
</body>
</html>
