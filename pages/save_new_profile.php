<?php 

if (isset($_POST['update_user'])) {
  
  $id=$_POST['id'];
  // $username=$_POST['username'];
  $firstname=$_POST['firstname'];
  $middlename=$_POST['middlename'];
  $lastname=$_POST['lastname'];
  $contact_no=$_POST['contact_no'];
  $email=$_POST['email'];

  mysqli_query($connection,"UPDATE tbl_users SET firstname='".$firstname."', middlename='".$middlename."', lastname='".$lastname."', contact_no='".$contact_no."', email='".$email."' WHERE id='".$id."'");

  pathTo($pagename);
}

?>
 <!-- end of profile -->