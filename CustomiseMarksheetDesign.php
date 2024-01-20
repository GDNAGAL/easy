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
    #designCnt{
      border : 1px solid #999;
      margin-left:20px;
      margin-top:20px;
      background:white;
      box-sizing:border-box;
    }
    .designer{
      background-image: radial-gradient(#999 1px, transparent 0);
      background-size: 20px 20px;
    }
    #mainHeading{
      font-weight:bold;
    }
    #topSection{
      margin:0;
      display:flex;
    }
    .logos,.emp{
      /* border:1px solid #333; */
      width:200px;
    }
    #logo{
      margin-top:30px;
      margin-left:10px;
      margin-bottom:15px;
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php require("includes/header.php")?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content-header">
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-8">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
              <img src="custom/img/tree.png" width="40px" alt="">  
              Design Preview</h3>
              <input class="pull-right" style="width:100px;" min="1" max="10" value='5' step="1" id="rage" type="range"/>
              <span class="pull-right">Zoom :  &nbsp;</span>
            </div>
            <div class="box-body designer" style="overflow:scroll; max-height:75vh;">
              <div id="designCnt">
                <div id="topSection" style="text-align:center">
                  <div class="logos">
                    
                  </div>
                  <div style="width:calc(100% - 400px)">
                    <h1 id="mainHeading"><?php echo $SchoolName; ?></h1>
                    <h1 id="addressHeading"><?php echo $SchoolAddress; ?></h1>
                  </div>
                  <div class="emp"></div>
                </div>
                
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
              <img src="custom/img/tree.png" width="40px" alt="">  
              Properties</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label>Select Page Size :</label>
                <select class="form-control" id="pageSize">
                </select>
              </div>
              <div class="form-group">
                <label>Page Orientation :</label>
                <select class="form-control" id="otn">
                  <option value="P">Portrait</option>
                  <option value="L">Landscape</option>
                </select>
              </div>
              <div class="form-group">
                <label>Top Section Background Color :</label>
                <input type="color" value="#ffffff" class="form-control" id="topSectionBackground">
              </div>
              <div class="form-group">
                <label>School Name Font Size :</label>
                <select class="form-control" id="snamefontsize">
                  <option value="18">18px</option>
                  <option value="20">20px</option>
                  <option value="22">22px</option>
                  <option value="24">24px</option>
                  <option value="26">26px</option>
                  <option value="28">28px</option>
                  <option value="30">30px</option>
                  <option value="32">32px</option>
                  <option value="34">34px</option>
                  <option value="36">36px</option>
                  <option value="38">38px</option>
                  <option value="40">40px</option>
                  <option value="42">42px</option>
                  <option value="44">44px</option>
                  <option value="46">46px</option>
                  <option value="48">48px</option>
                  <option value="50" selected>50px</option>
                  <option value="52">52px</option>
                  <option value="54">54px</option>
                  <option value="56">56px</option>
                  <option value="58">58px</option>
                  <option value="60">60px</option>
                </select>
              </div>
              <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" id="showLogo" checked> Show Logo
                    </label>
                  </div>
              </div>
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
<script src="custom/js/CustomiseMarksheetDesign.js"></script>
<!-- page script -->

</body>
</html>
