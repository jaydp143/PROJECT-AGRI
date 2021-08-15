<?php  
    $pagename="add_planting_accomplishment";
    require('./session.php'); 
    require('./database.php');
    require('./save_new_pass.php');
    require('./save_new_profile.php');
    require('./user_data.php');
?>

<?php
    if (isset($_POST['btn_save'])) {

        for($index=0;$index<count($_POST['municipality']);$index++){
          $municipality =$_POST['municipality'][$index];
          $seed =$_POST['seed'];
         // $seed_type =$_POST['seed_type'][$index];
          $ecosystem1 =1;
          $ecosystem2 =2;
          $ecosystem3 =3;
          //$season =mysqli_real_escape_string($connection,$_POST['season']);
          $area1 =$_POST['area1'][$index];
          $farmer1 =$_POST['farmer1'][$index];
          $area2 =$_POST['area2'][$index];
          $farmer2 =$_POST['farmer2'][$index];
          $area3 =$_POST['area3'][$index];
          $farmer3 =$_POST['farmer3'][$index];
          $date_monitored =$_POST['date_monitored'];
          $date_harvest=date('Y-m-d', strtotime($_POST['date_monitored']. ' + 115 days'));
          $user=$_SESSION['username'];
          if($area1!=0 && $farmer1!=0){
            mysqli_query($connection,"INSERT INTO tbl_planting (mun_id,seed_id, eco_id, areas, farmers, date_monitored, date_harvest, user) VALUES ('$municipality', '$seed', '$ecosystem1', '$area1', '$farmer1', '$date_monitored', '$date_harvest', '$user')");
          }
          if($area2!=0 && $farmer2!=0){
            mysqli_query($connection,"INSERT INTO tbl_planting (mun_id,seed_id, eco_id, areas, farmers, date_monitored, date_harvest, user) VALUES ('$municipality', '$seed', '$ecosystem2', '$area2', '$farmer2', '$date_monitored', '$date_harvest', '$user')");
          }
          if($area3!=0 && $farmer3!=0){
            mysqli_query($connection,"INSERT INTO tbl_planting (mun_id,seed_id, eco_id, areas, farmers, date_monitored, date_harvest, user) VALUES ('$municipality', '$seed', '$ecosystem3', '$area3', '$farmer3', '$date_monitored', '$date_harvest', '$user')");
          }
          echo "
              <script type='text/javascript'>
                  alert('You have Successfully Added');
                  window.location.href = 'planting_monitoring.php';
              </script>";
        }
      
    

        
    }
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
      $pl_monitoring="active";
      require_once('sidebar.php')
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>ADD PLANTING ACCOMPLISHMENT</h1>
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
      <!-- <div class="row"> 
        <div class="col-12">
        <button type="button" class="btn bg-gradient-danger" data-toggle="modal" data-target="#addModal">
            <i class="fa fa-plus" aria-hidden="true"> </i> ADD ACCOMPLISHMENT
        </button>
        <br>
        </div>
        
      </div> -->
      <form method="POST"> 
        <div class="row">
            <div class="col-sm-7">
                <!-- select -->
                <div class="form-group">
                <small>SEED:</small>
                <select class="form-control" name="seed" required>
                <option value=""></option>
                <?php
                $query = mysqli_query($connection,"SELECT * FROM tbl_seed as sd  INNER JOIN tbl_seed_type as st ON sd.seed_type_id= st.seed_type_id  ORDER BY seed_id ASC");
                    while($row = mysqli_fetch_array($query)){
                        echo"<option value='".$row['seed_id']."'>".$row['seed_description']."</option>";  
                    }    
                ?>
                </select>
                </div>
            </div>           
            <div class="col-sm-5">
                <div class="form-group">
                <small>DATE</small>
                <input type="date" class="form-control" name="date_monitored" required>
                </div>
            </div> 
               
        </div>
        <div class="row">
                <div class="col-sm-12">
                  <table  class='table  table-sm table-striped  ' style='text-align:center;'  width="100%">
                      <thead style="background-color:#1B5E20;" class="text-light">
                      <tr>
                          <th rowspan="2" width="40%">MUNICIPALITY</th>
                          <th colspan="2" width="20%">IRRIGATED</th>
                          <th colspan="2" width="20%">RAINFED</th>
                          <th colspan="2" width="20%">UPLAND</th>
                      </tr>
                      <tr>
                          <th>AREA</th>
                          <th>FARMERS</th>
                          <th>AREA</th>
                          <th>FARMERS</th>
                          <th>AREA</th>
                          <th>FARMERS</th>
                      </tr>
                      </thead>
                      <tbody>
                          <?php
                          $query = mysqli_query($connection,"SELECT * FROM tbl_municipality");
                              while($row = mysqli_fetch_array($query)){
                           ?>          
                            <tr>
                            <td align='center' width="35%">
                            <input type='hidden' class='form-control' name='municipality[]' value='<?php echo $row['mun_id']; ?>'>
                            <?php echo $row['municipality']; ?>
                            </td>
                            <td align='center'><input type='text' class='form-control' name='area1[]' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                            <td align='center'><input type='text' class='form-control' name='farmer1[]' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                            <td align='center'><input type='text' class='form-control' name='area2[]' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                            <td align='center'><input type='text' class='form-control' name='farmer2[]' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                            <td align='center'><input type='text' class='form-control' name='area3[]' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                            <td align='center'><input type='text' class='form-control' name='farmer3[]' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
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
            <button type="submit" class="btn btn-block bg-gradient-success float-right" name="btn_save" id="btn_save" onclick='confirm_save();return false;'>Save</button>
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
