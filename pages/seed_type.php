<?php   
    $pagename="seed_type";
    require('./session.php'); 
    require('./database.php');
    require('./save_new_pass.php');
    require('./save_new_profile.php');
    require('./user_data.php');
?>

<!-- add new item -->
<?php
  if (isset($_POST['btn_save'])) {
    $seedType =mysqli_real_escape_string($connection,$_POST['seedType']);
   

    $same_data = mysqli_query($connection,"SELECT * FROM tbl_seed_type WHERE seed_type = '$seedType'");

    if (mysqli_num_rows($same_data)>0) {

        pathTo('seed_type');   

    }
    else{

  mysqli_query($connection,"INSERT INTO tbl_seed_type (seed_type) VALUES ('$seedType')");

  pathTo('seed_type');
  }
}

?>


<!-- changing of accounts-->
<?php
  if (isset($_POST['btn_change'])) {
    $id=$_POST['id'];
    $seed_type =$_POST['seed_type'];
    
    
    mysqli_query($connection,"UPDATE tbl_seed_type SET seed_type='$seed_type' WHERE seed_type_id='$id' ");
    pathTo('seed_type');

  }
 ?>






<?php
if (isset($_POST['deleteBtn'])) 
{
    $no = $_POST['id'];
     mysqli_query($connection,"DELETE from tbl_seed_type WHERE seed_type_id='$no'");
     pathTo('seed_type');
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SEED TYPES</title>
  <?php
    require_once('links.php')
  ?>
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
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
      $sdt_set_up="active";
      require_once('sidebar.php')
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>LIST OF SEED TYPES</h1>
          </div>
          <div class="col-sm-4">
            <a href="add_harvest_accomplishment.php" class="btn btn-sm bg-gradient-info float-right" data-toggle="modal" data-target="#addSeedTypeModal">
              <i class="fa fa-plus" aria-hidden="true"> </i> ADD SEED TYPE
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
                    <th >DESCRIPTION</th>
                    <th >ACTIONS</th>
                   
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $query = mysqli_query($connection,"SELECT * FROM tbl_seed_type");
                        while($row = mysqli_fetch_array($query)){
                            
                            
                    ?>  
                  <tr>
                  <td align="center"><?php echo $row['seed_type_id']; ?></td>
                  <td align="center"><?php echo $row['seed_type']; ?></td>
                  <td align="center">
                        <div class="btn-group">
                          <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['seed_type_id']; ?>"/>                       
                            <a href="#editModal<?php echo $row['seed_type_id']; ?>" class="btn btn-info btn-sm" data-toggle="modal">
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
                          <div class="modal fade" id="editModal<?php echo $row['seed_type_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header bg-success">
                                  <h5 class="modal-title" id="exampleModalLabel">EDIT SEED TYPE</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                <form method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['seed_type_id']; ?>"/>    
                                <div class="form-group">
                                  <label>SEED TYPE: </label>
                                  <input type="text" name="seed_type"  class="form-control" value="<?php echo $row['seed_type'] ?>" required />
                                </div>


                                </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn bg-gradient-success" name="btn_change" >Save</button>
                                    <button type="reset" class="btn bg-gradient-danger">Clear</button>
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

<div class="modal fade" id="addSeedTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLabel">ADD NEW SEED TYPE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST">

      <div class="form-group">
        <label>SEED TYPE: </label>
        <input type="text" name="seedType"  class="form-control" required />
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
