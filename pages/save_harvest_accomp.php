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
            $production1 =$_POST['production1'][$i];
            $area2 =$_POST['area2'][$i];
            $production2 =$_POST['production2'][$i];
            $area3 =$_POST['area3'][$i];
            $production3 =$_POST['production3'][$i];
            $date_monitored =$_POST['date'][$i];
            $user=$_SESSION['username'];
            if ($area1!=0 && $production1!=0){
            $yield1 =($production1/$area1);
                mysqli_query($connection,"INSERT INTO tbl_harvesting (mun_id,seed_id,  eco_id, area, yield, production, date_monitored, user) VALUES ('$municipality', '$seed',  '$ecosystem1',  '$area1', '$yield1','$production1', '$date_monitored', '$user')");
            }
        
            if ($area2!=0 && $production2!=0){
            $yield2 =($production2/$area2);
            mysqli_query($connection,"INSERT INTO tbl_harvesting (mun_id,seed_id,  eco_id, area, yield, production, date_monitored, user) VALUES ('$municipality', '$seed',  '$ecosystem2',  '$area2', '$yield2','$production2', '$date_monitored', '$user')");
            }

            if ($area3!=0 && $production3!=0){
            $yield3 =($production3/$area3);
            mysqli_query($connection,"INSERT INTO tbl_harvesting (mun_id,seed_id,  eco_id, area, yield, production, date_monitored, user) VALUES ('$municipality', '$seed',  '$ecosystem3',  '$area3', '$yield3','$production3', '$date_monitored', '$user')");
            }
            
          
      }  
      echo"DATA SUCCESSFULLY INSERTED.";
     
 }  
  
 ?> 