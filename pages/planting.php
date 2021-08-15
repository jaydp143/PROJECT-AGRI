<?php require('./session.php'); 
    require('./database.php');
    require('./save_new_pass.php');
    require('./save_new_profile.php');
    require('./user_data.php');
?>



<!-- changing of accounts-->
<?php
  if (isset($_POST['btn_change'])) {
    $id=$_POST['id'];
    $municipality =$_POST['municipality'];
    $seed =$_POST['seed'];
    $seed_type =$_POST['seed_type'];
    $ecosystem =$_POST['ecosystem'];
    $season =mysqli_real_escape_string($connection,$_POST['season']);
    $area =$_POST['area'];
    $farmer =$_POST['farmer'];
    $date_monitored =$_POST['date_monitored'];
    $user=$_SESSION['username'];
    mysqli_query($connection,"UPDATE tbl_planting SET mun_id='$municipality', seed_id='$seed', seed_type_id='$seed_type', eco_id='$ecosystem', season='$season', areas='$area', farmers='$farmer', date_monitored='$date_monitored',user='$user' WHERE planting_id='$id' ");

   
     echo "
                <script type='text/javascript'>
                alert('UPDATE done');
                open('planting.php?mun_id=".$municipality."','_self');
                </script>
            ";

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
    $municipality = $_POST['municipality'];
     mysqli_query($connection,"DELETE from tbl_planting WHERE planting_id='$no'");
     echo "
                <script type='text/javascript'>
                alert('DELETED!');
                open('planting.php?mun_id=".$municipality."','_self');
                </script>
            ";
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
  <div class="content-wrapper" style="background:white;" >
    
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
              <div class="card-header bg-info">
                <?php
                  $queryMun=mysqli_query($connection,"SELECT municipality from tbl_municipality WHERE mun_id='".$_GET['mun_id']."'");
                  $rowMun=mysqli_fetch_assoc($queryMun);
                  $municipality=$rowMun['municipality']
                ?>
                <h3 class="card-title text-light">Planting Accomplishment of <?php echo $municipality ?> </h3>
                <br>
                <a class="btn bg-gradient-info  btn-xs" href="planting_accomplishment_monitoring.php">
                  <i class="fas fa-angle-double-left"></i> Back
                </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-striped table-sm"  id="dataTables-example" style="text-align:center">  
                  <thead class="bg-info">
                  <tr>
                    <th >DATE PLANTED</th>
                    <th >SEED</th>
                    <th >ECOSYSTEM</th>
                    <th >AREA</th>
                    <th >FARMERS</th>
                    <th >ACTIONS</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $query = mysqli_query($connection,"SELECT pl.mun_id, pl.seed_id, pl.seed_type_id,  pl.eco_id, pl.planting_id, pl.season,pl.areas, pl.farmers, pl.date_monitored, (SELECT mn.municipality FROM tbl_municipality as mn where mn.mun_id=pl.mun_id)municipality, (SELECT sd.seed_description FROM tbl_seed as sd WHERE sd.seed_id=pl.seed_id)seed, (SELECT sdt.seed_type FROM tbl_seed_type as sdt WHERE sdt.seed_type_id=pl.seed_type_id)seed_type, (SELECT es.ecosystem FROM tbl_ecosystem as es WHERE es.eco_id=pl.eco_id)ecosystem FROM tbl_planting as pl WHERE pl.mun_id='".$_GET['mun_id']."' ORDER BY pl.planting_id ASC");
                        while($row = mysqli_fetch_array($query)){     
                    ?>  
                  <tr>
                  <td align="center"><?php echo date_format(date_create($row['date_monitored']),"F/d/Y"); ?></td>
                  <td align="center"><?php echo $row['seed']; ?></td>
                  <td align="center"><?php echo $row['ecosystem']; ?></td>
                  <td align="center"><?php echo $row['areas']; ?></td>
                  <td align="center"><?php echo $row['farmers']; ?></td>
                  <td align="center">
                      <div class="btn-group">
                        <form method="POST">
                          <input type="hidden" name="id" value="<?php echo $row['planting_id']; ?>"/>  
                          <input type="hidden" name="municipality" value="<?php echo $row['mun_id']; ?>"/>                        
                          <a href="#editModal<?php echo $row['planting_id']; ?>" class="btn btn-info btn-sm" data-toggle="modal">
                          <i class="fa fa-edit" aria-hidden="true"></i>
                          </a>
                          <button type="submit" class="btn btn-danger btn-sm"onclick="confirm_del();return false;" name="deleteBtn" id="deleteBtn" title="Delete User" id="Delete_id" >
                          <i class="fas fa-trash"></i>
                          </button>
                        </form> 
                        <div class="modal fade" id="editModal<?php echo $row['planting_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-success">
                              <h5 class="modal-title" id="exampleModalLabel">EDIT</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="POST">
                                  <div class="row">
                                  <input type="hidden" name="id" value="<?php echo $row['planting_id']; ?>"/> 
                                      <div class="col-sm-6">
                                          <div class="form-group">
                                          <label>MONTH</label>
                                          <input type="date" class="form-control" name="date_monitored" value="<?php echo $row['date_monitored']; ?>">
                                          </div>
                                      </div> 
                                      <div class="col-sm-6">
                                          <!-- select -->
                                          <div class="form-group">
                                          <label>MUNICIPALITY</label>
                                          <select class="form-control" name="municipality">
                                          <option value="<?php echo $row['mun_id']; ?>"><?php echo $row['municipality']; ?></option>
                                          <option value=""></option>
                                          <?php
                                          $query1 = mysqli_query($connection,"SELECT * FROM tbl_municipality");
                                              while($row1 = mysqli_fetch_array($query1)){
                                                  echo"<option value='".$row1['mun_id']."'>".$row1['municipality']."</option>";  
                                              }    
                                          ?>
                                          </select>
                                          </div>
                                      </div>    
                                  </div>
                                  <div class="row">
                                      <div class="col-sm-6">
                                          <!-- select -->
                                          <div class="form-group">
                                          <label>SEED</label>
                                          <select class="form-control" name="seed">
                                          <option value="<?php echo $row['seed_id']; ?>"><?php echo $row['seed']; ?></option>
                                          <option value=""></option>
                                          <?php
                                          $query1 = mysqli_query($connection,"SELECT * FROM tbl_seed");
                                              while($row1 = mysqli_fetch_array($query1)){
                                                  echo"<option value='".$row1['seed_id']."'>".$row1['seed_description']."</option>";  
                                              }    
                                          ?>
                                          </select>
                                          </div>
                                      </div> 
                                      <div class="col-sm-6">
                                          <!-- select -->
                                          <div class="form-group">
                                          <label>SEED TYPE</label>
                                          <select class="form-control" name="seed_type">
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
                                  </div> 
                                  <div class="row">
                                      <div class="col-sm-6">
                                          <!-- select -->
                                          <div class="form-group">
                                          <label>ECOSYSTEM</label>
                                          <select class="form-control" name="ecosystem">
                                          <option value="<?php echo $row['eco_id']; ?>"><?php echo $row['ecosystem']; ?></option>
                                          <option value=""></option>
                                          <?php
                                          $query1 = mysqli_query($connection,"SELECT * FROM tbl_ecosystem");
                                              while($row1 = mysqli_fetch_array($query1)){
                                                  echo"<option value='".$row1['eco_id']."'>".$row1['ecosystem']."</option>";  
                                              }    
                                          ?>
                                          </select>
                                          </div>
                                      </div> 
                                      <div class="col-sm-6">
                                          <!-- select -->
                                          <div class="form-group">
                                          <label>SEASON</label>
                                          <select class="form-control" name="season">
                                          <option value="<?php echo $row['season']; ?>"><?php echo $row['season']; ?></option>
                                          <option value=""></option>
                                          <option value="WET">WET</option>
                                          <option value="DRY">DRY</option>
                                          </select>
                                          </div>
                                      </div> 
                                  </div> 
                                  <div class="row">
                                      <div class="col-sm-6">
                                          <!-- select -->
                                          <div class="form-group">
                                          <label>AREA PLANTED (Ha)</label>
                                          <input type="text" class="form-control" name="area" value="<?php echo $row['areas']; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                          </div>
                                      </div> 
                                      <div class="col-sm-6">
                                          <!-- select -->
                                          <div class="form-group">
                                          <label>NO. OF FARMERS</label>
                                          <input type="number" class="form-control" name="farmer" value="<?php echo $row['farmers']; ?>">
                                          </div>
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
    <?php
    require_once('footer.php');
  ?>
  </div>
  <!-- /.content-wrapper -->
  
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

