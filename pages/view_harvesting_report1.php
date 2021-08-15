<?php require('./session.php'); 
    require('./database.php');
?>

<!-- add new item -->
<?php
  if (isset($_POST['btn_save'])) {
   
    for($index=0;$index<count($_POST['mun_id']);$index++){
      $program =mysqli_real_escape_string($connection,$_POST['program']);
      $season =mysqli_real_escape_string($connection,$_POST['season']);
      $mun_id=$_POST['mun_id'][$index];
      $target=$_POST['target'][$index];
      mysqli_query($connection,"INSERT INTO tbl_target (mun_id, project, period, target) VALUES ('$mun_id', '$program', '$season', '$target')");
      pathTo('target');
    }

    //====================================================   
  
}

?>

<!-- changing of accounts-->
<?php
  if (isset($_POST['btn_change'])) {
    $program =mysqli_real_escape_string($connection,$_POST['project']);
    $season =mysqli_real_escape_string($connection,$_POST['period']);
    $mun_id=$_POST['municipality'];
    $target=$_POST['target'];
    $id=$_POST['id'];
    
    mysqli_query($connection,"UPDATE tbl_target SET mun_id='$mun_id', project='$program', period='$season', target='$target' WHERE target_id='$id' ");
   

  }
 ?>



<!-- delete function -->
   <script>
    function confirm_del()
    {
      if(confirm("Are you sure you want to delete?")==1){
        document.getElementById('deleteBtn').submit();
      }
    }
</script>

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
  <title>MUNICIPALITY</title>
  <?php
    require_once('links.php')
  ?>
  
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <?php
    require_once('header.php')
  ?>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper " style="background:#FFFFFF">
    <br>
    <br>
    <br>
  <div class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1 class="m-0 text-primary"> REPORTS</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <div class="content">
      <div class="container">
     
            <!-- /.card -->
        <div class="row">
          <div class="col-md-12">
          <div class="card">
              <div class="card-header bg-success">
                <h3 class="card-title">PLANTING REPORT</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form method="POST">
                <div class="row">
                  <div class="col-4">
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
                        <select class="form-control" name="season" required >
                            <option value=""></option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-2">
                    <button type="submit" class="btn bg-gradient-success btn-block " name="btn_set">
                        <strong> GENERATE</strong>
                    </button>
                  </div>
                </div>
                <br>
                <div class="row">
                    <iframe src='report_plantingBST.php' width='100%' height='780px' id="frame1"></iframe>
                </div>
              </form>
              <br>
                
              <!-- /.card-body -->
            </div>
          </div>
        </div>
       
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <?php
    require_once('footer.php');
  ?>
  </div>
  <!-- /.content-wrapper -->
  
</div>
<!-- ./wrapper -->
<?php
    require_once('links_script.php');
  ?>
</body>
</html>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLabel">ADD NEW DATA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
        <form method='POST'>
        <div class="row">
                  <div class="col-8">
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
                  
                  <div class="col-4">
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
        </div>
        <br>
        <div class="row">  
            <div class="col-12">
                <table id='example1' class='table table-bordered table-striped table-sm ' style='text-align:center'>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>MUNICIPALITY</th>
                        <th>TARGET</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($connection,"SELECT * FROM tbl_municipality ORDER BY district ASC");
                            while($row = mysqli_fetch_array($query)){
                                
                                
                            
                    echo"<tr>
                    <td align='center'>
                    <input type='hidden' class='form-control' name='mun_id[]' value='".$row['mun_id']."'>
                    ".$row['mun_id']."
                    </td>
                    <td align='center'>
                    <input type='hidden' class='form-control' name='municipality[]' value='".$row['municipality']."'>
                    ".$row['municipality']."</td>
                    <td align='center'><input type='text' class='form-control' name='target[]'></td>
                    </tr>";
                
                    }
                    ?>
                    </tbody>
                </table>  
            </div>               
        </div>
      </div>
      <div class="modal-footer">
    <button type='submit' class='btn bg-gradient-success' name='btn_save'>
    <strong> SET</strong>
    </button>  
    <button type='reset' class='btn bg-gradient-danger' name='btn_clear'>
    <strong> CLEAR</strong>
    </button> 
        </div>
        </form>
  </div>
</div>