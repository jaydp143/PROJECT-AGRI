<?php require('./session.php'); 
    require('./database.php');
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



<!-- delete function -->
   <script>
    function confirm_del()
    {
      if(confirm("Are you sure you want to delete?")==1){
        document.getElementById('deleteBtn').submit();
      }
    }
</script>

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
  <title>MUNICIPALITY</title>
  <?php
    require_once('links.php')
  ?>
  
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <?php
    require_once('header.php')
  ?>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <div class="content">
      <div class="container">
      <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
          <br>
          <br>
          <br>
          <br>
          <div class="card">
              <div class="card-header bg-success">
                <h3 class="card-title">LIST OF SEED TYPES</h3>
                <div class="card-tools">
                <button type="button" class="btn bg-gradient-info  btn-sm" data-toggle="modal" data-target="#addSeedTypeModal">
                    <i class="fa fa-plus" aria-hidden="true"> </i> ADD NEW ITEM
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTables-example" class="table  table-striped table-sm " style="text-align:center">
                  <thead class="bg-info">
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
              <!-- /.card-body -->
            </div>
          </div>
        </div>
       
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    
  </div>
  <!-- /.content-wrapper -->
  <?php
    require_once('footer.php');
  ?>
</div>
<!-- ./wrapper -->
<?php
    require_once('links_script.php');
  ?>
</body>
</html>

<!--Add Municipality Modal -->
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