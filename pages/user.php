<?php 
    $pagename="ecosystem";
    require('./session.php'); 
    require('./database.php');
    require('./save_new_pass.php');
    require('./save_new_profile.php');
    require('./user_data.php');
?>

<?php 
  if (isset($_POST['btn_save'])) {
    
    $username = mysqli_real_escape_string($connection,$_POST['username']);
    $password = md5($_POST['password']);
    $password_temp = mysqli_real_escape_string($connection,$_POST['password']);
    $firstname = mysqli_real_escape_string($connection,$_POST['firstname']);
    $middlename = mysqli_real_escape_string($connection,$_POST['middlename']);
    $lastname = mysqli_real_escape_string($connection,$_POST['lastname']);
    $contact_no = $_POST['contact_no'];
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    // $house_no = mysqli_real_escape_string($connection,$_POST['house_no']);
    // $street = mysqli_real_escape_string($connection,$_POST['street']);
    // $barangay = mysqli_real_escape_string($connection,$_POST['barangay']);
    // $municipality = mysqli_real_escape_string($connection,$_POST['municipality']);
    // $province = mysqli_real_escape_string($connection,$_POST['province']);
    $userlevel = mysqli_real_escape_string($connection,$_POST['userlevel']);

    $check_username = mysqli_query($connection,"SELECT * FROM tbl_users WHERE username = '$username' ");

    if (mysqli_num_rows($check_username)>0) {
      echo"
      <script type='text/javascript'>
        alert('Username Already Exist ! ');
        open('user.php','_self');
      </script>
     ";
     

    }
    else{
    mysqli_query($connection,"INSERT INTO tbl_users (username, password, password_temp, firstname, middlename, lastname, contact_no, email, userlevel) VALUES ('$username', '$password', '$password_temp', '$firstname', '$middlename', '$lastname', '$contact_no', '$email','$userlevel')");


    echo"
      <script type='text/javascript'>
        alert('You Have Successfully Add a User');
        open('user.php','_self');
      </script>
     ";
  }
}
?>


<!-- changing of accounts-->
<?php
  if (isset($_POST['btn_change'])) {
    $id=$_POST['id'];
    $username = mysqli_real_escape_string($connection,$_POST['username']);
    //$password = md5($_POST['password']);
    //$password_temp = mysqli_real_escape_string($connection,$_POST['password']);
    $firstname = mysqli_real_escape_string($connection,$_POST['firstname']);
    $middlename = mysqli_real_escape_string($connection,$_POST['middlename']);
    $lastname = mysqli_real_escape_string($connection,$_POST['lastname']);
    $contact_no = $_POST['contact_no'];
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    // $house_no = mysqli_real_escape_string($connection,$_POST['house_no']);
    // $street = mysqli_real_escape_string($connection,$_POST['street']);
    // $barangay = mysqli_real_escape_string($connection,$_POST['barangay']);
    // $municipality = mysqli_real_escape_string($connection,$_POST['municipality']);
    // $province = mysqli_real_escape_string($connection,$_POST['province']);
    $userlevel = mysqli_real_escape_string($connection,$_POST['userlevel']);

    
    
    mysqli_query($connection,"UPDATE tbl_users SET username='$username', firstname='$firstname', middlename='$middlename', lastname='$lastname', contact_no='$contact_no', email='$email', userlevel='$userlevel' WHERE id='$id' ");
    pathTo('user');

  }
 ?>





