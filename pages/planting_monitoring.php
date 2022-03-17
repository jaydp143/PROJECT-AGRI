<?php 
    $pagename="planting_monitoring";  
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
  <title>PLANTING-MONITORING</title>
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

      $pl_monitoring_nav_item="menu-open";
      $pl_monitoring_nav_link="active";
      $pl_monitoring="active";
      require_once('sidebar.php');
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>PLANTING MONITORING ACCOMPLISHMENT</h1>
            <p><?php echo $season." SEASON ".$seasonYear."-".$year."| AS OF ".date_format(date_create($dateNow),"F d, Y");?></p>
          </div>
          <!-- <div class="col-sm-4">
            <a href="add_planting_accomplishment.php" class="btn bg-gradient-info float-right" >
              <i class="fa fa-plus" aria-hidden="true"> </i> ADD ACCOMPLISHMENT
            </a>
          </div> -->
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

       <!-- /.div for FORM -->
       <div class="row">
            <form method="POST">
                <div class="pull-right">
                    <div class="form-row">
                        <!--display year combobox -->
                        <div class="form-group">
                            <div class="col-auto">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-light" style="background-color:#004d00;"><b>SEASON:</b></div>
                                    </div>
                                        <input type="text" list="season_list" id="display_season" name="rp_season" class="form-control display_season" autocomplete="off" />
                                        <datalist class="season_list" id="season_list">
                                            <option value="WET">WET</option>
                                            <option value="DRY">DRY</option>
                                        </datalist>
                                </div>
                            </div>
                        </div><!-- end display year combobox -->
                        <!--display year combobox -->
                        <div class="form-group">
                            <div class="col-auto">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-light" style="background-color:#004d00;"><b>YEAR:</b></div>
                                    </div>
                                    
                                        <input type="text" list="year_list" id="display_year" name="rp_year" class="form-control display_year" autocomplete="off" />
                                        <datalist class="year_list" id="year_list">
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                        </datalist>
                                </div>
                            </div>
                        </div><!-- end display year combobox -->

                        <!--display generate button -->
                        <div class="form-group">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-danger btn-block" id="btn_filter" name="btn_filter"><i class="fas fa-filter"></i><b> FILTER</b></button>
                            </div>
                        </div><!-- end display generate button -->


                    </div>
                </div>
            </form>
        </div>
        <?php
        if (isset($_POST['btn_filter'])) {
          $seasonYear=$_POST['rp_year'];
          $season=$_POST['rp_season'];
          if($season=="WET"){
            $startdate=date('Y-m-d', strtotime("03/16/".$seasonYear));
            $enddate=date('Y-m-d', strtotime("09/15/".$seasonYear));
          }
          if($season=="DRY"){
            $startdate=date('Y-m-d', strtotime("09/16/".$seasonYear));
            $enddate=date('Y-m-d', strtotime("03/15/".($seasonYear+1)));
          }
        ?>
        <div class="row">  
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped table-sm "  id="dataTables-example" style="text-align:center; width:100%">
                <thead style="background-color:#1B5E20;" class="text-light">
                  <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 15%">PROVINCE/<br>DISTRICT/<br>MUNICIPALITY<br></th>
                    <th style="width: 15%">TARGET<br> </th>
                    <th style="width: 15%">AREA<br>PLANTED<br>(ha)</th>
                    <th style="width: 15%">NO. OF<br>FARMERS</th>
                    <th style="width: 15%">Progress<br> </th>
                    <th style="width: 10%">%</th>
                    <th style="width: 10%">BALANCE</th>
                  </tr>
                </thead>
                <tbody>

                  
                  <?php
                    //PANGASINAN
                   
                   
                   echo '<tr style="background-color:#A5D6A7 ";>';
                    $queryP = mysqli_query($connection,"SELECT 
                    (SELECT COALESCE(SUM(target), 0) FROM tbl_target as tr WHERE tr.program='PLANTING' AND tr.season='".$season."' AND year='".$seasonYear."' )target,
                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."')tarea,
                    (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."')tfarmer, 
                    (((SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(target), 0) FROM tbl_target as tr WHERE tr.program='PLANTING' AND tr.season='".$season."' AND year='".$seasonYear."' ))*100)percentage");
                    
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
                      echo'<td><b>'.number_format($row1['tfarmer'],2).'</b></td>';
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
                      (SELECT  COALESCE(SUM(target), 0) FROM tbl_target as tr INNER JOIN tbl_municipality as mn ON tr.mun_id=mn.mun_id WHERE tr.program='PLANTING' AND tr.season='".$season."' AND year='".$seasonYear."' AND mn.district='".$x."' )target,
                      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area, 
                      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')farmer,
                      (((SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')/(SELECT  COALESCE(SUM(target), 0) FROM tbl_target as tr INNER JOIN tbl_municipality as mn ON tr.mun_id=mn.mun_id WHERE tr.program='PLANTING' AND tr.season='".$season."' AND year='".$seasonYear."' AND mn.district='".$x."' ))*100)percentageD");
                      
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
                        echo'<td><b>'.number_format($rowD['farmer'],2).'</b></td>';
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
                        (SELECT target FROM tbl_target as tr WHERE tr.mun_id=mn.mun_id AND tr.program='PLANTING'AND tr.season='".$season."' AND year='".$seasonYear."')target,
                        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND   date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area, 
                        (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')farmer,
                        (((SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND   date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT target FROM tbl_target as tr WHERE tr.mun_id=mn.mun_id AND tr.program='PLANTING' AND tr.season='".$season."' AND year='".$seasonYear."'))*100) percentageM
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
                              }
                              else if (round($row['percentageM'])>100){
                                  $br="bg-danger";
                              }
                              else{
                                  $br="";
                              }


                              echo'<tr>';
                              echo'<td>'.$row['mun_id'].'</td>'; 
                              echo"<td><a  href='planting_municipality.php?mun_id=".$row['mun_id']."'>".$row['municipality']."</a></td>"; 
                              echo'<td>'.number_format($row['target'],2).'</td>';
                              echo'<td>'.number_format($row['area'],2).'</td>';
                              echo'<td>'.number_format($row['farmer'],2).'</td>';
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
        <?php
        }else{
        ?>
        <div class="row">  
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped table-sm "  id="dataTables-example" style="text-align:center; width:100%">
                <thead style="background-color:#1B5E20;" class="text-light">
                  <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 15%">PROVINCE/<br>DISTRICT/<br>MUNICIPALITY<br></th>
                    <th style="width: 15%">TARGET<br> </th>
                    <th style="width: 15%">AREA<br>PLANTED<br>(ha)</th>
                    <th style="width: 15%">NO. OF<br>FARMERS</th>
                    <th style="width: 15%">Progress<br> </th>
                    <th style="width: 10%">%</th>
                    <th style="width: 10%">BALANCE</th>
                  </tr>
                </thead>
                <tbody>

                  
                  <?php
                    //PANGASINAN
                   
                   
                   echo '<tr style="background-color:#A5D6A7 ";>';
                    $queryP = mysqli_query($connection,"SELECT 
                    (SELECT COALESCE(SUM(target), 0) FROM tbl_target as tr WHERE tr.program='PLANTING' AND tr.season='".$season."' AND year='".$seasonYear."' )target,
                    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."')tarea,
                    (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."')tfarmer, 
                    (((SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(target), 0) FROM tbl_target as tr WHERE tr.program='PLANTING' AND tr.season='".$season."' AND year='".$seasonYear."' ))*100)percentage");
                    
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
                      echo'<td><b>'.number_format($row1['tfarmer'],2).'</b></td>';
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
                      (SELECT  COALESCE(SUM(target), 0) FROM tbl_target as tr INNER JOIN tbl_municipality as mn ON tr.mun_id=mn.mun_id WHERE tr.program='PLANTING' AND tr.season='".$season."' AND year='".$seasonYear."' AND mn.district='".$x."' )target,
                      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area, 
                      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')farmer,
                      (((SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')/(SELECT  COALESCE(SUM(target), 0) FROM tbl_target as tr INNER JOIN tbl_municipality as mn ON tr.mun_id=mn.mun_id WHERE tr.program='PLANTING' AND tr.season='".$season."' AND year='".$seasonYear."' AND mn.district='".$x."' ))*100)percentageD");
                      
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
                        echo'<td><b>'.number_format($rowD['farmer'],2).'</b></td>';
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
                        (SELECT target FROM tbl_target as tr WHERE tr.mun_id=mn.mun_id AND tr.program='PLANTING'AND tr.season='".$season."' AND year='".$seasonYear."')target,
                        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND   date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area, 
                        (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')farmer,
                        (((SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND   date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT target FROM tbl_target as tr WHERE tr.mun_id=mn.mun_id AND tr.program='PLANTING' AND tr.season='".$season."' AND year='".$seasonYear."'))*100) percentageM
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
                              }
                              else if (round($row['percentageM'])>100){
                                  $br="bg-danger";
                              }
                              else{
                                  $br="";
                              }


                              echo'<tr>';
                              echo'<td>'.$row['mun_id'].'</td>'; 
                              echo"<td><a  href='planting_municipality.php?mun_id=".$row['mun_id']."'>".$row['municipality']."</a></td>"; 
                              echo'<td>'.number_format($row['target'],2).'</td>';
                              echo'<td>'.number_format($row['area'],2).'</td>';
                              echo'<td>'.number_format($row['farmer'],2).'</td>';
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
        <?php
        }
        ?>
        
        <!-- /.end div for FORM -->
        
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
