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
  <title>HARVEST-MONITORING</title>
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
      $hr_monitoring_nav_item="menu-open";
      $hr_monitoring_nav_link="active";
      $hr_monitoring="active";
      require_once('sidebar.php')
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>HARVEST MONITORING ACCOMPLISHMENT</h1>
            <p><?php echo $season." SEASON ".$seasonYear."-".$year."| AS OF ".date_format(date_create($dateNow),"F d, Y");?></p>
          </div>
          <div class="col-sm-4">
            <a href="add_harvest_accomplishment.php" class="btn btn-sm bg-gradient-info float-right" >
              <i class="fa fa-plus" aria-hidden="true"> </i> ADD ACCOMPLISHMENT
            </a>
          </div>
          
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
                                    <th style="width: 5%">#</th>
                                    <th style="width: 13%">MUNICIPALITY<br></th>
                                    <th style="width: 13%">TARGET<br> </th>
                                    <th style="width: 13%">AREA</th>
                                    <th style="width: 13%">YIELD</th>
                                    <th style="width: 13%">PRODUCTION</th>
                                    <th style="width: 13%">Progress<br> </th>
                                    <th style="width: 5%">%</th>
                                    <th style="width: 12%">BALANCE</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                                  //PANGASINAN
                                echo '<tr style="background-color:#A5D6A7 ";>';
                                  $queryP = mysqli_query($connection,"SELECT 
                                  (SELECT COALESCE(SUM(target), 0) FROM tbl_target as tr WHERE tr.program='HARVESTING' AND tr.season='".$season."' AND year='".$seasonYear."' )target,
                                  (SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."')tarea,
                                  (SELECT COALESCE(SUM(production), 0) FROM tbl_harvesting as pl WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."')tproduction, 
                                  ((SELECT COALESCE(SUM(production), 0) FROM tbl_harvesting as pl WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."'))tyield,
                                  (((SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(target), 0) FROM tbl_target as tr WHERE tr.program='HARVESTING' AND tr.season='".$season."' AND year='".$seasonYear."' ))*100)percentage");
                                  
                                  while($row1 = mysqli_fetch_array($queryP)){ 

                                      
                                    if (round($row1['percentage'])<=100 && round($row1['percentage'])>75){
                                      $br="bg-success";
                                    }
                                    else if (round($row1['percentage'])<=75 && round($row1['percentage'])>50){
                                        $br="bg-warning";
                                    }
                                    else if (round($row1['percentage'])<=50 && round($row1['percentage'])>25){
                                        $br="bg-primary";
                                    }
                                    else if (round($row1['percentage'])<=25 &&  round($row1['percentage'])>=1){
                                        $br="bg-info";
                                    }else if (round($row1['percentage'])>100){
                                        $br="bg-danger";
                                    }
                                    else{
                                        $br="";
                                    }

                                    echo '<td colspan="2"><b>PANGASINAN</b></td>';
                                    echo '<td><b>'.number_format($row1['target'],2).'</b></td>';
                                    echo'<td><b>'.number_format($row1['tarea'],2).'</b></td>';
                                    echo'<td><b>'.number_format($row1['tyield'],2).'</b></td>';
                                    echo'<td><b>'.number_format($row1['tproduction'],2).'</b></td>';
                                    echo'<td>
                                        <div class="progress progress-xs">
                                          <div class="progress-bar '.$br.'" style="width: '.round($row1['percentage']).'%"></div>
                                      </div>
                                    </td>';
                                    echo"<td><span class='badge ".$br."'>".round($row1['percentage'])."%</span></td>";
                                  echo'<td><b>'.number_format(($row1['target']-$row1['tarea']),2).'</b></td>';
                                    
                                    }
                                    echo'</tr>';
                                  for($x=1;$x<=6;$x++){
                                      //PER DISTRICT
                                    echo'<tr style="background-color:#C5E1A5";>';
                                    $queryD = mysqli_query($connection,"SELECT 
                                    (SELECT  COALESCE(SUM(target), 0) FROM tbl_target as tr INNER JOIN tbl_municipality as mn ON tr.mun_id=mn.mun_id WHERE tr.program='HARVESTING' AND tr.season='".$season."' AND year='".$seasonYear."' AND mn.district='".$x."' )target,
                                    (SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area, 
                                    (SELECT COALESCE(SUM(production), 0) FROM tbl_harvesting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')production,
                                    ((SELECT COALESCE(SUM(production), 0) FROM tbl_harvesting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')/(SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."'))yield,
                                    (((SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')/(SELECT  COALESCE(SUM(target), 0) FROM tbl_target as tr INNER JOIN tbl_municipality as mn ON tr.mun_id=mn.mun_id WHERE tr.program='HARVESTING' AND tr.season='".$season."' AND year='".$seasonYear."' AND mn.district='".$x."' ))*100)percentageD");
                                    
                                    while($rowD = mysqli_fetch_array($queryD)){ 


                                      if (round($rowD['percentageD'])<=100 && round($rowD['percentageD'])>75){
                                        $br="bg-success";
                                      }
                                      else if (round($rowD['percentageD'])<=75 && round($rowD['percentageD'])>50){
                                          $br="bg-warning";
                                      }
                                      else if (round($rowD['percentageD'])<=50 && round($rowD['percentageD'])>25){
                                          $br="bg-primary";
                                      }
                                      else if (round($rowD['percentageD'])<=25 &&  round($rowD['percentageD'])>=1){
                                          $br="bg-info";
                                      }else if (round($rowD['percentageD'])>100){
                                          $br="bg-danger";
                                      }
                                      else{
                                          $br="";
                                      }


                                      echo'<td colspan="2"><b>DISTRICT '.$x.'</b></td>';
                                      echo'<td><b>'.number_format($rowD['target'],2).'</b></td>';
                                      echo'<td><b>'.number_format($rowD['area'],2).'</b></td>';
                                      echo'<td><b>'.number_format($rowD['yield'],2).'</b></td>';
                                      echo'<td><b>'.number_format($rowD['production'],2).'</b></td>';
                                      echo'<td>
                                        <div class="progress progress-xs">
                                          <div class="progress-bar '.$br.'" style="width: '.round($rowD['percentageD']).'%"></div>
                                      </div>
                                    </td>';
                                    echo"<td><span class='badge ".$br."'>".round($rowD['percentageD'])."%</span></td>";
                                      echo'<td><b>'.number_format(($rowD['target']-$rowD['area']),2).'</b></td>';
                                      }
                                      echo'</tr>';
                              
                                  
                                      $queryR = mysqli_query($connection,"SELECT mn.mun_id,mn.municipality, 
                                      (SELECT target FROM tbl_target as tr WHERE tr.mun_id=mn.mun_id AND tr.program='HARVESTING'AND tr.season='".$season."' AND year='".$seasonYear."')target,
                                      (SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl WHERE pl.mun_id=mn.mun_id AND   date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area, 
                                      (SELECT COALESCE(SUM(production), 0) FROM tbl_harvesting as pl WHERE pl.mun_id=mn.mun_id AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')production,
                                      ((SELECT COALESCE(SUM(production), 0) FROM tbl_harvesting as pl WHERE pl.mun_id=mn.mun_id AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl WHERE pl.mun_id=mn.mun_id AND   date_monitored BETWEEN '".$startdate."' AND '".$enddate."'))yield,
                                      (((SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl WHERE pl.mun_id=mn.mun_id AND   date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT target FROM tbl_target as tr WHERE tr.mun_id=mn.mun_id AND tr.program='HARVESTING' AND tr.season='".$season."' AND year='".$seasonYear."'))*100) percentageM
                                      FROM tbl_municipality as mn WHERE mn.district='".$x."' ORDER BY  mn.mun_id ASC;");
                                      
                                        while($row=mysqli_fetch_array($queryR)){


                                            if (round($row['percentageM'])<=100 && round($row['percentageM'])>75){
                                              $br="bg-success";
                                            }
                                            else if (round($row['percentageM'])<=75 && round($row['percentageM'])>50){
                                                $br="bg-warning";
                                            }
                                            else if (round($row['percentageM'])<=50 && round($row['percentageM'])>25){
                                                $br="bg-primary";
                                            }
                                            else if (round($row['percentageM'])<=25 &&  round($row['percentageM'])>=1){
                                                $br="bg-info";
                                            }else if (round($row['percentageM'])>100){
                                                $br="bg-danger";
                                            }
                                            else{
                                                $br="";
                                            }


                                            echo'<tr>';
                                            echo'<td>'.$row['mun_id'].'</td>'; 
                                            echo"<td><a  href='HARVESTING_municipality.php?mun_id=".$row['mun_id']."'>".$row['municipality']."</a></td>"; 
                                            echo'<td>'.number_format($row['target'],2).'</td>';
                                            echo'<td>'.number_format($row['area'],2).'</td>';
                                            echo'<td>'.number_format($row['yield'],2).'</td>';
                                            echo'<td>'.number_format($row['production'],2).'</td>';
                                            echo'<td>
                                                <div class="progress progress-xs">
                                                  <div class="progress-bar '.$br.'" style="width: '.round($row['percentageM']).'%"></div>
                                              </div>
                                            </td>';
                                            echo"<td><span class='badge ".$br."'>".round($row['percentageM'])."%</span></td>";
                                            echo'<td>'.number_format(($row['target']-$row['area']),2).'</td>';
                                            echo'</tr>';
                                        }
                              
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