<?php
if (isset($_POST['deleteBtn'])) 
{
    $no = $_POST['id'];
     mysqli_query($connection,"DELETE from tbl_users WHERE id='$no'");
     pathTo('user');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>USER MANAGEMENT</title>
  <?php
    require_once('links.php')
  ?>
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed">
<!-- Site wrapper -->
<div class="wrapper" >
  <!-- Navbar -->
  <?php
      require_once('header1.php')
    ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  
  <?php
    $set_up_nav_item="menu-open";
    $set_up_nav_link="active";
    $eco_set_up="active";
      require_once('sidebar.php')
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>USER MANAGEMENT</h1>
          </div>
          <div class="col-sm-4">
            <a  class="btn bg-gradient-info float-right" data-toggle="modal" data-target="#add_user_modal">
              <i class="fa fa-plus" aria-hidden="true"> </i> ADD NEW USER
            </a>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">  
                <div class="col-12">
                    <div class="table-responsive">
                    <table id="dataTables-example" class="table  table-striped table-sm " style="text-align:center; width:100%">
                        <thead style="background-color:#1B5E20;" class="text-light">
                        <tr>
                            <th >ID</th>
                            <th >USERNAME</th>
                            <th>FIRST NAME</th>
                            <th>MIDDLE NAME</th>
                            <th>LAST NAME</th>
                            <th>CONTACT NO.</th>
                            <th>EMAIL</th>
                            <th>USER TYPE</th>
                            <th >ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = mysqli_query($connection,"SELECT * FROM tbl_users");
                                while($row = mysqli_fetch_array($query)){
                                    
                                    
                            ?>  
                        <tr>
                        <td align=""><?php echo $row['id']; ?></td>
                        <td align="center"><?php echo $row['username']; ?></td>
                        <td align="center"><?php echo $row['firstname']; ?></td>
                        <td align="center"><?php echo $row['middlename']; ?></td>
                        <td align="center"><?php echo $row['lastname']; ?></td>
                        <td align="center"><?php echo $row['contact_no']; ?></td>
                        <td align="center"><?php echo $row['email']; ?></td>
                        <td align="center"><?php echo $row['userlevel']; ?></td>
                        <td align="center">
                                <div class="btn-group">
                                <form method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>                       
                                    <a href="#editModal<?php echo $row['id']; ?>" class="btn btn-info btn-sm" data-toggle="modal">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm"onclick="confirm_del();return false;" name="deleteBtn" id="deleteBtn" title="Delete User" id="Delete_id" >
                                    <i class="fas fa-trash"></i>
                                    </button>
                                    <script>
                                    function confirm_del()
                                    {
                                    if(confirm("Are you sure you want to delete?")==1){
                                        document.getElementById('deleteBtn').submit();
                                    }
                                    }
                                    </script>
                                </form> 
                                <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success">
                                        <h5 class="modal-title" id="exampleModalLabel">EDIT USER INFORMATION</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        <form method="POST">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <!-- select -->
                                                    <div class="form-group ">
                                                    <small>USERNAME</small>
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/> 
                                                    <input type="text" class="form-control" name="username"  value='<?php echo $row['username']; ?>'required>
                                                    </div>
                                                </div>           
                                                 
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                    <small>USER TYPE</small>
                                                    <select class="form-control" name="userlevel" <input type="hidden" name="id"   required>
                                                    <option value="<?php echo $row['userlevel']; ?>" ><?php echo $row['userlevel']; ?></option>
                                                    <option value="admin">ADMIN</option>
                                                    <option value="sub-admin">SUB-ADMIN</option>
                                                    </select>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <!-- select -->
                                                    <div class="form-group ">
                                                    <small>FIRST NAME</small>
                                                    <input type="text" class="form-control" name="firstname" <input type="hidden" name="id" value="<?php echo $row['firstname']; ?>"   required>
                                                    </div>
                                                </div>           
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <small>MIDDLE NAME</small>
                                                    <input type="text" class="form-control" name="middlename" <input type="hidden" name="id" value="<?php echo $row['middlename']; ?>"  required>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <small>LAST NAME</small>
                                                    <input type="text" class="form-control" name="lastname" <input type="hidden" name="id" value="<?php echo $row['lastname']; ?>"  required>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <!-- select -->
                                                    <div class="form-group ">
                                                    <small>CONTACT NO.</small>
                                                    <input type="text" class="form-control" name="contact_no" maxlength="11" <input type="hidden" name="id" value="<?php echo $row['contact_no']; ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                                                    </div>
                                                </div>           
                                                <div class="col-sm-7">
                                                    <div class="form-group">
                                                    <small>EMAIL</small>
                                                    <input type="email" class="form-control" name="email" <input type="hidden" name="id" value="<?php echo $row['email']; ?>" required>
                                                    </div>
                                                </div> 
                                                
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn bg-gradient-success" name="btn_change" >Save</button>
                                            
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        
                        </tr>
                        <?php
                                }
                        ?>

                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <?php
      require_once('footer.php')
    ?>
</div>
<!-- ./wrapper -->
<?php 
    //modals for editing
    require_once('change_pass.php'); 
    require_once('edit_profile.php'); 
?>

    <?php
        require_once('links_script.php');
    ?>
</body>
</html>

<div class="modal fade" id="add_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLabel">NEW USER INFORMATION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST">
        <div class="row">
            <div class="col-sm-5">
                <!-- select -->
                <div class="form-group ">
                <small>USERNAME</small>
                <input type="text" class="form-control" name="username" required>
                </div>
            </div>           
            <div class="col-sm-5">
                <div class="form-group">
                <small>PASSWORD</small>
                <input type="password" class="form-control" name="password" required>
                </div>
            </div> 
            <div class="col-sm-2">
                <div class="form-group">
                <small>USER TYPE</small>
                <select class="form-control" name="userlevel" required>
                <option></option>
                <option value="ADMIN">admin</option>
                <option value="SUB-ADMIN">sub-admin</option>
                </select>
                </div>
            </div> 
        </div>
        <div class="row">
            <div class="col-sm-4">
                <!-- select -->
                <div class="form-group ">
                <small>FIRST NAME</small>
                <input type="text" class="form-control" name="firstname" required>
                </div>
            </div>           
            <div class="col-sm-4">
                <div class="form-group">
                <small>MIDDLE NAME</small>
                <input type="text" class="form-control" name="middlename" required>
                </div>
            </div> 
            <div class="col-sm-4">
                <div class="form-group">
                <small>LAST NAME</small>
                <input type="text" class="form-control" name="lastname" required>
                </div>
            </div> 
        </div>
        <div class="row">
            <div class="col-sm-5">
                <!-- select -->
                <div class="form-group ">
                <small>CONTACT NO.</small>
                <input type="text" class="form-control" name="contact_no" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                </div>
            </div>           
            <div class="col-sm-7">
                <div class="form-group">
                <small>EMAIL</small>
                <input type="email" class="form-control" name="email" required>
                </div>
            </div> 
            
        </div>
      </div>
        <div class="modal-footer">
          <button type="submit" class="btn bg-gradient-success" name="btn_save" >Save</button>
          <button type="reset" class="btn bg-gradient-danger">Clear</button>
        </div>
      </form>
    </div>
  </div>
</div>