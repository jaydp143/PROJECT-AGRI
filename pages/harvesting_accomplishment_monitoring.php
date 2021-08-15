<?php require('./session.php'); 
    require('./database.php');
    require('./save_new_pass.php');
    require('./save_new_profile.php');
    require('./user_data.php');
?>

<!-- add new item -->
<?php
    if (isset($_POST['btn_save'])) {
      for($index=0;$index<count($_POST['seed']);$index++){
        $municipality =$_POST['municipality'];
        $seed =$_POST['seed'][$index];
        $seed_type =$_POST['seed_type'][$index];
        $ecosystem1 =1;
        $ecosystem2 =2;
        $ecosystem3 =3;
        $season =mysqli_real_escape_string($connection,$_POST['season']);
        $area1 =$_POST['area1'][$index];
        $production1 =$_POST['production1'][$index];
        $area2 =$_POST['area2'][$index];
        $production2 =$_POST['production2'][$index];
        $area3 =$_POST['area3'][$index];
        $production3 =$_POST['production3'][$index];
        $yield1 =($production1/$area1);
        $yield2 =($production2/$area2);
        $yield3 =($production3/$area3);
        $date_monitored =$_POST['date_monitored'];
        $user=$_SESSION['username'];
        if ($area1==0 && $production1==0){
          //reject insert
        }
        else{
          mysqli_query($connection,"INSERT INTO tbl_harvesting (mun_id,seed_id, seed_type_id, eco_id, season, area, yield, production, date_monitored, user) VALUES ('$municipality', '$seed', '$seed_type', '$ecosystem1', '$season', '$area1', '$yield1','$production1', '$date_monitored', '$user')");
        }

        if ($area2==0 && $production2==0){
          //reject insert
        }
        else{
          mysqli_query($connection,"INSERT INTO tbl_harvesting (mun_id,seed_id, seed_type_id, eco_id, season, area, yield, production, date_monitored, user) VALUES ('$municipality', '$seed', '$seed_type', '$ecosystem2', '$season', '$area2', '$yield2','$production2', '$date_monitored', '$user')");
        }

        if ($area3==0 && $production3==0){
          //reject insert
        }
        else{
          mysqli_query($connection,"INSERT INTO tbl_harvesting (mun_id,seed_id, seed_type_id, eco_id, season, area, yield, production, date_monitored, user) VALUES ('$municipality', '$seed', '$seed_type', '$ecosystem3', '$season', '$area3', '$yield3','$production3', '$date_monitored', '$user')");
        }
        
       
       
        echo "
            <script type='text/javascript'>
                alert('You have Successfully Added');
                window.location.href = 'harvesting_accomplishment_monitoring.php';
            </script>";
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HARVESTING ACCOMPLISHMENT</title>
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
          <div class="card">
                    <div class="card-header bg-success">
                      <h2 class="card-title text-light">HARVESTING ACCOMPLISHMENT MONITORING </h2>
                      <div class="card-tools">
                        <button type="button" class="btn bg-gradient-danger  btn-xs" data-toggle="modal" data-target="#addModal">
                            <i class="fa fa-plus" aria-hidden="true"> </i> ADD ACCOMPLISHMENT
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                     <div class="row">  
                         <div class="col-12">
                <table class="table table-striped table-sm"  id="dataTables-example" style="text-align:center">
                  <thead class="bg-success">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>MUNICIPALITY<br></th>
                      <th>TARGET<br> </th>
                      <th>AREA</th>
                      <th>YIELD</th>
                      <th>PROCUCTION</th>
                      <th>Progress<br> </th>
                      <th>%</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                            $query = mysqli_query($connection,"SELECT mn.mun_id,mn.municipality, (SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl WHERE pl.mun_id=mn.mun_id  AND YEAR(date_monitored)='2020')area, (SELECT COALESCE(SUM(production), 0) FROM tbl_harvesting as pl WHERE pl.mun_id=mn.mun_id  AND YEAR(date_monitored)='2020')production, (SELECT COALESCE(SUM(yield), 0) FROM tbl_harvesting as pl WHERE pl.mun_id=mn.mun_id  AND YEAR(date_monitored)='2020')yield, (SELECT target FROM tbl_target as tr WHERE tr.mun_id=mn.mun_id AND tr.program='HARVESTING'  AND tr.year='2020' )target FROM tbl_municipality as mn ORDER BY mn.mun_id ASC");
                            while($row = mysqli_fetch_array($query)){
                              $p=$row['area']/$row['target'];
                              $progress=round($p*100);
                            echo" <tr>
                                <td>".$row['mun_id']."</td>
                                <td><a  href='harvesting.php?mun_id=".$row['mun_id']."'>".$row['municipality']."</a></td>
                                <td>".$row['target']."</td>
                                <td>".$row['area']."</td>
                                <td>".$row['yield']."</td>
                                <td>".$row['production']."</td>
                                <td>
                                  <div class='progress progress-xs'>
                                    <div class='progress-bar bg-success' style='width: ".$progress."%'></div>
                                  </div>
                                </td>
                                <td><span class='badge bg-info'>".$progress."%</span></td>

                            </tr>";
                            }
                                
                            ?> 
                  </tbody>
                </table>  
                    
                        </div>
                    </div>
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
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLabel">NEW HARVEST ACCOMPLISHMENTS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST">
            <div class="row">
                <div class="col-sm-4">
                    <!-- select -->
                    <div class="form-group">
                    <label>MUNICIPALITY</label>
                    <select class="form-control" name="municipality">
                    <option value=""></option>
                    <?php
                    $query = mysqli_query($connection,"SELECT * FROM tbl_municipality");
                        while($row = mysqli_fetch_array($query)){
                            echo"<option value='".$row['mun_id']."'>".$row['municipality']."</option>";  
                        }    
                    ?>
                    </select>
                    </div>
                </div> 
                <div class="col-sm-4">
                    <div class="form-group">
                    <label>MONTH</label>
                    <input type="date" class="form-control" name="date_monitored">
                    </div>
                </div> 
                 
                <div class="col-sm-4">
                    <!-- select -->
                    <div class="form-group">
                    <label>SEASON</label>
                    <select class="form-control" name="season">
                    <option value=""></option>
                    <option value="WET">WET</option>
                    <option value="DRY">DRY</option>
                    </select>
                    </div>
                </div> 
                 
            </div>
            <div class="row">
                <div class="col-sm-12">
                  <table id="dataTables-example" class='table table-bordered  table-sm ' style='text-align:center'>
                      <thead>
                      <tr>
                          <th rowspan="2" width="40%"><br>SEED</th>
                          <th colspan="2">IRRIGATED</th>
                          <th colspan="2">RAINFED</th>
                          <th colspan="2">UPLAND</th>
                      </tr>
                      <tr>
                          <th>AREA</th>
                          <th>PROD</th>
                          <th>AREA</th>
                          <th>PROD</th>
                          <th>AREA</th>
                          <th>PROD</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                          $query = mysqli_query($connection,"SELECT * FROM tbl_seed as sd  INNER JOIN tbl_seed_type as st ON sd.seed_type_id= st.seed_type_id  ORDER BY seed_id ASC");
                              while($row = mysqli_fetch_array($query)){
                           ?>          
                            <tr>
                              <td align='center'>
                                <input type='hidden' class='form-control' name='seed[]' value='<?php echo $row['seed_id']; ?>' >
                                <input type='hidden' class='form-control' name='seed_type[]' value=' <?php echo $row['seed_type_id']; ?>'>
                                <small><?php echo $row['seed_description']; ?></small>
                            </td>
                            <td align='center'><input type='text' class='form-control' name='area1[]'  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                            <td align='center'><input type='text' class='form-control' name='poduction1[]'  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                            <td align='center'><input type='text' class='form-control' name='area2[]'  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                            <td align='center'><input type='text' class='form-control' name='production2[]'  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                            <td align='center'><input type='text' class='form-control' name='area3[]'  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                            <td align='center'><input type='text' class='form-control' name='production3[]'  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
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
          <button type="submit" class="btn bg-gradient-success" name="btn_save" >Save</button>
          <button type="reset" class="btn bg-gradient-danger">Clear</button>
        </div>
      </form>
    </div>
  </div>
</div>