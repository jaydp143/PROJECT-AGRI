<?php  
require('./database.php');
require('./session.php');



 $number = count($_POST["municipality"]);  
 if($number > 0)  
 {  
     
     
    
     
      for($i=0; $i<$number; $i++)  
      {     $mun=mysqli_real_escape_string($connection, $_POST["municipality"][$i]);
            $sd=mysqli_real_escape_string($connection, $_POST["seed"][$i]);
            $query = mysqli_query($connection,"SELECT mun_id FROM tbl_municipality WHERE  municipality='$mun'");
            $row = mysqli_fetch_array($query);
            $query1 = mysqli_query($connection,"SELECT seed_id FROM tbl_seed WHERE  seed_description='$sd'");
            $row1=mysqli_fetch_array($query1);
            $municipality=$row['mun_id'];
            $seed=$row1['seed_id'];
            $ecosystem1 =1;
            $ecosystem2 =2;
            $ecosystem3 =3;
            //$season =mysqli_real_escape_string($connection,$_POST['season']);
            $area1 =$_POST['area1'][$i];
            $farmer1 =$_POST['farmer1'][$i];
            $area2 =$_POST['area2'][$i];
            $farmer2 =$_POST['farmer2'][$i];
            $area3 =$_POST['area3'][$i];
            $farmer3 =$_POST['farmer3'][$i];
            $date_monitored =$_POST['date'][$i];
            $date_harvest=date('Y-m-d', strtotime($_POST['date'][$i]. ' + 115 days'));
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
          
      }  
      echo"DATA SUCCESSFULLY INSERTED.";
     
 }  
  
 ?> 