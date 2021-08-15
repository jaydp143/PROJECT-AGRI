<?php 
  require('./database.php');
  $no=$_SESSION['id'];
  $view_admin = mysqli_query($connection,"select * from tbl_users where id=$no ");
  $rowadm = mysqli_fetch_array($view_admin);
?>