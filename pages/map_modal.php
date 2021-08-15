<!--MANGATAREM -->
<div class="modal fade" id="mangatarem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
          <?php
            $municipality="";
            $district="";
            $query = mysqli_query($connection,"SELECT * FROM tbl_municipality WHERE municipality='MANGATAREM'");
              while($row = mysqli_fetch_array($query)){
                  $municipality=$row['municipality'];  
                  $district=$row['district'];
              }    
          ?>
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $municipality?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
       <h3>PLANTING</h3>
              <p>TARGET:</p>
              <p>PLANTED aAREA:</p>
              <p>NO.OF FARMERS:</p>
       <h3>HARVESTING</h3> 
              <p>TARGET:</p>
              <p>HARVESTED AREA:</p>
              <p>YIELD:</p>
              <P>PRODUCTION:</P>
    </div>
      
      
      </div>
    </div>
  </div>
</div>

<!--mabini-->
<div class="modal fade" id="mabini" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
          <?php
            $municipality="";
            $district="";
            $query = mysqli_query($connection,"SELECT * FROM tbl_municipality WHERE municipality='MABINI'");
              while($row = mysqli_fetch_array($query)){
                  $municipality=$row['municipality'];  
                  $district=$row['district'];
              }    
          ?>
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $municipality?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
       <h3>PLANTING</h3>
              <p>TARGET:</p>
              <p>PLANTED aAREA:</p>
              <p>NO.OF FARMERS:</p>
       <h3>HARVESTING</h3> 
              <p>TARGET:</p>
              <p>HARVESTED AREA:</p>
              <p>YIELD:</p>
              <P>PRODUCTION:</P>
    </div>
      
      
      </div>
    </div>
  </div>
</div>

<!--infanta-->
<div class="modal fade" id="infanta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
          <?php
            $municipality="";
            $district="";
            $query = mysqli_query($connection,"SELECT * FROM tbl_municipality WHERE municipality='MABINI'");
              while($row = mysqli_fetch_array($query)){
                  $municipality=$row['municipality'];  
                  $district=$row['district'];
              }    
          ?>
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $municipality?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
       <h3>PLANTING</h3>
              <p>TARGET:</p>
              <p>PLANTED aAREA:</p>
              <p>NO.OF FARMERS:</p>
       <h3>HARVESTING</h3> 
              <p>TARGET:</p>
              <p>HARVESTED AREA:</p>
              <p>YIELD:</p>
              <P>PRODUCTION:</P>
    </div>
      
      
      </div>
    </div>
  </div>
</div>

<!--san nicolas-->
<div class="modal fade" id="sannicolas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
          <?php
            $municipality="";
            $district="";
            $query = mysqli_query($connection,"SELECT * FROM tbl_municipality WHERE municipality='MABINI'");
              while($row = mysqli_fetch_array($query)){
                  $municipality=$row['municipality'];  
                  $district=$row['district'];
              }    
          ?>
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $municipality?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
       <h3>PLANTING</h3>
              <p>TARGET:</p>
              <p>PLANTED aAREA:</p>
              <p>NO.OF FARMERS:</p>
       <h3>HARVESTING</h3> 
              <p>TARGET:</p>
              <p>HARVESTED AREA:</p>
              <p>YIELD:</p>
              <P>PRODUCTION:</P>
    </div>
      
      
      </div>
    </div>
  </div>
</div>