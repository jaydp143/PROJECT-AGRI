<?php 
    $pagename="harvest_monitoring";  
    require('./session.php'); 
    require('./database.php');
    require('./season.php');
    require('./save_new_pass.php');
    require('./save_new_profile.php');
    require('./user_data.php');
?>

<?php 
  if (isset($_POST['btn_save'])) {
    
    
    $damage_cause = $_POST['damage_cause'];
    $date_occurence = $_POST['date_occurence'];
    $end_calamity=$_POST['end_calamity'];
    $mun_id=$_POST['mun_id'];
    $farmers=$_POST['farmers'];
    $eco_id=$_POST['eco_id'];
    $area_standing=$_POST['area_standing'];
    $stage_id=$_POST['stage_id'];
    $date_harvest=$_POST['date_harvest'];
    $area_totally_damage=$_POST['area_totally_damage'];
    $area_partially_damage=$_POST['area_partially_damage'];
    $yield_before=$_POST['yield_before'];
    $yield_after=$_POST['yield_after'];
    $transaction_date=$dateNow;
    $username = mysqli_real_escape_string($connection,$_SESSION['username']);
    
    mysqli_query($connection,"INSERT INTO tbl_damage (calamity_id, date_occurence, end_calamity, mun_id, farmers, eco_id, area_standing, stage_id, date_harvest, area_totally_damage, area_partially_damage, yield_before, yield_after, transaction_date, user ) VALUES ('$damage_cause','$date_occurence', '$end_calamity', '$mun_id', '$farmers', '$eco_id','$area_standing', '$stage_id','$date_harvest', '$area_totally_damage','$area_partially_damage', '$yield_before', '$yield_after', '$transaction_date', '$username')");


    echo"
      <script type='text/javascript'>
        alert('You Have Successfully Add Damage Information');
        open('damage_monitoring.php','_self');
      </script>
     ";
  
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DAMAGE_ASSESSMENT</title>
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
      // $monitoring_nav_item="menu-open";
      // $monitoring_nav_link="active";
      $dm_ass="active";
      require_once('sidebar.php')
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>DAMAGE ASSESSMENT RECORD</h1>
            <p><?php echo $season." SEASON ".$seasonYear."-".$year."| AS OF ".date_format(date_create($dateNow),"F d, Y");?></p>
          </div>
          <div class="col-sm-4">
          <a  class="btn bg-gradient-info float-right" data-toggle="modal" data-target="#add_damage_modal">
              <i class="fa fa-plus" aria-hidden="true"> </i> ADD DAMAGE ASSESSMENT
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
                                    <th >#</th>
                                    <th >MUNICIPALITY</th>
                                    <th >ECOSYSTEM </th>
                                    <th >DAMAGE CAUSE</th>
                                    <th >DATE OCCURENCE</th>
                                    <th >TOTAL AREA DAMAGED </th>
                                    <th >% YIELD LOSS </th>
                                    <!-- <th >farmersS AFFECTED</th>
                                    <th >AREA OF STANDING</th>
                                    <th >AREA OF TOTALLY DAMAGE</th>
                                    <th >AREA OF PARTIALLY DAMAGE</th>
                                    <th >YIELD BEFORE CALAMITY</th>
                                    <th >YIELD AFTER CALAMITY</th>
                                    <th >STAGE OF DEVELOPMENT</th>
                                    <th >HARVEST DATE </th> -->
                                    
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                                  //PANGASINAN
                                
                                  $queryP = mysqli_query($connection,"SELECT dm.damage_id, dm.end_calamity, dm.area_standing, dm.date_harvest, dm.calamity_id, dm.date_occurence,
                                  dm.area_partially_damage, dm.area_totally_damage,dm.yield_after,
                                  (SELECT mn.municipality FROM tbl_municipality as mn WHERE mn.mun_id=dm.mun_id) municipality,
                                  (SELECT ec.ecosystem FROM tbl_ecosystem as ec WHERE ec.eco_id=dm.eco_id ) ecosystem,
                                  (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(dm.date_occurence,pl.date_monitored))<=115 AND pl.mun_id=dm.mun_id AND pl.eco_id=dm.eco_id ) area,
                                  (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE (SELECT DATEDIFF(dm.date_occurence,pl.date_monitored))<=115 AND pl.mun_id=dm.mun_id AND pl.eco_id=dm.eco_id ) farmers,
                                  (SELECT COALESCE(AVG(yield), 0) FROM tbl_harvesting as pl WHERE pl.mun_id=dm.mun_id AND pl.eco_id=dm.eco_id ) yield_before,
                                  ((((SELECT COALESCE(AVG(yield), 0) FROM tbl_harvesting as pl WHERE pl.mun_id=dm.mun_id AND pl.eco_id=dm.eco_id )-dm.yield_after)/(SELECT COALESCE(AVG(yield), 0) FROM tbl_harvesting as pl WHERE pl.mun_id=dm.mun_id AND pl.eco_id=dm.eco_id ))*100)yield_loss,
                                  (SELECT st.stage FROM tbl_stages  as st WHERE st.stage_id=dm.stage_id) stage_id,
                                  (SELECT cl.calamity FROM tbl_calamity as cl WHERE cl.calamity_id=dm.calamity_id ) damage_cause
                                   FROM tbl_damage as dm;");
                                  
                                  while($row1 = mysqli_fetch_array($queryP)){ 
                                    echo '<tr>';
                                    echo '<td>'.$row1['damage_id'].'</td>';
                                    echo '<td><a><b>'.$row1['municipality'].'</b></a></td>';
                                    echo '<td>'.$row1['ecosystem'].'</td>';
                                    echo '<td>'.$row1['damage_cause'].'</td>';
                                     echo'<td>'.date_format(date_create($row1['date_occurence']),"F d,Y").'</td>';
                                   // echo '<td>'.number_format($row1['farmers'],0).'</td>';
                                   // echo'<td>'.number_format(($row1['area']-($row1['area_totally_damage']+$row1['area_partially_damage'])),2).'</td>';
                                    //echo'<td>'.number_format($row1['area_totally_damage'],2).'</td>';
                                    echo'<td>'.number_format(($row1['area_partially_damage']+$row1['area_totally_damage']),2).'</td>';
                                    //echo'<td>'.number_format(($row1['yield_before']-$row1['yield_after']),2).'</td>';
                                    echo'<td>'.round($row1['yield_loss']).'%</td>';
                                    //echo '<td>'.$row1['stage_id'].'</td>';
                                    // echo '<td>'.$row1['date_harvest'].'</td>';
                                     
                                     echo'<td>';
                                     ?>
                                      <form method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row1['damage_id']; ?>"/>                       
                                        <a href="#viewModal<?php echo $row1['damage_id']; ?>" class="btn btn-info btn-sm" data-toggle="modal">
                                         more details <i class="fas fa-angle-right"></i>
                                        </a>
                                      </form> 
                                      <div class="modal fade" id="viewModal<?php echo $row1['damage_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header bg-success">
                                              <h5 class="modal-title" id="exampleModalLabel">DAMAGE INFORMATION</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <div class="table-responsive">
                                              <table class="table  table-sm"   style="text-align:center; width:100%">
                                                <tbody>
                                                  <tr>
                                                    <td style="text-align:right">Cause of Damage: </td>
                                                    <td><?php echo $row1['damage_cause']; ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td style="text-align:right">Date of Occurence: </td>
                                                    <td><?php echo date_format(date_create($row1['date_occurence']),"F d,Y"); ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td style="text-align:right">End of Calamity: </td>
                                                    <td><?php echo date_format(date_create($row1['end_calamity']),"F d,Y"); ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td style="text-align:right">Municipality: </td>
                                                    <td><?php echo $row1['municipality']; ?></td>
                                                  </tr>
                                                  <tr >
                                                    <td style="text-align:right"> Ecosystem: </td>
                                                    <td><?php echo $row1['ecosystem']; ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td style="text-align:right">Number of Farmers Affected: </td>
                                                    <td><?php echo $row1['farmers']; ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td style="text-align:right">Area of Standing Crop: </td>
                                                    <td><?php echo number_format(($row1['area']-($row1['area_totally_damage']+$row1['area_partially_damage'])),2); ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td style="text-align:right">Stage of Crop Development: </td>
                                                    <td><?php echo $row1['stage_id']; ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td style="text-align:right">Date of Harvest: </td>
                                                    <td><?php echo date_format(date_create($row1['date_harvest']),"F d,Y"); ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td colspan="2"><b>AREA AFFECTED </b></td>
                                                  </tr>
                                                  <tr>
                                                    <td style="text-align:right">Totally Damage: </td>
                                                    <td><?php echo number_format($row1['area_totally_damage'],2); ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td style="text-align:right">Partially Damage: </td>
                                                    <td><?php echo number_format($row1['area_partially_damage'],2); ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td style="text-align:right">Total Damage: </td>
                                                    <td><?php echo number_format(($row1['area_totally_damage']+$row1['area_partially_damage']),2); ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td colspan="2"><b>YIELD PER HECTARE(m.t.)</b> </td>
                                                  </tr>
                                                  <tr>
                                                    <td style="text-align:right">Before Calamity: </td>
                                                    <td><?php echo number_format($row1['yield_before'],2); ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td style="text-align:right">After Calamity: </td>
                                                    <td><?php echo number_format($row1['yield_after'],2); ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td style="text-align:right">Yield Loss (%): </td>
                                                    <td><?php echo round($row1['yield_loss']); ?>%</td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                              </div>
                                            
                                              
                                            </div>
                           
                                          </div>
                                        </div>
                                      </div>

                                  <?php
                                    echo'
                                    </td>
                                    </tr>';
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

<div class="modal fade" id="add_damage_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLabel">DAMAGE INFORMATION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST">
        <div class="row">
            <div class="col-sm-4">
                <!-- select -->
                <div class="form-group ">
                <small>DAMAGE CAUSE</small>
                <select class="form-control" name="damage_cause" required>
                <option></option>
                <?php
                    $query = mysqli_query($connection,"SELECT * FROM tbl_calamity");
                        while($row = mysqli_fetch_array($query)){
                            echo"<option value='".$row['calamity_id']."'>".$row['calamity']."</option>";  
                        }    
                ?>
                </select>
                </div>
            </div>           
            
            <div class="col-sm-4">
                <div class="form-group">
                <small>DATE OF OCCURENCE</small>
                <input type="date" class="form-control" name="date_occurence" required>
                </div>
            </div> 
            <div class="col-sm-4">
                <div class="form-group">
                <small>END OF CALAMITY</small>
                <input type="date" class="form-control" name="end_calamity" required>
                </div>
            </div> 
           
        </div>
        <div class="row">
            <div class="col-sm-4">
                <!-- select -->
                <div class="form-group ">
                <small>AFFECTED MUNICIPALITY</small>
                <select class="form-control" name="mun_id" required>
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
                <small>NUMBER OF AFFECTED farmersS</small>
                <input type="text" class="form-control" name="farmers" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                </div>
            </div> 
            <div class="col-sm-4">
                <!-- select -->
                <div class="form-group ">
                <small>ECOSYSTEM</small>
                <select class="form-control" name="eco_id" required>
                <option></option>
                <?php
                    $query = mysqli_query($connection,"SELECT * FROM tbl_ecosystem");
                        while($row = mysqli_fetch_array($query)){
                            echo"<option value='".$row['eco_id']."'>".$row['ecosystem']."</option>";  
                        }    
                ?>
                </select>
                </div>
            </div>  
        
        </div>
        <div class="row">
            <div class="col-sm-4">
                <!-- select -->
                <div class="form-group ">
                <small>AREA OF STANDING CROP</small>
                <input type="text" class="form-control" name="area_standing" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                </div>
            </div>           
            <div class="col-sm-4">
                <div class="form-group">
                <small>STAGE OF CROP DEVELOPMENT</small>
                <select class="form-control" name="stage_id" required>
                <option></option>
                <?php
                    $query = mysqli_query($connection,"SELECT * FROM tbl_stages");
                        while($row = mysqli_fetch_array($query)){
                            echo"<option value='".$row['stage_id']."'>".$row['stage']."</option>";  
                        }    
                ?>
                </select>
                </div>
            </div> 
            <div class="col-sm-4">
                <!-- select -->
                <div class="form-group ">
                <small>DATE OF HARVEST</small>
                <input type="date" class="form-control" name="date_harvest" required>
                </div>
            </div>  
        
        </div>
        <div class="row">
        <p class="h5">AREA AFFECTED (HA.)</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <!-- select -->
                <div class="form-group ">
                <small>TOTALLY DAMAGED</small>
                <input type="text" class="form-control" name="area_totally_damage" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                </div>
            </div>   
            <div class="col-sm-6">
                <!-- select -->
                <div class="form-group ">
                <small>PARTIALLY DAMAGED</small>
                <input type="text" class="form-control" name="area_partially_damage" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                </div>
            </div>         
        </div>
        <div class="row">
        <p class="h5">YIELD PER HECTARE(M.T.)</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <!-- select -->
                <div class="form-group ">
                <small>BEFORE CALAMITY</small>
                <input type="text" class="form-control" name="yield_before" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                </div>
            </div>   
            <div class="col-sm-6">
                <!-- select -->
                <div class="form-group ">
                <small>AFTER CALAMITY</small>
                <input type="text" class="form-control" name="yield_after" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                </div>
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


