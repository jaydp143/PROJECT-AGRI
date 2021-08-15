<?php  
    $pagename="seed";
    require('./session.php'); 
    require('./database.php');
    require('./save_new_pass.php');
    require('./save_new_profile.php');
    require('./user_data.php');
?>
<!-- add new item -->
<!-- add new item -->
<?php
  if (isset($_POST['btn_save'])) {
    $seed =mysqli_real_escape_string($connection,$_POST['seed']);
    $seedType =$_POST['seedType'];

    $same_data = mysqli_query($connection,"SELECT * FROM tbl_seed WHERE seed_description = '$seed' AND seed_type_id='$seedType'");

    if (mysqli_num_rows($same_data)>0) {

        echo "
        
    <script type='text/javascript'>
    alert('Account Already Exist!');
    window.location.href = 'seed.php';
    </script>";   

    }
    else{

  mysqli_query($connection,"INSERT INTO tbl_seed (seed_description, seed_type_id) VALUES ('$seed', '$seedType')");
  pathTo('seed');
  }
}
?>

<!-- changing of accounts-->
<?php
  if (isset($_POST['btn_change'])) {
    $id=$_POST['id'];
    $seed_description =$_POST['seed_description'];
    $seed_type_id=$_POST['seed_type_id'];
    
    mysqli_query($connection,"UPDATE tbl_seed SET seed_description='$seed_description', seed_type_id='$seed_type_id' WHERE seed_id='$id' ");
    pathTo('seed');

  }
 ?>

<?php
if (isset($_POST['deleteBtn'])) 
{
    $no = $_POST['id'];
     mysqli_query($connection,"DELETE from tbl_seed WHERE seed_id='$no'");
     pathTo('seed');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SEED</title>
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
      $sd_set_up="active";
      require_once('sidebar.php')
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>LIST OF SEEDS</h1>
          </div>
          <div class="col-sm-4">
            <a href="add_harvest_accomplishment.php" class="btn btn-sm bg-gradient-info float-right" data-toggle="modal" data-target="#addSeedModal" >
              <i class="fa fa-plus" aria-hidden="true"> </i> ADD SEED
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
                        <table id="dataTables-example" class="table table-striped table-sm " style="text-align:center; width:100%">
                        <thead style="background-color:#1B5E20;" class="text-light">
                        <tr>
                        <th >ID</th>
                        <th >DESCRIPTION</th>
                        <th >SEED TYPE</th>
                        <th >ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = mysqli_query($connection,"SELECT sd.seed_type_id, sd.seed_id, sd.seed_description, st.seed_type FROM tbl_seed as sd INNER JOIN tbl_seed_type as st on sd.seed_type_id=st.seed_type_id");
                            while($row = mysqli_fetch_array($query)){       
                        ?>  
                        <tr>
                        <td align="center"><?php echo $row['seed_id']; ?></td>
                        <td align="center"><?php echo $row['seed_description']; ?></td>
                        <td align="center"><?php echo $row['seed_type']; ?></td>
                        <td align="center">
                        <div class="btn-group">
                            <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['seed_id']; ?>"/>                       
                            <a href="#editModal<?php echo $row['seed_id']; ?>" class="btn btn-info btn-sm" data-toggle="modal">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <button type="submit" class="btn btn-danger btn-sm"onclick="confirm_del();return false;" name="deleteBtn" id="deleteBtn" >
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
                        </div>
                        </td>
                        </tr>
                        <div class="modal fade" id="editModal<?php echo $row['seed_id']; ?>" tabindex="2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h5 class="modal-title" id="exampleModalLabel">EDIT SEED </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['seed_id']; ?>"/>    
                            <div class="form-group">
                                <label>SEED TYPE: </label>
                                <input type="text" name="seed_description"  class="form-control" value="<?php echo $row['seed_description'] ?>" required />
                            </div>
                            <!-- select -->
                            <div class="form-group">
                            <label>SEED TYPE</label>
                            <select class="form-control" name="seed_type_id">
                            <option value="<?php echo $row['seed_type_id']; ?>"><?php echo $row['seed_type']; ?></option>
                            <option value=""></option>
                            <?php
                            $query1 = mysqli_query($connection,"SELECT * FROM tbl_seed_type");
                                while($row1 = mysqli_fetch_array($query1)){
                                    echo"<option value='".$row1['seed_type_id']."'>".$row1['seed_type']."</option>";  
                                }    
                            ?>
                            </select>
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

<div class="modal fade" id="addSeedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> ADD NEW SEED</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST">

      <div class="form-group">
        <label>SEED: </label>
        <input type="text" name="seed"  class="form-control" required />
      </div>

      <div class="form-group">
        <label>SEED TYPE: </label>
        <select class="form-control" name="seedType" required >
        <option value=""></option>
        <?php
        $query = mysqli_query($connection,"SELECT * FROM tbl_seed_type");
            while($row = mysqli_fetch_array($query)){
              echo"<option value='".$row['seed_type_id']."'>".$row['seed_type']."</option>";  
            }    
        ?>  
        </select>
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

