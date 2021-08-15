<?php 
    $pagename="details_municipality";
    require('./session.php'); 
    require('./database.php');
    require('./season.php');
    require('./save_new_pass.php');
    require('./save_new_profile.php');
    require('./user_data.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $_GET['mun']; ?></title>
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
      $db="active";
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
                $queryMun=mysqli_query($connection,"SELECT * from tbl_municipality WHERE municipality='".$_GET['mun']."'");
                $rowMun=mysqli_fetch_assoc($queryMun);
                $municipality=$rowMun['municipality'];
                $mun_id=$rowMun['mun_id'];
            ?>
            <h1>Accomplishment Summary of <?php echo $municipality; ?></h1>
            <p><?php echo $season." SEASON ".$seasonYear."-".$year."| AS OF ".date_format(date_create($dateNow),"F d, Y");?></p>
            <a class="btn bg-gradient-info  btn-sm" href="dashboard.php">
                <i class="fas fa-angle-double-left"></i> Back
            </a>
          </div>
          <!-- <div class="col-sm-4">
            <a href="add_harvest_accomplishment.php" class="btn btn-sm bg-gradient-info float-right" data-toggle="modal" data-target="#addSeedTypeModal">
              <i class="fa fa-plus" aria-hidden="true"> </i> ADD ECOSYSTEM
            </a>
          </div> -->
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php
      $queryD = mysqli_query($connection,"SELECT 
      (SELECT  COALESCE(SUM(target), 0) FROM tbl_target as tr INNER JOIN tbl_municipality as mn ON tr.mun_id=mn.mun_id WHERE tr.program='PLANTING' AND tr.season='".$season."' AND year='".$seasonYear."' AND mn.mun_id='".$mun_id."' )target,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.mun_id='".$mun_id."')area, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.mun_id='".$mun_id."')farmer,
      (((SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.mun_id='".$mun_id."')/(SELECT  COALESCE(SUM(target), 0) FROM tbl_target as tr INNER JOIN tbl_municipality as mn ON tr.mun_id=mn.mun_id WHERE tr.program='PLANTING' AND tr.season='".$season."' AND year='".$seasonYear."' AND mn.mun_id='".$mun_id."' ))*100)percentage");
      $rowD = mysqli_fetch_array($queryD) ;


      $queryH = mysqli_query($connection,"SELECT 
      (SELECT  COALESCE(SUM(target), 0) FROM tbl_target as tr INNER JOIN tbl_municipality as mn ON tr.mun_id=mn.mun_id WHERE tr.program='HARVESTING' AND tr.season='".$season."' AND year='".$seasonYear."' AND mn.mun_id='".$mun_id."' )target,
      (SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.mun_id='".$mun_id."')area, 
      (SELECT COALESCE(SUM(production), 0) FROM tbl_harvesting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.mun_id='".$mun_id."')production,
      ((SELECT COALESCE(SUM(production), 0) FROM tbl_harvesting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.mun_id='".$mun_id."')/(SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.mun_id='".$mun_id."'))yield,
      (((SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.mun_id='".$mun_id."')/(SELECT  COALESCE(SUM(target), 0) FROM tbl_target as tr INNER JOIN tbl_municipality as mn ON tr.mun_id=mn.mun_id WHERE tr.program='HARVESTING' AND tr.season='".$season."' AND year='".$seasonYear."' AND mn.mun_id='".$mun_id."'))*100)percentageD");
      $rowH = mysqli_fetch_array($queryH);
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-success card-outline">
              <div class="card-body box-profile">
                <h4 class="text-primary text-left">PLANTING ACCOMPLISHMENT</h4>
                <p class="text-muted text-left">SUMMARY</p>
                <ul class="list-group list-group-unbordered mb-6">
                  <li class="list-group-item">
                    <b>Target</b> <a class="float-right"><?php echo number_format($rowD['target'],2); ?>  ha</a>
                  </li>
                  <li class="list-group-item">
                    <b>Area Planted</b> <a class="float-right"><?php echo number_format($rowD['area'],2); ?> ha</a>
                  </li>
                  <li class="list-group-item">
                    <b>Number of Farmers</b> <a class="float-right"><?php echo number_format($rowD['farmer'],0); ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Percentage</b> <a class="float-right"><?php echo round($rowD['percentage']); ?>%</a>
                  </li>
                  <li class="list-group-item">
                    <b>Remaining</b> <a class="float-right"><?php echo number_format(($rowD['target']-$rowD['area']),2); ?> ha</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card card-success card-outline">
              <div class="card-body box-profile">
                <h4 class="text-primary text-left">HARVEST ACCOMPLISHMENT</h4>
                <p class="text-muted text-left">SUMMARY</p>
                <ul class="list-group list-group-unbordered mb-6">
                  <li class="list-group-item">
                    <b>Target</b> <a class="float-right"><?php echo number_format($rowH['target'],2); ?>  ha</a>
                  </li>
                  <li class="list-group-item">
                    <b>Area Harvested</b> <a class="float-right"><?php echo number_format($rowH['area'],2); ?>  ha</a>
                  </li>
                  <li class="list-group-item">
                    <b>Production</b> <a class="float-right"><?php echo number_format($rowH['production'],2); ?>  mt</a>
                  </li>
                  <li class="list-group-item">
                    <b>Yield</b> <a class="float-right"><?php echo number_format($rowH['yield'],2); ?>  mt/ha</a>
                  </li>
                  <li class="list-group-item">
                    <b>Percenatage</b> <a class="float-right"><?php echo round($rowH['percentageD']); ?>%</a>
                  </li>
                  <li class="list-group-item">
                    <b>Remaining</b> <a class="float-right"><?php echo number_format(($rowH['target']-$rowH['area']),2); ?> ha</a>
                  </li>
                </ul>
              </div>
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