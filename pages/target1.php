<?php require('./session.php'); 
    require('./database.php');
    require('./season.php');
?>



<!-- add new item -->
<?php
  if (isset($_POST['btn_save'])) {
    for($index=0;$index<count($_POST['mun_id']);$index++){
      $program =mysqli_real_escape_string($connection,$_POST['program']);
      $season =mysqli_real_escape_string($connection,$_POST['season']);
      $year=$_POST['year'];
      $mun_id=$_POST['mun_id'][$index];
      $target=$_POST['target'][$index];
      if($target!=0){
        mysqli_query($connection,"INSERT INTO tbl_target (mun_id, program, season, year, target) VALUES ('$mun_id', '$program', '$season', '$year', '$target')");
      }
      pathTo('target');
    }
  }
?>

<!-- changing of accounts-->
<?php
  if (isset($_POST['btn_change'])) {
    $program =mysqli_real_escape_string($connection,$_POST['program']);
    $season =mysqli_real_escape_string($connection,$_POST['season']);
    $year=$_POST['year'];
    $mun_id=$_POST['municipality'];
    $target=$_POST['target'];
    $id=$_POST['id'];
    
    mysqli_query($connection,"UPDATE tbl_target SET mun_id='$mun_id', program='$program', season='$season',  year='$year', target='$target' WHERE target_id='$id' ");
   

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
     mysqli_query($connection,"DELETE from tbl_target WHERE target_id='$no'");
     pathTo('target');
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
     
            <!-- /.card -->
        <div class="row">
        
          <div class="col-md-12">
          <br>
    <br>
    <br>
  <br>
          <div class="card">
              <div class="card-header bg-success">
                <h3 class="card-title">TARGET SETTING</h3>
                <div class="card-tools">
                <button type="button" class="btn bg-gradient-info  btn-sm" data-toggle="modal" data-target="#addModal">
                    <i class="fa fa-plus" aria-hidden="true"> </i> ADD NEW TARGET
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
              <form method="POST">
                <div class="row">
                  <div class="col-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-success ">PROGRAM</span>
                        </div>
                        <!-- /btn-group -->
                        <select class="form-control" name="program" required >
                            <option value=""></option>
                            <option value="PLANTING">PLANTING</option>
                            <option value="HARVESTING">HARVESTING</option> 
                        </select>
                    </div>
                  </div>
                  
                  <div class="col-2">
                  <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-success ">SEASON</span>
                        </div>
                        <!-- /btn-group -->
                        <select class="form-control" name="season" required >
                            <option value=""></option>
                            <option value="WET">WET</option>
                            <option value="DRY">DRY</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-success ">YEAR</span>
                        </div>
                        <!-- /btn-group -->
                        <select class="form-control" name="year" required >
                            <option value=""></option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option> 
                            <option value="2022">2022</option> 
                        </select>
                    </div>
                  </div>
                  <div class="col-2">
                    <button type="submit" class="btn bg-gradient-success btn-block " name="btn_set">
                        <strong> SET</strong>
                    </button>
                  </div>
                </div>
              </form>
              <br>
                <?php
                    if (isset($_POST['btn_set'])) {
                      echo"
                      <form method='POST'>
                      <table id='dataTables-example' class='table  table-striped table-sm ' style='text-align:center'>
                          <thead class='bg-info'>
                          <tr>

                              <th>MUNICIPALITY</th>
                              <th>PROGRAM</th>
                              <th>SEASON</th>
                              <th>YEAR</th>
                              <th>TRAGET</th>
                              <th>ACTION</th>
                              
                          </tr>
                          </thead>
                          <tbody>";
                              $query = mysqli_query($connection,"SELECT mn.mun_id, mn.municipality, tg.target_id, tg.season, tg.year, tg.program, tg.target FROM tbl_target as tg INNER JOIN tbl_municipality as mn ON tg.mun_id=mn.mun_id WHERE tg.program='".$_POST['program']."' AND season='".$_POST['season']."' AND YEAR='".$_POST['year']."'");
                                  while($row = mysqli_fetch_array($query)){
                                      
                                    
                          echo"<tr>
                          <td align='center'>".$row['municipality']."</td>
                          <td align='center'>".$row['program']."</td>
                          <td align='center'>".$row['season']."</td>
                          <td align='center'>".$row['year']."</td>
                          <td align='center'>".$row['target']."</td>
                          <td align='center'>
                          <div class='btn-group'>
                              <form method='POST'>
                                <input type='hidden' name='id' value='".$row['target_id']."'/>                       
                                <a href='#editModal".$row['target_id']."' class='btn btn-info btn-sm' data-toggle='modal'>
                                <i class='fa fa-edit' aria-hidden='true'></i>
                                </a>
                                <button type='submit' class='btn btn-danger btn-sm' onclick='confirm_del();return false;' name='deleteBtn'  id='deleteBtn' >
                                <i class='fas fa-trash'></i>
                                </button>
                              </form> 
                          </div>
                          </td>
                          </tr>
                          <div class='modal fade' id='editModal".$row['target_id']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                          <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                              <div class='modal-header bg-success'>
                                <h5 class='modal-title' id='exampleModalLabel'>EDIT TARGET </h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>
                              <div class='modal-body'>
                              <form method='POST'>
                              <input type='hidden' name='id' value='".$row['target_id']."'/>    
                              
                              <div class='form-group'>
                              <label>MUNICIPALITY</label>
                              <select class='form-control' name='municipality'>
                              <option value='".$row['mun_id']."'>".$row['municipality']."</option>
                              <option></option>";
                              
                              $query1 = mysqli_query($connection,"SELECT * FROM tbl_municipality");
                                  while($row1 = mysqli_fetch_array($query1)){
                                      echo"<option value='".$row1['mun_id']."'>".$row1['municipality']."</option>";  
                                  }    
                              echo"</select>
                              </div>";

                              
                             
                              echo"<div class='form-group'>
                              <label>PROGRAM</label>
                              <select class='form-control' name='program'>
                              <option value='".$row['program']."'>".$row['program']."</option>
                              <option></option>
                              <option value='PLANTING'>PLANTING</option>
                              <option value='HARVESTING'>HARVESTING</option>
                              </select>
                              </div>";

                              echo"<div class='form-group'>
                              <label>SEASON</label>
                              <select class='form-control' name='season'>
                              <option value='".$row['season']."'>".$row['season']."</option>
                              <option></option>
                              <option value='WET'>WET</option>
                              <option value='DRY'>DRY</option>
                              </select>
                              </div>";

                              echo"<div class='form-group'>
                              <label>SEASON</label>
                              <select class='form-control' name='year'>
                              <option value='".$row['year']."'>".$row['year']."</option>
                              <option></option>
                              <option value='2020'>2020</option>
                              <option value='2021'>2021</option> 
                              <option value='2022'>2022</option> 
                              </select>
                              </div>";
                                 
                              echo"<div class='form-group'>
                                <label>TARGET: </label>
                                <input type='text' name='target'  class='form-control' value='".$row['target']."' required />
                              </div>

                              </div>
                                <div class='modal-footer'>
                                  <button type='submit' class='btn bg-gradient-success' name='btn_change' >Save</button>
                                  <button type='reset' class='btn bg-gradient-danger'>Clear</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>";
                                  }
                          
                         echo" </tbody>
                          </tfoot>
                          </table>
                          </div>
                          
                      </form>";
                    }
                    else{
                      
                      echo"
                      <form method='POST'>
                      <table id='dataTables-example' class='table  table-striped table-sm ' style='text-align:center'>
                          <thead class='bg-info'>
                          <tr>

                              <th>MUNICIPALITY</th>
                              <th>PROGRAM</th>
                              <th>SEASON</th>
                              <th>YEAR</th>
                              <th>TRAGET</th>
                              <th>ACTION</th>
                              
                          </tr>
                          </thead>
                          <tbody>";
                              $query = mysqli_query($connection,"SELECT mn.mun_id, mn.municipality, tg.year, tg.target_id, tg.season, tg.program, tg.target FROM tbl_target as tg INNER JOIN tbl_municipality as mn ON tg.mun_id=mn.mun_id");
                                  while($row = mysqli_fetch_array($query)){
                                      
                                    
                          echo"<tr>
                          <td align='center'>".$row['municipality']."</td>
                          <td align='center'>".$row['program']."</td>
                          <td align='center'>".$row['season']."</td>
                          <td align='center'>".$row['year']."</td>
                          <td align='center'>".$row['target']."</td>
                          <td align='center'>
                          <div class='btn-group'>
                              <form method='POST'>
                                <input type='hidden' name='id' value='".$row['target_id']."'/>                       
                                <a href='#editModal".$row['target_id']."' class='btn btn-info btn-sm' data-toggle='modal'>
                                <i class='fa fa-edit' aria-hidden='true'></i>
                                </a>
                                <button type='submit' class='btn btn-danger btn-sm' onclick='confirm_del();return false;' name='deleteBtn'  id='deleteBtn' >
                                <i class='fas fa-trash'></i>
                                </button>
                              </form> 
                          </div>
                          </td>
                          </tr>
                          <div class='modal fade' id='editModal".$row['target_id']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                          <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                              <div class='modal-header bg-success'>
                                <h5 class='modal-title' id='exampleModalLabel'>EDIT TARGET </h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>
                              <div class='modal-body'>
                              <form method='POST'>
                              <input type='hidden' name='id' value='".$row['target_id']."'/>    
                              
                              <div class='form-group'>
                              <label>MUNICIPALITY</label>
                              <select class='form-control' name='municipality'>
                              <option value='".$row['mun_id']."'>".$row['municipality']."</option>
                              <option></option>";
                              
                              $query1 = mysqli_query($connection,"SELECT * FROM tbl_municipality");
                                  while($row1 = mysqli_fetch_array($query1)){
                                      echo"<option value='".$row1['mun_id']."'>".$row1['municipality']."</option>";  
                                  }    
                              echo"</select>
                              </div>";

                              
                             
                              echo"<div class='form-group'>
                              <label>PROGRAM</label>
                              <select class='form-control' name='program'>
                              <option value='".$row['program']."'>".$row['program']."</option>
                              <option></option>
                              <option value='PLANTING'>PLANTING</option>
                              <option value='HARVESTING'>HARVESTING</option>
                              </select>
                              </div>";

                              echo"<div class='form-group'>
                              <label>SEASON</label>
                              <select class='form-control' name='season'>
                              <option value='".$row['season']."'>".$row['season']."</option>
                              <option></option>
                              <option value='WET'>WET</option>
                              <option value='DRY'>DRY</option>
                              </select>
                              </div>";

                              echo"<div class='form-group'>
                              <label>SEASON</label>
                              <select class='form-control' name='year'>
                              <option value='".$row['year']."'>".$row['year']."</option>
                              <option></option>
                              <option value='2020'>2020</option>
                              <option value='2021'>2021</option> 
                              <option value='2022'>2022</option> 
                              </select>
                              </div>";
                                 
                              echo"<div class='form-group'>
                                <label>TARGET: </label>
                                <input type='text' name='target'  class='form-control' value='".$row['target']."' required />
                              </div>

                              </div>
                                <div class='modal-footer'>
                                  <button type='submit' class='btn bg-gradient-success' name='btn_change' >Save</button>
                                  <button type='reset' class='btn bg-gradient-danger'>Clear</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>";
                                  }
                          
                         echo" </tbody>
                          </tfoot>
                          </table>
                          </div>
                          
                      </form>";
                
                    }
                ?>
              
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
    require_once('links_script.php');
  ?>
</body>
</html>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLabel">ADD NEW DATA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
        <form method='POST'>
          <div class="row">
            <div class="col-6">
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-success ">PROGRAM</span>
                  </div>
                  <!-- /btn-group -->
                  <select class="form-control" name="program" required >
                      <option value=""></option>
                      <option value="PLANTING">PLANTING</option>
                      <option value="HARVESTING">HARVESTING</option> 
                  </select>
              </div>
            </div>
                  
            <div class="col-3">
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-success ">SEASON</span>
                  </div>
                  <!-- /btn-group -->
                  <select class="form-control" name="season" required >
                      <option value=""></option>
                      <option value="WET">WET</option>
                      <option value="DRY">DRY</option>
                  </select>
              </div>
            </div>
            <div class="col-3">
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-success ">YEAR</span>
                  </div>
                  <!-- /btn-group -->
                  <select class="form-control" name="year" required >
                      <option value=""></option>
                      <option value="2020">2020</option>
                      <option value="2021">2021</option> 
                      <option value="2022">2022</option> 
                  </select>
              </div>
            </div>
          </div>
        <br>
        <div class="row">  
            <div class="col-12">
                <table id="dataTables-example" class='table  table-striped table-sm ' style='text-align:center'>
                    <thead class="bg-info">
                    <tr>
                        <th>ID</th>
                        <th>MUNICIPALITY</th>
                        <th>TARGET</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($connection,"SELECT * FROM tbl_municipality ORDER BY district ASC , municipality ASC");
                            while($row = mysqli_fetch_array($query)){
                                
                        ?> 
                            
                    <tr>
                    <td align='center'>
                    <input type='hidden' class='form-control' name='mun_id[]' value='<?php echo $row['mun_id']; ?>'>
                    <?php echo $row['district']; ?>
                    </td>
                    <td align='center'>
                    <input type='hidden' class='form-control' name='municipality[]' value='<?php echo $row['municipality']; ?>'>
                    <?php echo $row['municipality']; ?></td>
                    <td align='center'><input type='text' class='form-control' name='target[]' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                    </tr>

                    <?php
                    }
                    ?>
                    </tbody>
                </table>  
            </div>               
        </div>
      </div>
      <div class="modal-footer">
    <button type='submit' class='btn bg-gradient-success' name='btn_save'>
    <strong> SET</strong>
    </button>  
    <button type='reset' class='btn bg-gradient-danger' name='btn_clear'>
    <strong> CLEAR</strong>
    </button> 
        </div>
        </form>
  </div>
</div>