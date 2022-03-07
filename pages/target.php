<?php  
    $pagename="target";
    require('./session.php'); 
    require('./database.php');
    require('./save_new_pass.php');
    require('./save_new_profile.php');
    require('./user_data.php');
?>

<!-- changing of accounts-->
<?php
  if (isset($_POST['btn_change'])) {
    $program =mysqli_real_escape_string($connection,$_POST['program']);
    $season =mysqli_real_escape_string($connection,$_POST['season']);
    $year=$_POST['year'];
    $mun_id=$_POST['municipality'];
    $target=$_POST['target'];
    $id=$_POST['id'];
    
    mysqli_query($connection,"UPDATE tbl_target SET mun_id='$mun_id', program='$program', season='$season',  year='$year', target='$target' WHERE target_id='$id' ");
   

  }
 ?>


<?php
if (isset($_POST['deleteBtn'])) 
{
    $no = $_POST['id'];
     mysqli_query($connection,"DELETE from tbl_target WHERE target_id='$no'");
     pathTo('target');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TARGET</title>
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
            <h1>LIST OF TARGET</h1>
          </div>
          <div class="col-sm-4">
            <a href="add_target.php" class="btn btn-sm bg-gradient-info float-right">
              <i class="fa fa-plus" aria-hidden="true"> </i> ADD NEW TARGET
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
                        <table id="dataTables-example" class="table  table-striped table-sm " style="text-align:center; width:100%">
                            <thead style="background-color:#1B5E20;" class="text-light">
                                <tr>

                                    <th>MUNICIPALITY</th>
                                    <th>PROGRAM</th>
                                    <th>SEASON</th>
                                    <th>YEAR</th>
                                    <th>TARGET</th>
                                    <th>ACTION</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = mysqli_query($connection,"SELECT mn.mun_id, mn.municipality, tg.year, tg.target_id, tg.season, tg.program, tg.target FROM tbl_target as tg INNER JOIN tbl_municipality as mn ON tg.mun_id=mn.mun_id");
                                    while($row = mysqli_fetch_array($query))
                                    {      
                                ?> 
                                    <tr>
                                        <td align='center'><?php echo $row['municipality']; ?></td>
                                        <td align='center'><?php echo$row['program']; ?></td>
                                        <td align='center'><?php echo$row['season']; ?></td>
                                        <td align='center'><?php echo$row['year']; ?></td>
                                        <td align='center'><?php echo$row['target']; ?></td>
                                        <td align='center'>
                                            <div class='btn-group'>
                                                <form method='POST'>
                                                    <input type='hidden' name='id' value='<?php echo $row['target_id']; ?>'/>                       
                                                    <a href='#editModal<?php echo $row['target_id']; ?>' class='btn btn-info btn-sm' data-toggle='modal'>
                                                    <i class='fa fa-edit' aria-hidden='true'></i>
                                                    </a>
                                                    <button type='submit' class='btn btn-danger btn-sm' onclick='confirm_del();return false;' name='deleteBtn'  id='deleteBtn' >
                                                    <i class='fas fa-trash'></i>
                                                    </button>
                                                    <script>
                                                        function confirm_del()
                                                        {
                                                        if(confirm("Are you sure you want to delete?")==1){
                                                            document.getElementById('deleteBtn').submit();
                                                        }
                                                        }
                                                    </script>
                                                </form> 
                                            </div>
                                        </td>
                                        </tr>
                            
                                        <div class='modal fade' id='editModal<?php echo $row['target_id']; ?>' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog' role='document'>
                                                <div class='modal-content'>
                                                    <div class='modal-header bg-success'>
                                                        <h5 class='modal-title' id='exampleModalLabel'>EDIT TARGET </h5>
                                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                            <span aria-hidden='true'>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method='POST'>
                                                        <div class='modal-body'>
                                                        
                                                            <input type='hidden' name='id' value='<?php echo $row['target_id']; ?>'/>    
                                            
                                                            <div class='form-group'>
                                                                <label>MUNICIPALITY</label>
                                                                <select class='form-control' name='municipality'>
                                                                    <option value='<?php echo $row['mun_id']; ?>'><?php echo $row['municipality']; ?></option>
                                                                    <option></option>
                                                                    <?php
                                                                    $query1 = mysqli_query($connection,"SELECT * FROM tbl_municipality");
                                                                        while($row1 = mysqli_fetch_array($query1)){
                                                                            echo"<option value='".$row1['mun_id']."'>".$row1['municipality']."</option>";  
                                                                        }    
                                                                    echo"</select>";
                                                                    ?>
                                                            </div>

                                            
                                            
                                                            <div class='form-group'>
                                                                <label>PROGRAM</label>
                                                                <select class='form-control' name='program'>
                                                                    <option value='<?php echo $row['program'];  ?>'><?php echo $row['program']; ?></option>
                                                                    <option></option>
                                                                    <option value='PLANTING'>PLANTING</option>
                                                                    <option value='HARVESTING'>HARVESTING</option>
                                                                </select>
                                                            </div>

                                                            <div class='form-group'>
                                                                <label>SEASON</label>
                                                                <select class='form-control' name='season'>
                                                                    <option value='<?php echo $row['season']; ?>'><?php echo $row['season']; ?></option>
                                                                    <option></option>
                                                                    <option value='WET'>WET</option>
                                                                    <option value='DRY'>DRY</option>
                                                                </select>
                                                            </div>

                                                            <div class='form-group'>
                                                                <label>SEASON</label>
                                                                <select class='form-control' name='year'>
                                                                    <option value='<?php echo $row['year']; ?>'><?php echo $row['year']; ?></option>
                                                                    <option></option>
                                                                    <option value='2020'>2020</option>
                                                                    <option value='2021'>2021</option> 
                                                                    <option value='2022'>2022</option> 
                                                                </select>
                                                            </div>
                                                
                                                            <div class='form-group'>
                                                                <label>TARGET: </label>
                                                                <input type='text' name='target'  class='form-control' value='<?php echo $row['target']; ?>' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required />
                                                            </div>

                                                        </div>
                                                        <div class='modal-footer'>
                                                            <button type='submit' class='btn bg-gradient-success' name='btn_change'  >Save</button>
                                                            <button type='reset' class='btn bg-gradient-danger'>Clear</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
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
