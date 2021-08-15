<?php require('./session.php'); 
    require('./database.php');
    require('./save_new_pass.php');
    require('./save_new_profile.php');
    require('./user_data.php');
?>

<!-- add new item -->
<?php
  if (isset($_POST['btn_save'])) {
    $ecosystem =mysqli_real_escape_string($connection,$_POST['ecosystem']);
   

    $same_data = mysqli_query($connection,"SELECT * FROM tbl_ecosystem WHERE ecosystem = '$ecosystem'");

    if (mysqli_num_rows($same_data)>0) {

      pathTo('ecosystem');  

    }
    else{

  mysqli_query($connection,"INSERT INTO tbl_ecosystem (ecosystem) VALUES ('$ecosystem')");

  pathTo('ecosystem');
  }
}

?>


<!-- changing of accounts-->
<?php
  if (isset($_POST['btn_change'])) {
    $id=$_POST['id'];
    $ecosystem =$_POST['ecosystem'];
    
    
    mysqli_query($connection,"UPDATE tbl_ecosystem SET ecosystem='$ecosystem' WHERE eco_id='$id' ");
    pathTo('ecosystem');

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
     mysqli_query($connection,"DELETE from tbl_ecosystem WHERE eco_id='$no'");
     pathTo('ecosystem');
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
    <div class="content" tabindex="-1">
      <div class="container">
      <br>
      <br>
      <br>
      <br>
     <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++=--> 
     <!-- Small boxes (Stat box) -->
     <h5 class="mb-2 text-primary">VEGATATIVE</h5>
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon text-light" style="background-color:#145A32;"><i>0</i></span>

              <div class="info-box-content">
              <?php
                $query0 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>3 AND (SELECT DATEDIFF(NOW(),pl1.date_monitored))<=20");
                $row0 = mysqli_fetch_assoc($query0); 
              ?> 
                <b><h6>GERMINATING OF EMERGENCE</h6></b>
                <b><?php echo $row0['stage0'] ?></b>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
            <span class="info-box-icon text-light" style="background-color:#196F3D;"><i>1</i></span>

              <div class="info-box-content">
              <?php
                $query0 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>20 AND (SELECT DATEDIFF(NOW(),pl1.date_monitored))<=30");
                $row0 = mysqli_fetch_assoc($query0); 
              ?>
                <b><h6><br>SEEDLING</h6></b>
                <b><?php echo $row0['stage0'] ?></b>
              </div>
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
            <span class="info-box-icon text-light" style="background-color:#1E8449;"><i>2</i></span>

              <div class="info-box-content">
              <?php
                $query0 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>30 AND (SELECT DATEDIFF(NOW(),pl1.date_monitored))<=50");
                $row0 = mysqli_fetch_assoc($query0); 
              ?>
                <b><h6><br>TILTERING</h6></b>
                <b><?php echo $row0['stage0'] ?></b>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon text-light" style="background-color:#27AE60;"><i>3</i></span>

              <div class="info-box-content">
              <?php
                $query0 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>50 AND (SELECT DATEDIFF(NOW(),pl1.date_monitored))<=60");
                $row0 = mysqli_fetch_assoc($query0); 
              ?>
                <b><h6><br>STEM ELONGATION</h6></b>
                <b><?php echo $row0['stage0'] ?></b>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>

  <h5 class="mb-2 text-primary">REPRODUCTIVE</h5>
  <div class="row">
          <div class="col-md-4 col-sm-8 col-12">
            <div class="info-box">
                <span class="info-box-icon text-light" style="background-color:#1D8348;"><i>4</i></span>

                <div class="info-box-content">
                <?php
                  $query0 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>60 AND (SELECT DATEDIFF(NOW(),pl1.date_monitored))<=70");
                  $row0 = mysqli_fetch_assoc($query0); 
                ?>
                  <b><h6>PANICLE INITIATION TO BOOTING</h6></b>
                  <b><?php echo $row0['stage0'] ?></b>
                </div>
              <!-- /.info-box-content -->
              
            </div>
            <!-- /.info-box -->
            
          </div>
          <!-- /.col -->
          <div class="col-md-4 col-sm-8 col-12">
            <div class="info-box">
              <span class="info-box-icon text-light" style="background-color:#239B56;"><i>5</i></span>

              <div class="info-box-content">
              <?php
                $query0 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>70 AND (SELECT DATEDIFF(NOW(),pl1.date_monitored))<=80");
                $row0 = mysqli_fetch_assoc($query0); 
              ?>
                <b><h6>HEADING</h6></b>
                <b><?php echo $row0['stage0'] ?></b>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-4 col-sm-8 col-12">
            <div class="info-box">
              <span class="info-box-icon text-light" style="background-color:#2ECC71;"><i>6</i></span>

              <div class="info-box-content">
              <?php
                $query0 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>80 AND (SELECT DATEDIFF(NOW(),pl1.date_monitored))<=90");
                $row0 = mysqli_fetch_assoc($query0); 
              ?>
                <b><h6>FLOWERING</h6></b>
                <b><?php echo $row0['stage0'] ?></b>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
    </div>
    <h5 class="mb-2 text-primary">RIPENING</h5>
    <div class="row">
          <div class="col-md-4 col-sm-8 col-12">
            <div class="info-box">
            <span class="info-box-icon text-light" style="background-color:#B7950B;"><i>7</i></span>
            <div class="info-box-content">
            <?php
              $query0 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>90 AND (SELECT DATEDIFF(NOW(),pl1.date_monitored))<=110");
              $row0 = mysqli_fetch_assoc($query0); 
            ?>
              <b><h6>MILK GRAIN</h6></b>
              <b><?php echo $row0['stage0'] ?></b>
            </div>
              <!-- /.info-box-content -->
              
            </div>
            <!-- /.info-box -->
            
          </div>
          <!-- /.col -->
          <div class="col-md-4 col-sm-8 col-12">
            <div class="info-box">
              <span class="info-box-icon text-light" style="background-color:#F1C40F;"><i>8</i></span>
              <div class="info-box-content">
              <?php
                $query0 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>110 AND (SELECT DATEDIFF(NOW(),pl1.date_monitored))<=120");
                $row0 = mysqli_fetch_assoc($query0); 
              ?>
                <b><h6>DOUGH GRAIN</h6></b>
                <b><?php echo $row0['stage0'] ?></b>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-4 col-sm-8 col-12">
            <div class="info-box">
            <span class="info-box-icon text-light" style="background-color:#F4D03F;"><i>9</i></span>
              <div class="info-box-content">
              <?php
                $query0 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>120");
                $row0 = mysqli_fetch_assoc($query0); 
              ?>
                <b><h6>MATURE GRAIN</h6></b>
                <b><?php echo $row0['stage0'] ?></b>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
      </div>
     <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++=--> 
      <div class="row">
      <div class="col-md-4">
      <div class="card">
              <div class="card-header bg-info">
                <h3 class="card-title">CROP STAGES</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Item</th>
                      <th>Status</th>
                      <th>Popularity</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR9842</a></td>
                      <td>Call of Duty IV</td>
                      <td><span class="badge badge-success">Shipped</span></td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR1848</a></td>
                      <td>Samsung Smart TV</td>
                      <td><span class="badge badge-warning">Pending</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR7429</a></td>
                      <td>iPhone 6 Plus</td>
                      <td><span class="badge badge-danger">Delivered</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR7429</a></td>
                      <td>Samsung Smart TV</td>
                      <td><span class="badge badge-info">Processing</span></td>
                      <td>
                        <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                      </td>
                    </tr>
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              
              <!-- /.card-footer -->
            </div>
    
        
      </div>
          <!-- /.col -->
          <div class="col-md-8">
          
          
          <div class="card">
              <div class="card-header bg-info" >
                <h3 class="card-title text-light ">RICE CROP MONITORING</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div clas="table-responsive">
                <table id="dataTables-example" class="table table-striped table-sm " style="text-align:center">
                    <thead class="bg-info">
                    <tr>
                      <th >DATE<br>PLANTED</th>
                      <th >AREA<br>PLANTED</th>
                      <th >DAS/DAT</th>
                      <th >DATE OF<br>HARVEST</th>
                      <th >STAGE</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $stage="";
                        $bgcolor="";
                      $query = mysqli_query($connection,"SELECT DISTINCT pl.date_monitored, 
                      (SELECT DATE_ADD(pl.date_monitored, INTERVAL 120 DAY) )dateharvest,
                      (SELECT DATEDIFF(NOW(),pl.date_monitored))numdate, 
                      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl1 WHERE pl.date_monitored=pl1.date_monitored)area, 
                      (SELECT CASE 
                      WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))>120 THEN '9' 
                      WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))>110 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=120 THEN '8' WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))>90 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=110 THEN '7' WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))>80 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=90 THEN '6' WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))>70 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=80 THEN '5' WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))>60 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=70 THEN '4' 
                      WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))>50 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=60 THEN '3' 
                      WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))>30 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=50 THEN '2' 
                      WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))>20 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=30 THEN '1' 
                      WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))<=20 THEN '0' END )stage FROM tbl_planting as pl");
                          while($row = mysqli_fetch_array($query)){ 
                              if($row['stage']==9) {
                                $bgcolor="style='background-color:#F4D03F;'";
                              }  
                              else if($row['stage']==8) {
                                $bgcolor="style='background-color:#F1C40F;'";
                              }
                              else if($row['stage']==7) {
                                $bgcolor="style='background-color:#B7950B;'";
                              }
                              else if($row['stage']==6) {
                                $bgcolor="style='background-color:#2ECC71;'";
                              }
                              else if($row['stage']==5) {
                                $bgcolor="style='background-color:#239B56;'";
                              }
                              else if($row['stage']==4) {
                                $bgcolor="style='background-color:#1D8348;'";
                              }
                              else if($row['stage']==3) {
                                $bgcolor="style='background-color:#27AE60;'";
                              }
                              else if($row['stage']==2) {
                                $bgcolor="style='background-color:#1E8449;'";
                              }
                              else if($row['stage']==1) {
                                $bgcolor="style='background-color:#196F3D;'";
                              }
                              else if($row['stage']==0) {
                                $bgcolor="style='background-color:#145A32;'";
                              }
                              else{
                                $bgcolor="style='background-color:#D6EAF8;'"; 
                              }
                      ?>  
                    <tr >
                    <td align="center"><?php echo date_format(date_create($row['date_monitored']),"F/d/Y"); ?></td>
                    <td align="center"><?php echo $row['area']; ?></td>
                    <td align="center"><?php echo $row['numdate']; ?></td>
                    <td align="center"><?php echo date_format(date_create($row['dateharvest']),"F/d/Y"); ?></td>
                    <td align="center"><span class='badge text-light' <?php echo $bgcolor; ?>><?php echo $row['stage']?></span></td>
                    </tr>
                    <?php
                          }
                    ?>
                    </tbody>
                  
                  </table>
                </div>
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

