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
   <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"> -->
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
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php require("includes/header.php")
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content-header">
      <h1>
        Student 
        <small>Data</small>
      </h1>
     
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
            <!-- /.box-header -->

            <div class="box-body">
               <div class="form-group">
                <select class="form-control select2" id="selectclass" style="width: 20%;">
                  <option value="" selected>Select Class</option>
                  <option value="all">All Classes</option>

                </select>
               </div>
              <table id="studenttable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Class</th>
                  <th>Roll No.</th>
                  <th>Admission No.</th>
                  <th>Student Name</th>
                  <th>Father Name</th>
                  <th>Mother Name</th>
                  <th>Date of Birth</th>
                  <th>Gender</th>
                  <th>Category</th>
                  <th>Mobile</th>
                  <th>Aadhar No.</th>
                </tr>
                </thead>
                <tbody>
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
<script src="custom/data.js"></script>
<!-- page script -->
<script>

 $( document ).ready(function() {
  getstudents("all")
  $(function () {
    $('.select2').select2()
  })

  var table = $('#studenttable').DataTable();

$('#selectclass').on('change', function(){
   var table = $('#studenttable').DataTable();
   //clear datatable
   table.clear().draw();
   //destroy datatable
   table.destroy();
   //call funtion for get student data from database
   getstudents($(this).val())
})

//function for get data from database
function getstudents(cls){
const dataa = {cls : cls};
$.ajax({
    "url": "getData/get_Students.php",
    "type": "POST",
    "data": dataa,
    "datatype": 'json',
    "async": false,
    "success": function (data) {
        //console.log(data)
       if (data == 'null') {
        var table = $('#studenttable').DataTable();
          return ;
       }else{

         data = JSON.parse(data);  // Parse the JSON strin
         var table = $('#studenttable').DataTable({
           data: data.data,  // Get the data object
           retrieve: true,
           destroy: true,
           columns: [
             { 'data': 'class_name' },
             { 'data': 'rollno' },
             { 'data': 'admissionno' },
             { 'data': 'student_name',
              "render": function ( data, type, row, meta ) {
                return '<a href="">'+data+'</a>';
              } 
            },
            { 'data': 'father_name' },
            { 'data': 'mother_name' },
            { 'data': 'dateofbirth' },
            { 'data': 'gender' },
            { 'data': 'category' },
            { 'data': 'mobile' },
            { 'data': 'aadhar' },
            
            
          ]
        })
      }
}
})
}
})
</script>
</body>
</html>
