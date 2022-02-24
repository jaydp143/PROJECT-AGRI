<?php 
  session_start();

  function pathTo($destination) {
    echo "<script>window.location.href = './pages/$destination.php'</script>";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RCMS-PAG</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" style="background-color:#9CCC65;">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-success ">
    <div class="card-header text-center bg-success">
    <img src="dist/img/pang.png" alt="Pangasinan Logo"  width="50" height="50" class="d-inline-block" alt="">
    <br>
      <a href="dashboard.php" class="h5">PROVINCIAL AGRICULTURE OFFICE</a>
      <br>
      <a href="dashboard.php" class="h6">Rice Crop Monitoring System</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form class="user" role="form" name="login_form" method="POST" action="login.php">
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="username_id" name="username" placeholder="Username">
          <div class="input-group-append ">
            <div class="input-group-text bg-success">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password_id" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text bg-success">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-success btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <?php
				if(isset($_SESSION['error'])){
					?>
					<div class="alert alert-danger text-center" role="alert" style="margin-top:20px;">
						<?php echo $_SESSION['error']; ?>
					</div>
					<?php
					unset($_SESSION['error']);
				}

				if(isset($_SESSION['success'])){
					?>
					<div class="alert alert-success text-center" style="margin-top:20px;">
						<?php echo $_SESSION['success']; 
            pathTo('dashboard');
            ?>
					</div>
					<?php

					unset($_SESSION['success']);
				}
			?>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
