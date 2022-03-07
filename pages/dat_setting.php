<?php  
    $pagename="seed";
    require('./session.php'); 
    require('./database.php');
    require('./save_new_pass.php');
    require('./save_new_profile.php');
    require('./user_data.php');
?>
<?php
  if (isset($_POST['btn_save'])) {
      $stage0=$_POST['numdays'][0];
      $stage1=$_POST['numdays'][1];
      $stage2=$_POST['numdays'][2];
      $stage3=$_POST['numdays'][3];
      $stage4=$_POST['numdays'][4];
      $stage5=$_POST['numdays'][5];
      $stage6=$_POST['numdays'][6];
      $stage7=$_POST['numdays'][7];
      $stage8=$_POST['numdays'][8];
      $stage9=$_POST['numdays'][9];
      $season =mysqli_real_escape_string($connection,$_POST['season']);
      $year=$_POST['year'];
      mysqli_query($connection,"INSERT INTO tbl_dat (stage0, stage1, stage2, stage3, stage4, stage5, stage6, stage7, stage8, stage9, status, season, year) VALUES ('$stage0', '$stage1', '$stage2', '$stage3', '$stage4', '$stage5', '$stage6', '$stage7','$stage8', '$stage9', 'ACTIVE', '$season', '$year')");
      pathTo('dat_setting');
    
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SEED</title>
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
      $set_up_nav_item="menu-open";
      $set_up_nav_link="active";
      $sd_set_up="active";
      require_once('sidebar.php')
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>DAT SETTING</h1>
          </div>
          <div class="col-sm-4">
            <a  class="btn btn-sm bg-gradient-info float-right" data-toggle="modal" data-target="#add_new" >
              <i class="fa fa-plus" aria-hidden="true"> </i> ADD NEW
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
                        <table id="dataTables-example" class="table table-striped table-sm " style="text-align:center; width:100%">
                        <thead style="background-color:#1B5E20;" class="text-light">
                        <tr>
                        <th rowspan="2">C.Y.</th>
                        <th colspan="10"> STAGES</th>
                        <th rowspan="2">STATUS</th>
                        <th rowspan="2"> ACTION</th>
                        </tr>
                        <tr>
                        <th>0</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = mysqli_query($connection,"SELECT * FROM tbl_dat");
                            while($row = mysqli_fetch_array($query)){       
                        ?>  
                        <tr>
                        <td align="center"><?php echo $row['season'].' SEASON-'.$row['year']; ?></td>
                        <td align="center"><?php echo $row['stage0']; ?></td>
                        <td align="center"><?php echo $row['stage1']; ?></td>
                        <td align="center"><?php echo $row['stage2']; ?></td>
                        <td align="center"><?php echo $row['stage3']; ?></td>
                        <td align="center"><?php echo $row['stage4']; ?></td>
                        <td align="center"><?php echo $row['stage5']; ?></td>
                        <td align="center"><?php echo $row['stage6']; ?></td>
                        <td align="center"><?php echo $row['stage7']; ?></td>
                        <td align="center"><?php echo $row['stage8']; ?></td>
                        <td align="center"><?php echo $row['stage9']; ?></td>
                        <td align="center"><?php echo $row['status']; ?></td>
                        <td align="center">
                        <div class="btn-group">
                                <form method="POST">
                                  <input type="hidden" name="id" value="<?php echo $row['mun_id']; ?>"/>                       
                                  <a href="#editModal<?php echo $row['mun_id']; ?>" class="btn btn-info btn-sm" data-toggle="modal">
                                  <i class="fa fa-edit" aria-hidden="true"></i>
                                  </a>
                                  <button type="submit" class="btn btn-danger btn-sm"onclick="confirm_del();return false;" name="deleteBtn" id="deleteBtn" title="Delete User" id="Delete_id" >
                                  <i class="fas fa-trash"></i>
                                  </button>
                                  <!-- delete function -->
                                        <script>
                                            function confirm_del()
                                            {
                                            if(confirm("Are you sure you want to delete?")==1){
                                                document.getElementById('deleteBtn').submit();
                                            }
                                            }
                                        </script>
                                </form> 
                                <div class="modal fade" id="editModal<?php echo $row['mun_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header bg-success">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Municipality</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                      <form method="POST">
                                      <input type="hidden" name="id" value="<?php echo $row['mun_id']; ?>"/>    
                                      <div class="form-group">
                                        <label>MUNICIPALITY: </label>
                                        <input type="text" name="municipality"  class="form-control" value="<?php echo $row['municipality'] ?>" required />
                                      </div>

                                      <div class="form-group">
                                        <label>DISTRICT: </label>
                                        <select class="form-control" name="district" required >
                                        <option value="<?php echo $row['district']; ?>"><?php echo $row['district'] ?></option>
                                        <option value=""></option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                        </select>
                                      </div>

                                      </div>
                                        <div class="modal-footer">
                                          <button type="submit" class="btn bg-gradient-success" name="btn_change" >Save</button>
                                          <button type="reset" class="btn bg-gradient-danger">Clear</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </td>
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

<div class="modal fade" id="add_new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> ADD NEW SEED</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method='POST'>
        <div class="row">
                           
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
                            <th>STAGE</th>
                            <th>NUMBER OF DAYS</th> 
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $x=0;
                            $query = mysqli_query($connection,"SELECT * FROM tbl_stages");
                                while($row = mysqli_fetch_array($query)){
                                    
                            ?> 
                                
                        <tr>
                        <td align='center'>
                        <input type='hidden' class='form-control' name='stage_id[]' value='<?php echo $row['stage_id']; ?>'>
                        <?php echo $x; ?>
                        </td>
                        <td align='center'>
                        <input type='hidden' class='form-control' name=stage[]' value='<?php echo $row['stage']; ?>'>
                        <?php echo $row['stage']; ?></td>
                        <td align='center'><input type='text' class='form-control' name='numdays[]' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
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
        
      
        

      </div>
        <div class="modal-footer">
        
            
            
                <button type="reset" class="btn  bg-gradient-danger ">Clear</button>
            
            
                <button type="submit" class="btn  bg-gradient-success " name="btn_save" id='btn_save' onclick='confirm_save();return false;' >Save</button>
                <script>
                    function confirm_save()
                    {
                    if(confirm("Are you sure you want to save?")==1){
                        document.getElementById('btn_save').submit();
                    }
                    }
                </script>
            
        
        </div>
      </form>
    </div>
  </div>
</div>

