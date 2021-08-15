<?php  
    $pagename="add_harvest_accomplishment";
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
        $date_monitored =$_POST['date_monitored'];
        $user=$_SESSION['username'];
        if ($area1!=0 && $production1!=0){
          $yield1 =($production1/$area1);
            mysqli_query($connection,"INSERT INTO tbl_harvesting (mun_id,seed_id, seed_type_id, eco_id, season, area, yield, production, date_monitored, user) VALUES ('$municipality', '$seed', '$seed_type', '$ecosystem1', '$season', '$area1', '$yield1','$production1', '$date_monitored', '$user')");
        }
       
        if ($area2!=0 && $production2!=0){
          $yield2 =($production2/$area2);
          mysqli_query($connection,"INSERT INTO tbl_harvesting (mun_id,seed_id, seed_type_id, eco_id, season, area, yield, production, date_monitored, user) VALUES ('$municipality', '$seed', '$seed_type', '$ecosystem2', '$season', '$area2', '$yield2','$production2', '$date_monitored', '$user')");
        }

        if ($area3!=0 && $production3!=0){
          $yield3 =($production3/$area3);
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
  <title>HARVEST-MONITORING</title>
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
            <h1>ADD HARVEST ACCOMPLISHMENT</h1>
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
                  <table class='table table-bordered table-striped table-sm ' style='text-align:center'>
                      <thead style="background-color:#1B5E20;" class="text-light">
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
                            <td align='center'><input type='text' class='form-control' name='production1[]'  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
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
         
    <div class="row">  
        <div class="col-md-8">
        </div>
        <div class="col-md-2">
            <button type="reset" class="btn btn-block bg-gradient-danger float-right">Clear</button>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-block bg-gradient-success float-right" name="btn_save" id="btn_save" onclick='confirm_save();return false;' >Save</button>
            <script>
                function confirm_save()
                {
                if(confirm("Are you sure you want to save?")==1){
                    document.getElementById('btn_save').submit();
                }
                }
            </script>
        </div>
    </div>
      
        <br>
      </form>
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
