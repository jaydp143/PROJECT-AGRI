<?php  
    $pagename="add_planting_accomplishment";
    require('./session.php'); 
    require('./database.php');
    require('./save_new_pass.php');
    require('./save_new_profile.php');
    require('./user_data.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
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
      $pl_monitoring_add="active";
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
      <form name="add_accomp" id="add_accomp"> 
        
        <div class="row">
                <div class="col-sm-12">
                  <table  class='table  table-sm table-striped ' id="dynamic_field" style='text-align:center;'>
                      <thead style="background-color:#1B5E20;" class="text-light">
                      <tr>
                          <th rowspan="2" style="width: 15%;" >MUNICIPALITY</th>
                          <th rowspan="2" style="width: 15%;">SEED</th>
                          <th rowspan="2" style="width: 10%;">DATE</th>
                          <th colspan="2" style="width: 20%;">IRRIGATED</th>
                          <th colspan="2" style="width: 20%;">RAINFED</th>
                          <th colspan="2" style="width: 20%;">UPLAND</th>
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
                                  
                            <tr>
                            <td align="center"><input type="text" list="municipality_list" id="display_mun" name="municipality[]"  class="form-control display_mun" /><datalist class="municipality_list" id="municipality_list"></datalist></td>
                            <td align="center"><input type="text" list="seed_list" id="display_seed" name="seed[]"  class="form-control display_seed" /><datalist class="seed_list" id="seed_list"></datalist></td>
                            <td align="center"><input type="date" class="form-control" name="date[]" ></td>
                            <td align="center"><input type="text" class="form-control" name="area1[]" onkeypress="return isNumber(event)"></td>
                            <td align="center"><input type="text" class="form-control" name="farmer1[]" onkeypress="return isNumber(event)"></td>
                            <td align="center"><input type="text" class="form-control" name="area2[]" onkeypress="return isNumber(event)"></td>
                            <td align="center"><input type="text" class="form-control" name="farmer2[]" onkeypress="return isNumber(event)"></td>
                            <td align="center"><input type="text" class="form-control" name="area3[]" onkeypress="return isNumber(event)"></td>
                            <td align="center"><input type="text" class="form-control" name="farmer3[]" onkeypress="return isNumber(event)"></td>
                            </tr>
                      
                      </tbody>
                      <tfoot>
                        <tr>
                            <th colspan="9" class="text-right">
                            <a href="#" class="btn btn-danger btn-block " id="add_row" title="Edit Content"><i class="fas fa-plus"> </i> Add Row</a>
                            </th>
                            
                        </tr>
                    </tfoot>
                  </table> 
                </div>
            </div> 
           
            <div class="row pt-2">  
                <div class="col-md-12">
                    <button type="button" class="btn btn-block bg-gradient-success float-right" name="submit" id="submit" '>SAVE</button>
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
<script>

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)&&(charCode!=46)) {
        return false;
    }
    return true;
}

    var i=1;
    $(document).ready(function() {
        $("#add_row").click( function() {
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'"><td align="center"><input type="text" list="municipality_list" id="display_mun" name="municipality[]"  class="form-control display_mun" /><datalist class="municipality_list" id="municipality_list"></datalist></td> <td align="center"><input type="text" list="seed_list" id="display_seed" name="seed[]"  class="form-control display_seed" /><datalist class="seed_list" id="seed_list"></datalist></td><td align="center"><input type="date" class="form-control" name="date[]" ></td><td align="center"><input type="text" class="form-control" name="area1[]" onkeypress="return isNumber(event)" ></td><td align="center"><input type="text" class="form-control" name="farmer1[]" onkeypress="return isNumber(event)" ></td><td align="center"><input type="text" class="form-control" name="area2[]" onkeypress="return isNumber(event)" ></td><td align="center"><input type="text" class="form-control" name="farmer2[]" onkeypress="return isNumber(event)" ></td><td align="center"><input type="text" class="form-control" name="area3[]" onkeypress="return isNumber(event)" ></td><td align="center"><input type="text" class="form-control" name="farmer3[]" onkeypress="return isNumber(event)"></td></tr>');
         });
    });


    $(document).ready(function() {
        $('tr').on('click', '.display_mun', function(){            

            $.ajax({    //create an ajax request to display.php
                type: "POST",
                url: "display_municipality.php",             
                dataType: "html",   //expect html to be returned                
                success: function(response){                    
                    $(".municipality_list").html(response); 
                    //alert(response);
                }

                });
            });
        });
    $(document).ready(function() {
        $('tr').on('click', '.display_seed', function(){            

            $.ajax({    //create an ajax request to display.php
                type: "POST",
                url: "display_seed.php",             
                dataType: "html",   //expect html to be returned                
                success: function(response){                    
                    $(".seed_list").html(response); 
                    //alert(response);
                }

                });
            });
        });

        $(document).ready(function() {
          $('#submit').click(function(){
            if(confirm("Are you sure you want to save?")==1){
              $.ajax({
                  url:"save_plant_accomp.php",
                  method:"POST",
                  data:$('#add_accomp').serialize(),
                  success:function(data){
                      alert(data);
                      $('#add_accomp')[0].reset();
                  }
              });
            }
          });
         });
        
</script>