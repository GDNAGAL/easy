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
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

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
      <h1>
        Subjects 
        <small>Details</small>
      </h1>
      
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <tr>
            <div class="box-header" >
              <div class="col-xs-10">
                  <select class="form-control select2" style="max-width:190px";>
                    <option>Select Class Category</option>
                    <option>Category A (PP3+ - 2nd)</option>
                    <option>Category B (3rd - 4th)</option>
                    <option>Category C (6th - 7th)</option>
                    <option>Category D (9th)</option>

                  </select>
                </div>

                  <button class="btn col-xs-2 btn-flat  btn-success" id="createnewclass" style="position:relative;float: right;" data-target="#addsubjectModal">Add New Subject</button>
             </div>
           </tr>


            <!-- /.box-header -->
            <div class="box-body">
              <table id="" class="table table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Subject Name</th>
                  <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>English</td>
                  <td class="text-center"><a href="" data-toggle="modal" data-target="#modal-default"><i class="fa fa-pencil"></i></a></td>
                </tr>
                </tbody>
              </table>
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
  <div class="modal fade" id="addsubjectModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <form action="" method="post" id="editclassform" autocomplete="off">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Subject</h4>
              </div>
              <form>
              <div class="modal-body">
                <label>Subject Name :</label>
                <input type="hidden" id="modal_class_Id" class="form-control" name="class_id">
                <input type="text" id="new_subject_name" class="form-control" name="class_name">
                <div class="form-group">
                <label>Select Group :</label>
                <select class="form-control select2" id="group_list" name="class_teacher" style="width: 100%;">
                   <option value="Group 1">Group 1</option>
                   <option value="Group 2">Group 2</option>
                   <option value="Group 3">Group 3</option>
                   <option value="Group 4">Group 4</option>
                </select>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                <button type="submit" id="newsubjectsubmit" name="updateclass" class="btn btn-primary">Save Changes</button>
                </form>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>



          <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Subject Name</h4>
              </div>
              <div class="modal-body">
                <input type="text" class="form-control" name="">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
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
<!-- page script -->
<!-- Assuming you have included jQuery before this script -->
<script type="text/javascript">
  $(document).ready(function() {
    $("#newsubjectsubmit").on("click", function(e) {
      e.preventDefault();
      var new_subject_name = $("#new_subject_name").val();
      var groupname = $("#group_list").val();

      $.ajax({
        url: "insert/insertnewsubject.php",
        type: "POST",
        data: { new_subject_name: new_subject_name, groupname: groupname },
        success: function(data) {
          if (data == '1') {
            alert("success");
            $('#addsubjectModal').modal('hide');
          } else {
            alert("failed");
          }
        }
      });
    });
  });
</script>

<script>
  $(function () {
    $('.select2').select2()
  })
</script>
<script>
$(function() {
  $('#createnewclass').click(function () {
    $('#addsubjectModal').modal('show');
  });
});
</script>

</body>
</html>
