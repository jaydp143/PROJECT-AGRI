<?php   
     $pagename="harvesting_municipality";  
     require('./session.php'); 
     require('./database.php');
     require('./season.php');
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
    $production =$_POST['production'];
    $yield =$_POST['production']/$_POST['area'];
    $date_monitored =$_POST['date_monitored'];
    $user=$_SESSION['username'];
    mysqli_query($connection,"UPDATE tbl_harvesting SET mun_id='$municipality', seed_id='$seed', seed_type_id='$seed_type', eco_id='$ecosystem', season='$season', area='$area', yield='$yield', production='$production', date_monitored='$date_monitored',user='$user' WHERE harvest_id='$id' ");

   
     echo "
                <script type='text/javascript'>
                alert('UPDATE done');
                open('harvesting.php?mun_id=".$municipality."','_self');
                </script>
            ";

  }
 ?>


   

<?php
if (isset($_POST['deleteBtn'])) 
{
    $no = $_POST['id'];
     $municipality =$_POST['municipality'];
     mysqli_query($connection,"DELETE from tbl_harvesting WHERE harvest_id='$no'");
     echo "
                <script type='text/javascript'>
                alert('DELETED!');
                open('harvesting.php?mun_id=".$municipality."','_self');
                </script>
            ";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <title>HARVESTING</title>
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
      require_once('sidebar.php')
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <?php
                $queryMun=mysqli_query($connection,"SELECT municipality from tbl_municipality WHERE mun_id='".$_GET['mun_id']."'");
                $rowMun=mysqli_fetch_assoc($queryMun);
                $municipality=$rowMun['municipality']
            ?>
            <h1>Harvest Accomplishment of <?php echo $municipality; ?></h1>
            <p><?php echo $season." SEASON ".$seasonYear."-".$year."| AS OF ".date_format(date_create($dateNow),"F d, Y");?></p>
            <a class="btn bg-gradient-info  btn-sm" href="harvest_monitoring.php">
                <i class="fas fa-angle-double-left"></i> Back
            </a>
          </div>
          
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
          
            
            
                <table id="dataTables-example" class="table  table-striped table-sm " style="text-align:center; width:100%;">
                <thead style="background-color:#1B5E20;" class="text-light">
                  <tr>
                    <th >SEED</th>
                    <th >ECOSYSTEM</th>
                    <th >DATE OF HARVEST</th>
                    <th >AREA</th>
                    <th >YIELD</th>
                    <th >PRODUCTION</th>
                    <th >ACTIONS</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $query = mysqli_query($connection,"SELECT hs.mun_id, hs.seed_id, hs.seed_type_id, hs.eco_id, hs.harvest_id, hs.season,hs.area, hs.yield, hs.production, hs.date_monitored, 
                    (SELECT mn.municipality FROM tbl_municipality as mn where mn.mun_id=hs.mun_id)municipality,
                    (SELECT sd.seed_description FROM tbl_seed as sd WHERE sd.seed_id=hs.seed_id)seed, 
                    (SELECT sdt.seed_type FROM tbl_seed_type as sdt WHERE sdt.seed_type_id=hs.seed_type_id)seed_type, 
                    (SELECT es.ecosystem FROM tbl_ecosystem as es WHERE es.eco_id=hs.eco_id)ecosystem 
                    FROM tbl_harvesting as hs WHERE hs.mun_id='".$_GET['mun_id']."' AND date_monitored BETWEEN '".$startdate."' AND '".$enddate."'");
                        while($row = mysqli_fetch_array($query)){     
                    ?>  
                  <tr>
                  <td align="center"><?php echo $row['seed']; ?></td>
                  <td align="center"><?php echo $row['ecosystem']; ?></td>
                  <td align="center"><?php echo $row['date_monitored']; ?></td>
                  <td align="center"><?php echo $row['area']; ?></td>
                  <td align="center"><?php echo $row['yield']; ?></td>
                  <td align="center"><?php echo $row['production']; ?></td>
                  <td align="center">
                      <div class="btn-group">
                          <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['harvest_id']; ?>"/>   
                            <input type="hidden" name="municipality" value="<?php echo $row['mun_id']; ?>"/>                     
                            <a href="#editModal<?php echo $row['harvest_id']; ?>" class="btn btn-info btn-sm" data-toggle="modal">
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
                          <div class="modal fade" id="editModal<?php echo $row['harvest_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                  <input type="hidden" name="id" value="<?php echo $row['harvest_id']; ?>"/> 
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
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                        <label>AREA HARVESTED (ha)</label>
                                        <input type="text" class="form-control" id="area" name="area" value="<?php echo $row['area']; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        </div>
                                    </div> 
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                        <label>PRODUCTION</label>
                                        <input type="text" class="form-control" value="<?php echo $row['production']; ?>" name="production" id="production" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
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
                </tfoot>
                </table>
              
             
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
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLabel">ADD NEW ECOSYSTEM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST">

      <div class="form-group">
        <label>ECOSYSTEM: </label>
        <input type="text" name="ecosystem"  class="form-control" required />
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