<?php 
    $pagename="harvest_monitoring";  
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
  <title>CROP SCHEDULE</title>
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
    //   $monitoring_nav_item="menu-open";
    //   $monitoring_nav_link="active";
      $cr_sched="active";
      require_once('sidebar.php')
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>RICE CROP SCHEDULE</h1>
            <p><?php echo $season." SEASON ".$seasonYear."-".$year."| AS OF ".date_format(date_create($dateNow),"F d, Y");?></p>
          </div>
          <!-- <div class="col-sm-4">
            <a href="add_harvest_accomplishment.php" class="btn btn-sm bg-gradient-info float-right" >
              <i class="fa fa-plus" aria-hidden="true"> </i> ADD ACCOMPLISHMENT
            </a>
          </div> -->
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">  
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm"  id="dataTables-example" style="text-align:center; width:100%">
                            <thead style="background-color:#1B5E20;" class="text-light">
                                <tr>
                                
                                    <th >DATE<br>PLANTED</th>
                                    <th >AREA<br>PLANTED</th>
                                    <th >DATE OF<br>HARVEST</th>
                                    <th >DAS/DAT</th>
                                    <th >STAGE</th>
                                            
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $stage="";
                                $bgcolor="";
                                $query = mysqli_query($connection,"SELECT DISTINCT pl.date_monitored, 
                                (SELECT DATE_ADD(pl.date_monitored, INTERVAL 115 DAY) )dateharvest,
                                (SELECT DATEDIFF(NOW(),pl.date_monitored))numdate, 
                                (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl1 WHERE pl.date_monitored=pl1.date_monitored)area, 
                                (SELECT CASE 
                                WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))=115  THEN 'MATURE GRAIN' 
                                WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))>107 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=114 THEN 'DOUGH GRAIN' 
                                WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))>100 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=107 THEN 'MILK GRAIN' 
                                WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))>90 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=100 THEN 'FLOWERING' 
                                WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))>80 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=90 THEN 'HEADING' 
                                WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))>60 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=80 THEN 'PANNICLE INNITATION TO BOOTING' 
                                WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))>40 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=60 THEN 'STEM ELONGATION' 
                                WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))>20 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=40 THEN 'TILTERING' 
                                WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))>3 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=20 THEN 'SEEDLING' 
                                WHEN (SELECT DATEDIFF(NOW(),pl.date_monitored))>=0 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=3 THEN 'GERMINATION OF EMERGENCE' END )stage FROM tbl_planting as pl");
                                while($row = mysqli_fetch_array($query)){ 
                                    if($row['stage']=='MATURE GRAIN') {
                                        $bgcolor="style='background-color:#F4D03F;'";
                                    }  
                                    else if($row['stage']=='DOUGH GRAIN') {
                                        $bgcolor="style='background-color:#F1C40F;'";
                                    }
                                    else if($row['stage']=='MILK GRAIN') {
                                        $bgcolor="style='background-color:#B7950B;'";
                                    }
                                    else if($row['stage']=='FLOWERING') {
                                        $bgcolor="style='background-color:#2ECC71;'";
                                    }
                                    else if($row['stage']=='HEADING') {
                                        $bgcolor="style='background-color:#239B56;'";
                                    }
                                    else if($row['stage']=='PANNICLE INNITATION TO BOOTING') {
                                        $bgcolor="style='background-color:#1D8348;'";
                                    }
                                    else if($row['stage']=='STEM ELONGATION') {
                                        $bgcolor="style='background-color:#27AE60;'";
                                    }
                                    else if($row['stage']=='TILTERING' ) {
                                        $bgcolor="style='background-color:#1E8449;'";
                                    }
                                    else if($row['stage']=='SEEDLING') {
                                        $bgcolor="style='background-color:#196F3D;'";
                                    }
                                    else if($row['stage']=='GERMINATION OF EMERGENCE') {
                                        $bgcolor="style='background-color:#145A32;'";
                                    }
                                    else{
                                        $bgcolor="style='background-color:#D6EAF8;'"; 
                                    }
                            ?>  
                                <tr >
                                    <td align="center"><?php echo"<a href='crop_schedule_date.php?date_sched=".$row['date_monitored']."'>".  date_format(date_create($row['date_monitored']),"F d,Y")."</a>"; ?></td>
                                    <td align="center"><?php echo number_format($row['area'],2); ?></td>
                                    <td align="center"><?php echo date_format(date_create($row['dateharvest']),"F d,Y"); ?></td>
                                    <td align="center"><?php echo $row['numdate']; ?>/115</td>
                                    <td align="center"><span class='badge text-light' <?php echo $bgcolor; ?>><?php echo $row['stage']?></span></td>
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
