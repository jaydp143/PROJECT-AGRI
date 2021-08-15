<?php  
    $pagename="crop_monitoring";
    require('./session.php'); 
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
        if ($area1!=0 && $production1!=0){
            mysqli_query($connection,"INSERT INTO tbl_harvesting (mun_id,seed_id, seed_type_id, eco_id, season, area, yield, production, date_monitored, user) VALUES ('$municipality', '$seed', '$seed_type', '$ecosystem1', '$season', '$area1', '$yield1','$production1', '$date_monitored', '$user')");
        }
       
        if ($area2!=0 && $production2!=0){
          mysqli_query($connection,"INSERT INTO tbl_harvesting (mun_id,seed_id, seed_type_id, eco_id, season, area, yield, production, date_monitored, user) VALUES ('$municipality', '$seed', '$seed_type', '$ecosystem2', '$season', '$area2', '$yield2','$production2', '$date_monitored', '$user')");
        }

        if ($area3!=0 && $production3!=0){
          mysqli_query($connection,"INSERT INTO tbl_harvesting (mun_id,seed_id, seed_type_id, eco_id, season, area, yield, production, date_monitored, user) VALUES ('$municipality', '$seed', '$seed_type', '$ecosystem3', '$season', '$area3', '$yield3','$production3', '$date_monitored', '$user')");
        }
        
       
       
        echo "
            <script type='text/javascript'>
                alert('You have Successfully Added');
                window.location.href = 'harvest_monitoring.php';
            </script>";
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RICE CROP MONITORING</title>
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
        $monitoring_nav_item="menu-open";
        $monitoring_nav_link="active";
        $cr_monitoring="active";
         require_once('sidebar.php')
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-8">
                <h1>RICE CROP MONITORING</h1>
            </div>
            <!-- <div class="col-sm-4">
                <button type="button" class="btn bg-gradient-info float-right" data-toggle="modal" data-target="#addModal">
                <i class="fa fa-plus" aria-hidden="true"> </i> ADD ACCOMPLISHMENT
                </button>
            </div> -->
            
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-5">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h3 class="card-title">CROP STAGES</h3>
                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0 table-sm table-striped">
                                        
                                        <tbody>
                                            <tr>
                                                <td colspan="2"class="text-center"><strong class='text-primary'>VEGETATTIVE</strong></td>
                                            </tr>
                                            <tr>
                                                <?php
                                                    $query0 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>3 AND (SELECT DATEDIFF(NOW(),pl1.date_monitored))<=20");
                                                    $row0 = mysqli_fetch_assoc($query0); 
                                                ?>
                                                <td>0. GERMINATING OF EMERGENCE</td>
                                                <td align="center"><span class='badge text-light'style="background-color:#145A32;" ><?php echo number_format($row0['stage0'],2); ?></span></td>
                                            </tr>
                                            <tr>
                                                <?php
                                                    $query1 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>20 AND (SELECT DATEDIFF(NOW(),pl1.date_monitored))<=30");
                                                    $row1 = mysqli_fetch_assoc($query1); 
                                                ?>
                                                <td>1. SEEDLING</td>
                                                <td align="center"><span class='badge text-light'style="background-color:#196F3D;" ><?php echo number_format($row1['stage0'],2); ?></span></td>
                                            </tr>
                                            <tr>
                                                <?php
                                                    $query2 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>30 AND (SELECT DATEDIFF(NOW(),pl1.date_monitored))<=50");
                                                    $row2 = mysqli_fetch_assoc($query2); 
                                                ?>
                                                <td>2. TILTERING</td>
                                                <td align="center"><span class='badge text-light'style="background-color:#1E8449;" ><?php echo number_format($row2['stage0'],2); ?></span></td>
                                            </tr>
                                            <tr>
                                                <?php
                                                    $query3 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>50 AND (SELECT DATEDIFF(NOW(),pl1.date_monitored))<=60");
                                                    $row3 = mysqli_fetch_assoc($query3); 
                                                ?>
                                                <td>3. STEM ELONGATION</td>
                                                <td align="center"><span class='badge text-light'style="background-color:#27AE60;" ><?php echo number_format($row3['stage0'],2); ?></span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"class="text-center"><strong class='text-primary'>REPRODUCTIVE</strong></td>
                                            </tr>
                                            <tr>
                                                <?php
                                                    $query4 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>60 AND (SELECT DATEDIFF(NOW(),pl1.date_monitored))<=70");
                                                    $row4 = mysqli_fetch_assoc($query4); 
                                                ?>
                                                <td>4. PANNICLE INITIATION TO BOOTING</td>
                                                <td align="center"><span class='badge text-light'style="background-color:#1D8348;" ><?php echo number_format($row4['stage0'],2); ?></span></td>
                                            </tr>
                                            <tr>
                                                <?php
                                                    $query5 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>70 AND (SELECT DATEDIFF(NOW(),pl1.date_monitored))<=80");
                                                    $row5 = mysqli_fetch_assoc($query5); 
                                                ?>
                                                <td>5. HEADING</td>
                                                <td align="center"><span class='badge text-light'style="background-color:#239B56;" ><?php echo number_format($row5['stage0'],2); ?></span></td>
                                            </tr>
                                            <tr>
                                                <?php
                                                    $query6 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>80 AND (SELECT DATEDIFF(NOW(),pl1.date_monitored))<=90");
                                                    $row6 = mysqli_fetch_assoc($query6); 
                                                ?>
                                                <td>6. FLOWERING</td>
                                                <td align="center"><span class='badge text-light'style="background-color:#2ECC71;" ><?php echo number_format($row6['stage0'],2); ?></span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"class="text-center"><strong class='text-primary'>RIPENING</strong></td>
                                            </tr>
                                            <tr>
                                                <?php
                                                    $query7 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>90 AND (SELECT DATEDIFF(NOW(),pl1.date_monitored))<=110");
                                                    $row7 = mysqli_fetch_assoc($query7); 
                                                ?>
                                                <td>7. MILK GRAIN</td>
                                                <td align="center"><span class='badge text-light'style="background-color:#B7950B;" ><?php echo number_format($row7['stage0'],2); ?></span></td>
                                            </tr>
                                            <tr>
                                                <?php
                                                    $query8 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>110 AND (SELECT DATEDIFF(NOW(),pl1.date_monitored))<=120");
                                                    $row8 = mysqli_fetch_assoc($query8); 
                                                ?>
                                                <td>8. DOUGH GRAIN</td>
                                                <td align="center"><span class='badge text-dark'style="background-color:#F1C40F;" ><?php echo number_format($row8['stage0'],2); ?></span></td>
                                            </tr>
                                            <tr>
                                                <?php
                                                    $query9 = mysqli_query($connection,"SELECT COALESCE(SUM(areas), 0) as stage0 FROM tbl_planting as pl1 WHERE (SELECT DATEDIFF(NOW(),pl1.date_monitored))>120");
                                                    $row9 = mysqli_fetch_assoc($query9); 
                                                ?>
                                                <td>9. MATURE GRAIN</td>
                                                <td align="center"><span class='badge text-dark'style="background-color:#F4D03F;" ><?php echo number_format($row9['stage0'],2); ?></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header bg-info" >
                                <h3 class="card-title text-light ">RICE CROP HARVEST SCHEDULE</h3>
                            </div>
                            <div class="card-body">
                                <div clas="table-responsive">
                                    <table id="dataTables-example" class="table table-striped table-sm " style="text-align:center; width:100%">
                                        <thead class="bg-info">
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
                                                    <td align="center"><?php echo number_format($row['area'],2); ?></td>
                                                    <td align="center"><?php echo date_format(date_create($row['dateharvest']),"F/d/Y"); ?></td>
                                                    <td align="center"><?php echo $row['numdate']; ?>/120</td>
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
