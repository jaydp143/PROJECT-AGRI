<?php 
  require('./pages/database.php');

  session_start();


  //if ($_SESSION['status'] == 'valid') {
    //pathTo('dashboard');
  //}
  //1. 1 corinthian 3:8- the one who plants and the one who waters crewarded in your oown effoorts..
  //2. efesian 2:10-god made us to do goood woorks.
 //3. psalm 1:1-7 god delights in you. if you putyour hope in god.
 //1 samuel 16:7
  if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
      $_SESSION['error'] = 'Please fill up all fields';
    } else {
      $queryValidate = "SELECT * FROM tbl_users WHERE username = '$username' AND password = md5('$password')";
      $sqlValidate = mysqli_query($connection, $queryValidate);
      $rowValidate = mysqli_fetch_array($sqlValidate);

      if (mysqli_num_rows($sqlValidate) > 0) {
        $_SESSION['status'] = 'valid';
        $_SESSION['success'] = 'Login successful';
        $_SESSION['username'] = $rowValidate['username'];
        $_SESSION['id']=$rowValidate['id'];
        $_SESSION['password']=$rowValidate['password'];
        $_SESSION['password_temp']=$rowValidate['password_temp'];
        $_SESSION['firstname']=$rowValidate['firstname'];
        $_SESSION['middlename']=$rowValidate['middlename'];
        $_SESSION['lastname']=$rowValidate['lastname'];
        $_SESSION['contact_no']=$rowValidate['contact_no'];
        $_SESSION['email']=$rowValidate['email'];
        $_SESSION['house_no']=$rowValidate['house_no'];
        $_SESSION['street']=$rowValidate['street'];
        $_SESSION['barangay']=$rowValidate['barangay'];
        $_SESSION['municipality']=$rowValidate['municipality'];
        $_SESSION['province']=$rowValidate['province'];
        $_SESSION['userlevel']=$rowValidate['userlevel'];
        //pathTo('dashboard');
      } 
      else {
        $_SESSION['status'] = 'invalid';
        $_SESSION['error'] = 'Please fill up all fields correctly';
      }
    }
  }
  header('location: index.php');
?>

