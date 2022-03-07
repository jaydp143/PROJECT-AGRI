<?php   
    $pagename="view_harvesting_report";
    require('./session.php'); 
    require('./database.php');
    require('./save_new_pass.php');
    require('./save_new_profile.php');
    require('./user_data.php');
?>
<?php
  if (isset($_POST['btn_save'])) {
    $ecosystem =mysqli_real_escape_string($connection,$_POST['ecosystem']);
   

    $same_data = mysqli_query($connection,"SELECT * FROM tbl_ecosystem WHERE ecosystem = '$ecosystem'");

    if (mysqli_num_rows($same_data)>0) {

      pathTo('ecosystem');  

    }
    else{

  mysqli_query($connection,"INSERT INTO tbl_ecosystem (ecosystem) VALUES ('$ecosystem')");

  pathTo('ecosystem');
  }
}

?>


<!-- changing of accounts-->
<?php
  if (isset($_POST['btn_change'])) {
    $id=$_POST['id'];
    $ecosystem =$_POST['ecosystem'];
    
    
    mysqli_query($connection,"UPDATE tbl_ecosystem SET ecosystem='$ecosystem' WHERE eco_id='$id' ");
    pathTo('ecosystem');

  }
 ?>





<?php
if (isset($_POST['deleteBtn'])) 
{
    $no = $_POST['id'];
     mysqli_query($connection,"DELETE from tbl_ecosystem WHERE eco_id='$no'");
     pathTo('ecosystem');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ECOSYSTEM</title>
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
      $report_nav_item="menu-open";
      $report_nav_link="active";
      $hr_report="active";
      require_once('sidebar.php')
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>HARVEST REPORTS</h1>
          </div>
          <!-- <div class="col-sm-4">
            <a href="add_harvest_accomplishment.php" class="btn btn-sm bg-gradient-info float-right" data-toggle="modal" data-target="#addSeedTypeModal">
              <i class="fa fa-plus" aria-hidden="true"> </i> ADD ECOSYSTEM
            </a>
          </div> -->
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <form method="POST">
                <div class="row">
                  <!-- <div class="col-4">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-success ">PROGRAM</span>
                        </div>
                        <select class="form-control" name="program" id="program" required >
                            <option value=""></option>
                            <option value="PLANTING">PLANTING</option>
                            <option value="HARVESTING">HARVESTING</option> 
                        </select>
                    </div>
                  </div> -->
                  <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-success ">REPORT</span>
                        </div>
                        <!-- /btn-group -->
                        <select class="form-control" name="report" id="report" required >
                            <option value=""></option>
                            <option value="1">HARVEST REPORT SUMMARY</option>
                            <option value="2">HARVEST REPORT BY SEED TYPE</option>
                            <option value="3">HARVEST REPORT BY ECOSYSTEM</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-success ">SEASON</span>
                        </div>
                        <!-- /btn-group -->
                        <select class="form-control" name="season" id="season" required >
                            <option value=""></option>
                            <option value="WET">WET</option>
                            <option value="DRY">DRY</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-success ">YEAR</span>
                        </div>
                        <!-- /btn-group -->
                        <select class="form-control" name="year" id="year"required >
                            <option value=""></option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <button type="button" class="btn bg-gradient-success btn-block "  id="btn_set" name="btn_set" onclick="displayreport(document.getElementById('report').value,document.getElementById('season').value,document.getElementById('year').value);">
                        <strong> GENERATE</strong>
                    </button>
                  </div>
                </div>
                <br>
                
              </form>
        <div>
        <div class="embed-responsive embed-responsive-16by9">
            <iframe  id="frame1" class="embed-responsive-item" src=""></iframe>
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

<script>
  function displayreport(r,s,y) {
    if (r==1){
        document.getElementById("frame1").src="report_harvest.php?season="+s+"&&year="+y;
    }
    else if (r==2){
        document.getElementById("frame1").src="report_harvestBST.php?season="+s+"&&year="+y;
    }
    else if (r==3){
        document.getElementById("frame1").src="report_harvestBEco.php?season="+s+"&&year="+y;
    }
    else{
        document.getElementById("frame1").src="";  
    }
      }
    
</script> 
