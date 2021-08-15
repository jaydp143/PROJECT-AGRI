<?php  
    $pagename="add_target";
    require('./session.php'); 
    require('./database.php');
    require('./save_new_pass.php');
    require('./save_new_profile.php');
    require('./user_data.php');
?>
<?php
  if (isset($_POST['btn_save'])) {
    for($index=0;$index<count($_POST['mun_id']);$index++){
      $program =mysqli_real_escape_string($connection,$_POST['program']);
      $season =mysqli_real_escape_string($connection,$_POST['season']);
      $year=$_POST['year'];
      $mun_id=$_POST['mun_id'][$index];
      $target=$_POST['target'][$index];
      if($target!=0){
        mysqli_query($connection,"INSERT INTO tbl_target (mun_id, program, season, year, target) VALUES ('$mun_id', '$program', '$season', '$year', '$target')");
      }
      pathTo('target');
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> SET TARGET</title>
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
      $set_up_nav_item="menu-open";
      $set_up_nav_link="active";
      $target_set_up="active";
      require_once('sidebar.php')
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1> SET NEW TARGETS</h1>
          </div>
          <!-- <div class="col-sm-4">
            <a href="add_harvest_accomplishment.php" class="btn btn-sm bg-gradient-info float-right" data-toggle="modal" data-target="#addSeedTypeModal">
              <i class="fa fa-plus" aria-hidden="true"> </i> SET NEW TARGET
            </a>
          </div> -->
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <form method='POST'>
        <div class="row">
                <div class="col-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-success ">PROGRAM</span>
                    </div>
                    <!-- /btn-group -->
                    <select class="form-control" name="program" required >
                        <option value=""></option>
                        <option value="PLANTING">PLANTING</option>
                        <option value="HARVESTING">HARVESTING</option> 
                    </select>
                </div>
                </div>
                    
                <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-success ">SEASON</span>
                    </div>
                    <!-- /btn-group -->
                    <select class="form-control" name="season" required >
                        <option value=""></option>
                        <option value="WET">WET</option>
                        <option value="DRY">DRY</option>
                    </select>
                </div>
                </div>
                <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-success ">YEAR</span>
                    </div>
                    <!-- /btn-group -->
                    <select class="form-control" name="year" required >
                        <option value=""></option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option> 
                        <option value="2022">2022</option> 
                    </select>
                </div>
                </div>
            </div>
            <br>
            <div class="row">  
                <div class="col-12">
                    <div class="table-responsive">
                        <table  class='table  table-striped table-sm ' style='text-align:center; width:100%'>
                            <thead style="background-color:#1B5E20;" class="text-light">
                            <tr>
                                <th>#</th>
                                <th>MUNICIPALITY</th>
                                <th>TARGET</th> 
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $x=1;
                                $query = mysqli_query($connection,"SELECT * FROM tbl_municipality ORDER BY district ASC , municipality ASC");
                                    while($row = mysqli_fetch_array($query)){      
                                ?> 
                                    
                            <tr>
                            <td align='center'>
                            <input type='hidden' class='form-control' name='mun_id[]' value='<?php echo $row['mun_id']; ?>'>
                            <?php echo $x; ?>
                            </td>
                            <td align='center'>
                            <input type='hidden' class='form-control' name='municipality[]' value='<?php echo $row['municipality']; ?>'>
                            <?php echo $row['municipality']; ?></td>
                            <td align='center'><input type='text' class='form-control' name='target[]' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                            </tr>

                            <?php
                            $x++;
                            }
                            ?>
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
            
            <div class="row">  
                <div class="col-md-8">
                </div>
                <div class="col-md-2">
                    <button type="reset" class="btn btn-block bg-gradient-danger float-right">Clear</button>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-block bg-gradient-success float-right" name="btn_save" id='btn_save' onclick='confirm_save();return false;' >Save</button>
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

