<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>School Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
  input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}</style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="login-box-body">
  <div class="login-logo">
    <b>School </b>Log In
  </div>
    <form action="" id="login_form" method="post">
      <span id="validate" style="color:red"></span>
      <div class="form-group has-feedback">
        <input type="number" autocomplete="off" class="form-control" id="username" placeholder="Mobile No." name="username">
        <span class=" glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group">
                  <select class="form-control select2" id="session_year" name="session_year">
                    <option>Select Session--</option>
                  </select>
                </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        <a href="#">Reset Password</a>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id="login_submit" class="btn btn-primary btn-block btn-flat" name="login">Log In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="custom/login.js"></script>
<script>
  $(function () {
    $('.select2').select2();
  });
</script>
</body>
</html>
