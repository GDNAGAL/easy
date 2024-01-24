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
  <link rel="stylesheet" href="custom/css/style.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
    input[type="text"]{
  text-transform: capitalize !important;
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
          Add New Student 
          <small>New Admission</small>
        </h1>
        
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <!-- /.box-header -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Basic Information</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-8">
                <!-- <div class="row"> -->
                <form action="" method="post" id="addstudentform" autocomplete="off">
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Select Class :</label>
                          <select class="form-control select2" id="selectclass" style="width: 100%;" name="studentclass" required>
                            <option selected="selected" value="">Select Class</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Admission No. :</label>
                          <input type="text" class="form-control" placeholder="Enter Admission No." name="adno" required>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                        <label>Student Name :</label>
                        <input type="text" class="form-control" placeholder="Enter Student Name" name="studentname" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                        <label>Father Name :</label>
                        <input type="text" class="form-control"  placeholder="Enter Father Name" name="fathername" required>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                        <label>Mother Name :</label>
                        <input type="text" class="form-control"  placeholder="Enter Mother Name" name="mothername" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Date of Birth :</label>
                          <div class="input-group date">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" class="form-control pull-right" id="datepicker" name="dob" required>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Roll No. :</label>
                          <input type="number" class="form-control" placeholder="Enter Roll Number" name="rollno" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Select Gender :</label>
                          <select class="form-control select2" id="genderSelectBox" style="width: 100%;" name="gender" required>
                            <option selected="selected" value="">Select Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Catagory :</label>
                          <select class="form-control select2" id="categorySelectBox" style="width: 100%;" name="category">
                            <option selected="selected" value="">Select Catagory</option>
                            <option>Genral</option>
                            <option>OBC</option>
                            <option>SC</option>
                            <option>ST</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Address :</label>
                          <input type="text" class="form-control" placeholder="Enter Address" name="address">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Mobile Number :</label>
                          <input type="number" class="form-control" placeholder="Enter Mobile Number" name="mobile">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Aadhar Number :</label>
                          <input type="number" class="form-control" placeholder="Enter Aadhar Number" name="aadhar">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <button class="btn btn-primary" name="addstudent" id="addstudent">Save Information</button>
                      </div>
                    </div>

                </form>
              </div>

              <div class="col-md-4">
              <div class="box-header with-border">
                <h3 class="box-title">
                <i class="fa fa-upload"></i>  &nbsp;
                Upload Student File</h3>
              </div>
              </div>
            </div>
            
          </div>
          <!-- /.box-body -->
        </div>
              
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
<script src="custom/js/addStudent.js"></script>
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
