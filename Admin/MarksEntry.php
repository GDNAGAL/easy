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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
    input[type="number"]{
  text-align: center;
  
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
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
        <small>PP 3+ Class</small>
      </h1>
      
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
            <!-- /.box-header -->
        <div class="box box-default">
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Hindi</a></li>
              <li><a href="#tab_2" data-toggle="tab">English</a></li>
              <li><a href="#tab_3" data-toggle="tab">Maths</a></li>
              <li><a href="#tab_3" data-toggle="tab">Sanskrit</a></li>
              <li><a href="#tab_4" data-toggle="tab">Science</a></li>
              <li><a href="#tab_4" data-toggle="tab">Social Science</a></li>
            </ul>
            <span style="color:red;">** Please Do Not Reload This Page</span>  
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                 <table class="table table-condensed">
          <tr>
            <th class="text-center" style="width:60px">Roll No.</th>
            <th style="width:250px">Student Name</th>
            <th style="width:100px" class="text-center">First Test<br>M.M.(50)</th>
            <th><button style="margin-left: 10px;" class="btn btn-flat btn-success">Save Changes</button></th>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-center">1001</td>
            <td>Rahul Kumar</td>
            <td><input type="number" class="form-control"></td>
            <td></td>
          </tr>

        </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                The European languages are members of the same family. Their separate existence is a myth.
                For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                in their grammar, their pronunciation and their most common words. Everyone realizes why a
                new common language would be desirable: one could refuse to pay expensive translators. To
                achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                words. If several languages coalesce, the grammar of the resulting language is more simple
                and regular than that of the individual languages.
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                like Aldus PageMaker including versions of Lorem Ipsum.
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
       
        <!-- /.box-body -->
      </div>

      <!-- /.box-header -->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php //require("includes/footer.php");?>
</div>
<!-- ./wrapper -->

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
<script src="dist/js/demo.js"></script>
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
