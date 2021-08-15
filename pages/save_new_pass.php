<?php
    if(isset($_POST['update_pass']))
    {
      $id=$_POST['id'];
      $password=md5($_POST['password']);
      $password_temp=$_POST['password'];
     
    mysqli_query($connection,"UPDATE tbl_users SET password='$password', password_temp='$password_temp'where id='$id'");


     

       echo"
          <script type='text/javascript'>
          alert('Password Successfully Updated, Please Login Again');
          window.location.href = './logout.php';
          </script>
        ";
    
  }

?> 
<!-- end of update password -->