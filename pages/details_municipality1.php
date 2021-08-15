<?php require('./session.php'); 
    require('./database.php');
?>

<!-- add new item -->
<?php
  if (isset($_POST['btn_save'])) {
    $municipality =mysqli_real_escape_string($connection,$_POST['municipality']);
    $district =$_POST['district'];

    $same_data = mysqli_query($connection,"SELECT * FROM tbl_municipality WHERE municipality = '$municipality'");

    if (mysqli_num_rows($same_data)>0) {
    pathTo('municipality');   

    }
    else{

  mysqli_query($connection,"INSERT INTO tbl_municipality (municipality, district) VALUES ('$municipality', '$district')");
  pathTo('municipality');
  }
}

?>

<!-- changing of accounts-->
<?php
  if (isset($_POST['btn_change'])) {
    $id=$_POST['id'];
    $municipality =$_POST['municipality'];
    $district =$_POST['district'];
    
    mysqli_query($connection,"UPDATE tbl_municipality SET municipality='$municipality', district='$district' WHERE mun_id='$id' ");

     pathTo('municipality');

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
     mysqli_query($connection,"DELETE from tbl_municipality WHERE mun_id='$no'");
     pathTo('municipality');
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
    <div class="content-header">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h1 class="m-0 text-primary"><?php echo $_GET['mun']; ?> SUMMARY</h1>
              <a class="btn bg-gradient-info  btn-xs" href="dashboard.php">
              <i class="fas fa-angle-double-left"></i> Back
              </a>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
    <!-- Main content -->
    <div class="content">
      <div class="container">
      <div class="row">
      <?php                 
        $query = mysqli_query($connection,"SELECT mun_id FROM tbl_municipality WHERE municipality='".$_GET['mun']."'");
        $row = mysqli_fetch_assoc($query);  
        $mun_id=$row['mun_id']; 

        $query1 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) AS ar FROM tbl_planting WHERE mun_id='".$mun_id."'"); 
        $row1 = mysqli_fetch_assoc($query1); 
        $totalAreaPlanted = $row1['ar'];

        $query2 = mysqli_query($connection,"SELECT COALESCE(SUM(target), 0) AS target FROM tbl_target WHERE program='PLANTING' AND year='2020' AND mun_id='".$mun_id."'"); 
        $row2 = mysqli_fetch_assoc($query2); 
        $totalTarget = $row2['target'];
        $x=$totalAreaPlanted/$totalTarget;
        $percentage=$x*100;


        $query4 = mysqli_query($connection,"SELECT COALESCE(SUM(area), 0) AS ar FROM tbl_harvesting WHERE mun_id='".$mun_id."'"); 
        $row4 = mysqli_fetch_assoc($query4); 
        $totalAreaHarv = $row4['ar'];

        $query5 = mysqli_query($connection,"SELECT COALESCE(SUM(target), 0) AS target FROM tbl_target WHERE program='HARVESTING' AND year='2020' AND mun_id='".$mun_id."'"); 
        $row5 = mysqli_fetch_assoc($query5); 
        $totalTargetH = $row5['target'];
        $y=$totalAreaHarv/$totalTargetH;
        $percentageH=$y*100;
      ?> 
          <div class="col-md-6 col-sm-6 col-12">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="fas fa-seedling"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">PLANTING ACCOMPLISHMENTS</span>
                <span class="info-box-number"><?php echo number_format($totalAreaPlanted,2); ?><i>ha</i></span>

                <div class="progress">
                  <div class="progress-bar" style="width: <?php echo round($percentage); ?>%; "></div>
                </div>
                <span class="progress-description">
                <?php echo round($percentage); ?>% from the target of <?php echo number_format($totalTarget,2) ?> has been accomplished.
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-6 col-sm-6 col-12">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="fas fa-leaf"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">HARVEST ACCOMPLISHMENTS</span>
                <span class="info-box-number"><?php echo number_format($totalAreaHarv,2); ?><i>ha</i></span>

                <div class="progress">
                  <div class="progress-bar" style="width: <?php echo round($percentageH); ?>%; "></div>
                </div>
                <span class="progress-description">
                <?php echo round($percentageH); ?>% from the target of <?php echo number_format($totalTargetH,2) ?> has been accomplished.
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
          <div class="col-md-12">
            <div class="card ">
                <div class="card-header bg-info">
                  <h3 class="card-title text-light">PLANTING ACCOMPLISHMENT </h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-striped" id="dataTables-example" style="text-align:center" >
                    <thead class="bg-info" > 
                      <tr>
                        <th style="width: 10%">#</th>
                        <th style="width: 40%">SEED</th>
                        <th >IRRIGATED</th>
                        <th >RAINFED</th>
                        <th >UPLAND</th>
                      </tr> 
                    </thead>
                    <tbody>
                      <!-- <tr> -->
                      <?php
                        // echo"<td><b>".$_GET['mun']."</b><td>
                        // <td><b>".$_GET['mun']."</b><td>";
                        // $queryX = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as area FROM tbl_planting as pl GROUP BY pl.eco_id");
                        // while($rowX = mysqli_fetch_array($queryX)){
                        // echo" 
                        //     <td><b>".$rowX['area']."</b></td>
                        // ";
                        // }              
                      ?>
                      <!-- </tr> -->
                      <?php
                        $query = mysqli_query($connection,"SELECT sd.seed_description,sd.seed_id, (SELECT COALESCE(SUM(areas), 0) AS ar FROM tbl_planting as pl WHERE pl.seed_id=sd.seed_id AND pl.mun_id='".$mun_id."' and pl.eco_id='1'   AND YEAR(pl.date_monitored)='2020') irrigated, (SELECT COALESCE(SUM(areas), 0) AS ar FROM tbl_planting as pl WHERE pl.seed_id=sd.seed_id AND pl.mun_id='".$mun_id."' and pl.eco_id='2'   AND YEAR(pl.date_monitored)='2020' ) rainfed,(SELECT COALESCE(SUM(areas), 0) AS ar FROM tbl_planting as pl WHERE pl.seed_id=sd.seed_id AND pl.mun_id='".$mun_id."' and pl.eco_id='3'   AND YEAR(pl.date_monitored)='2020' ) upland FROM tbl_seed as sd ORDER BY sd.seed_id");
                        while($row = mysqli_fetch_array($query)){
                        echo" <tr>
                            <td>".$row['seed_id']."</td>
                            <td>".$row['seed_description']."</td>
                            <td>".$row['irrigated']."</td>
                            <td>".$row['rainfed']."</td>
                            <td>".$row['upland']."</td>
                        </tr>";
                        }              
                      ?>          
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
            </div> 
            <div class="card ">
                <div class="card-header bg-success">
                  <h5 class="card-title text-light">HARVESTING ACCOMPLISHMENT </h5>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-striped" id="dataTables-example1" style="text-align:center" >
                    <thead class="bg-success" > 
                      <tr>
                        <th style="width: 10%">#</th>
                        <th style="width: 40%">SEED</th>
                        <th >IRRIGATED</th>
                        <th >RAINFED</th>
                        <th >UPLAND</th>
                      </tr> 
                    </thead>
                    <tbody>
                      <?php
                        $query = mysqli_query($connection,"SELECT sd.seed_description,sd.seed_id, (SELECT COALESCE(SUM(area), 0) AS ar FROM tbl_harvesting as pl WHERE pl.seed_id=sd.seed_id AND pl.mun_id='".$mun_id."' and pl.eco_id='1'   AND YEAR(pl.date_monitored)='2020' ) irrigated, (SELECT COALESCE(SUM(area), 0) AS ar FROM tbl_harvesting as pl WHERE pl.seed_id=sd.seed_id AND pl.mun_id='".$mun_id."' and pl.eco_id='2'   AND YEAR(pl.date_monitored)='2020' ) rainfed,(SELECT COALESCE(SUM(area), 0) AS ar FROM tbl_harvesting as pl WHERE pl.seed_id=sd.seed_id AND pl.mun_id='".$mun_id."' and pl.eco_id='3'   AND YEAR(pl.date_monitored)='2020' ) upland FROM tbl_seed as sd ORDER BY sd.seed_id");
                        while($row = mysqli_fetch_array($query)){
                        echo" <tr>
                            <td>".$row['seed_id']."</td>
                            <td>".$row['seed_description']."</td>
                            <td>".$row['irrigated']."</td>
                            <td>".$row['rainfed']."</td>
                            <td>".$row['rainfed']."</td>
                        </tr>";
                        }              
                      ?>          
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
            </div> 
          </div>
          
          
       
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
</div>
<!-- ./wrapper -->
<?php
    require_once('links_script.php');
  ?>
</body>
</html>

<!--Add Municipality Modal -->
<div class="modal fade" id="addMunicipalityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLabel">Create Municipality</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST">

      <div class="form-group">
        <label>MUNICIPALITY: </label>
        <input type="text" name="municipality"  class="form-control" required />
      </div>

      <div class="form-group">
        <label>DISTRICT: </label>
        <select class="form-control" name="district" required >
        <option value=""></option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
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