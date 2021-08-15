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
  <title>CROP STAGE</title>
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
    //   $monitoring_nav_item="menu-open";
    //   $monitoring_nav_link="active";
      $cr_stage="active";
      require_once('sidebar.php')
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>RICE CROP STAGES</h1>
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
                        <table class="table   table-sm"  id="dataTables-example11" style="text-align:center; width:100%">
                            <thead style="background-color:#1B5E20;" class="text-light">
                                <tr>
                                    <th></th>
                                    <th>HECTARES</th>
                                    <th>PERCENTAGE</th>
                                    <th>YIELD</th>
                                    <th>PRODUCTION</th>       
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = mysqli_query($connection,"SELECT 
                                    (SELECT COALESCE(SUM(target), 0) FROM tbl_target as tr WHERE tr.program='HARVESTING' AND tr.season='".$season."' AND tr.year='".$seasonYear."')target, 
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (date_harvest BETWEEN '".$startdate."' AND '".$enddate."')  OR (date_monitored BETWEEN '".$startdate."' AND '".$enddate."'))area, 
                                    (((SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (date_harvest BETWEEN '".$startdate."' AND '".$enddate."')  OR (date_monitored BETWEEN '".$startdate."' AND '".$enddate."'))/(SELECT COALESCE(SUM(target), 0) FROM tbl_target as tr WHERE tr.program='HARVESTING' AND tr.season='".$season."' AND tr.year='".$seasonYear."'))*100)p_actual_planted,
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(NOW(),pl.date_monitored))>=0 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=60)vegetative_stage, 
                                    (( (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(NOW(),pl.date_monitored))>=0 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=60)/
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (date_harvest BETWEEN '".$startdate."' AND '".$enddate."')  OR (date_monitored BETWEEN '".$startdate."' AND '".$enddate."')))*100)p_vegetative,
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(NOW(),pl.date_monitored))>=0 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=3)germination, 
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(NOW(),pl.date_monitored))>3 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=20)seedling, 
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(NOW(),pl.date_monitored))>20 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=40)tiltering,
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(NOW(),pl.date_monitored))>40 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=60)stem_elongation,
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(NOW(),pl.date_monitored))>60 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=100)reproductive_stage,
                                    (( (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(NOW(),pl.date_monitored))>60 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=100)/
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (date_harvest BETWEEN '".$startdate."' AND '".$enddate."')  OR (date_monitored BETWEEN '".$startdate."' AND '".$enddate."')))*100)p_reproductive,
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(NOW(),pl.date_monitored))>60 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=80)pannicle,
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(NOW(),pl.date_monitored))>80 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=90)heading,
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(NOW(),pl.date_monitored))>90 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=100)flowering,
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(NOW(),pl.date_monitored))>100 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=115)ripening_stage,
                                    (((SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(NOW(),pl.date_monitored))>100 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=115)/
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (date_harvest BETWEEN '".$startdate."' AND '".$enddate."')  OR (date_monitored BETWEEN '".$startdate."' AND '".$enddate."')))*100)p_ripening,
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(NOW(),pl.date_monitored))>100 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=107)milk_grain,
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(NOW(),pl.date_monitored))>107 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=114)dough_grain,
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(NOW(),pl.date_monitored))>114 AND (SELECT DATEDIFF(NOW(),pl.date_monitored))<=115)mature_grain,
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(NOW(),pl.date_monitored))>115 AND (date_harvest BETWEEN '".$startdate."' AND '".$enddate."') )harvest_stage,
                                    (((SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(NOW(),pl.date_monitored))>115 AND (date_harvest BETWEEN '".$startdate."' AND '".$enddate."') )/
                                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (date_harvest BETWEEN '".$startdate."' AND '".$enddate."')  OR (date_monitored BETWEEN '".$startdate."' AND '".$enddate."')))*100)p_harvest,
                                    (SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."')H_area,
                                    (( (SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(target), 0) FROM tbl_target as tr WHERE tr.program='HARVESTING' AND tr.season='".$season."' AND tr.year='".$seasonYear."'))*100)p_actual_harvest,
                                    (SELECT COALESCE(SUM(production), 0) FROM tbl_harvesting as pl WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."')H_production,
                                    ((SELECT COALESCE(SUM(production), 0) FROM tbl_harvesting as pl WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."'))H_yield");
                                    $row = mysqli_fetch_assoc($query); 
                                ?>
                                <tr style="background-color:#A5D6A7;" class='text-dark'>
                                    <td class="text-left"><strong >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL TARGET AREA</strong></td>
                                    <td class="text-center"><b><?php echo number_format($row['target'],2); ?></b></td>
                                    <td class="text-center"><b></b></td>
                                    <td class="text-center"><b></b></td>
                                    <td class="text-center"><b></b></td>
                                </tr>
                                <tr style="background-color:#C5E1A5;" class='text-dark'> 
                                    <td class="text-left"><strong '>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL ACTUAL AREA PLANTED</strong></td>
                                    <td class="text-center"><b><?php echo number_format($row['area'],2); ?></b></td>
                                    <td class="text-center"><b><?php echo round($row['p_actual_planted']); ?>%</b></td>
                                    <td class="text-center"><b></b></td>
                                    <td class="text-center"><b></b></td>
                                </tr>
                                <tr style="background-color:#C8E6C9" class='text-dark'> 
                                    <td class="text-left"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NEWLY PLANTED/VEGETATIVE STAGE</strong></td>
                                    <td class="text-center"><b><?php echo number_format($row['vegetative_stage'],2); ?></b></td>
                                    <td class="text-center"><b><?php echo round($row['p_vegetative']); ?>%</b></td>
                                    <td class="text-center"><b></b></td>
                                    <td class="text-center"><b></b></td>
                                </tr>
                                <tr >
                                    <td class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0. GERMINATING OF EMERGENCE</td>
                                    <td class="text-center"><span class='badge text-light'style="background-color:#145A32;" ><?php echo number_format($row['germination'],2); ?></span></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
        
                                </tr>
                                <tr >
                                   
                                    <td class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. SEEDLING</td>
                                    <td class="text-center"><span class='badge text-light'style="background-color:#196F3D;" ><?php echo number_format($row['seedling'],2); ?></span></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    
                                </tr>
                                <tr >
                                   
                                    <td class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. TILLERING</td>
                                    <td class="text-center"><span class='badge text-light'style="background-color:#1E8449;" ><?php echo number_format($row['tiltering'],2); ?></span></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    
                                </tr>
                                <tr >
                                   
                                    <td class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. STEM ELONGATION</td>
                                    <td class="text-center"><span class='badge text-light'style="background-color:#27AE60;" ><?php echo number_format($row['stem_elongation'],2); ?></span></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    
                                </tr>
                                <tr style="background-color:#C8E6C9 ;" class='text-dark'>
                                    <td class="text-left"><strong class='text-dark'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REPRODUCTIVE STAGE</strong></td>
                                    <td class="text-center"><b><?php echo number_format($row['reproductive_stage'],2); ?></b></td>
                                    <td class="text-center"><b><?php echo round($row['p_reproductive']); ?>%</b></td>
                                    <td class="text-center"><b></b></td>
                                    <td class="text-center"><b></b></td>
                                </tr>
                                <tr >
                                    
                                    <td class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4. PANNICLE INITIATION TO BOOTING</td>
                                    <td class="text-center"><span class='badge text-light'style="background-color:#1D8348;" ><?php echo number_format($row['pannicle'],2); ?></span></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    
                                </tr>
                                <tr >
                                    
                                    <td class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5. HEADING</td>
                                    <td class="text-center"><span class='badge text-light'style="background-color:#239B56;" ><?php echo number_format($row['heading'],2); ?></span></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    
                                </tr>
                                <tr >
                                    
                                    <td class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6. FLOWERING</td>
                                    <td class="text-center"><span class='badge text-light'style="background-color:#2ECC71;" ><?php echo number_format($row['flowering'],2); ?></span></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    
                                </tr>
                                <tr style="background-color:#C8E6C9;" class='text-dark'>
                                    <td class="text-left"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RIPENING STAGE</strong></td>
                                    <td class="text-center"><b><?php echo number_format($row['ripening_stage'],2); ?></b></td>
                                    <td class="text-center"><b><?php echo round($row['p_ripening']); ?>%</b></td>
                                    <td class="text-center"><b></b></td>
                                    <td class="text-center"><b></b></td>
                                    
                                </tr>
                                <tr >
                                    
                                    <td class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7. MILK GRAIN</td>
                                    <td class="text-center"><span class='badge text-light'style="background-color:#B7950B;" ><?php echo number_format($row['milk_grain'],2); ?></span></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    
                                </tr>
                                <tr >
                                    
                                    <td class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8. DOUGH GRAIN</td>
                                    <td class="text-center"><span class='badge text-dark'style="background-color:#F1C40F;" ><?php echo number_format($row['dough_grain'],2); ?></span></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    
                                </tr>
                                <tr >
                                    
                                    <td class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9. MATURE GRAIN</td>
                                    <td class="text-center"><span class='badge text-dark'style="background-color:#F4D03F;" ><?php echo number_format($row['mature_grain'],2); ?></span></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    
                                </tr>
                                <tr style="background-color:#C8E6C9;" class='text-dark'>
                                    <td class="text-left"><strong >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HARVEST STAGE</strong></td>
                                    <td class="text-center"><b><?php echo number_format($row['harvest_stage'],2); ?></b></td>
                                    <td class="text-center"><b><?php echo round($row['p_harvest']); ?>%</b></td>
                                    <td class="text-center"><b></b></td>
                                    <td class="text-center"><b></b></td>
                                </tr>
                                <tr style="background-color:#C5E1A5;" class='text-dark'>
                                    <td class="text-left"><strong >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL ACTUAL AREA HARVESTED</strong></td>
                                    <td class="text-center"><b><?php echo number_format($row['H_area'],2); ?></b></td>
                                    <td class="text-center"><b><?php echo round($row['p_actual_harvest']); ?>%</b></td>
                                    <td class="text-center"><b><?php echo number_format($row['H_yield'],2); ?></b></td>
                                    <td class="text-center"><b><?php echo number_format($row['H_production'],2); ?></b></td>
                                </tr>
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
