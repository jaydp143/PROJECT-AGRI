 
 <?php
    function getAccomplishmentHarvesting($municipality) {
      require('./database.php');
      require('./season.php');
      $query = mysqli_query($connection,"SELECT  (SELECT COALESCE(SUM(area), 0) AS ar  FROM tbl_harvesting as pl WHERE pl.mun_id=$municipality AND  pl.date_monitored BETWEEN '".$startdate."' AND '".$enddate."') as area,
      (SELECT COALESCE(SUM(target),0) as t FROM tbl_target as tr WHERE tr.mun_id=$municipality AND tr.year='$seasonYear' AND tr.program='HARVESTING')as target,
      (((SELECT COALESCE(SUM(area), 0) AS ar  FROM tbl_harvesting as pl WHERE pl.mun_id=$municipality AND  pl.date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(target),0) as t FROM tbl_target as tr WHERE tr.mun_id=$municipality AND tr.year='$seasonYear' AND tr.program='HARVESTING'))*100) as percentage");
      $row = mysqli_fetch_array($query);
      $percent= round($row['percentage']);
      if ($percent>100){
        echo "filred";
      }
      if (($percent<=100)&&($percent>75)){
        echo "filgreen";
      }
      if (($percent<=75)&&($percent>50)){
        echo "filblue";
      }
      if (($percent<=50)&&($percent>25)){
        echo "filorange";
      }
      if ($percent<=25){
        echo "filyellow";
      }
    }

    function getAccomplishment($municipality) {
      require('./database.php');
      require('./season.php');
      $query = mysqli_query($connection,"SELECT  (SELECT COALESCE(SUM(areas), 0) AS ar  FROM tbl_planting as pl WHERE pl.mun_id=$municipality AND  pl.date_monitored BETWEEN '".$startdate."' AND '".$enddate."') as area,
      (SELECT COALESCE(SUM(target),0) as t FROM tbl_target as tr WHERE tr.mun_id=$municipality AND tr.year='$seasonYear' AND tr.program='PLANTING')as target,
      (((SELECT COALESCE(SUM(areas), 0) AS ar  FROM tbl_planting as pl WHERE pl.mun_id=$municipality AND  pl.date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(target),0) as t FROM tbl_target as tr WHERE tr.mun_id=$municipality AND tr.year='$seasonYear' AND tr.program='PLANTING'))*100) as percentage");
      $row = mysqli_fetch_array($query);
      $percent= round($row['percentage']);
      if ($percent>100){
        echo "filred";
      }
      if (($percent<=100)&&($percent>75)){
        echo "filgreen";
      }
      if (($percent<=75)&&($percent>50)){
        echo "filblue";
      }
      if (($percent<=50)&&($percent>25)){
        echo "filorange";
      }
      if ($percent<=25){
        echo "filyellow";
      }
        
    }

    function getRank($municipality) {
      require('./database.php');
      require('./season.php');
      $query = mysqli_query($connection,"SELECT mn.mun_id,
      (SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as hr WHERE hr.mun_id=mn.mun_id )as yield,
        (RANK() OVER(ORDER BY (SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as hr WHERE hr.mun_id=mn.mun_id ) DESC))as Rank
        FROM tbl_harvesting as mn
        GROUP BY mn.mun_id  ORDER BY Rank");
    
      $r=0;
      while($row = mysqli_fetch_array($query)){
         if($municipality==$row['mun_id']){
            $r=$row['Rank'];
            
         }        
      }
      switch($r){
        case 1:
          echo"filred"; //purple
          break;
        case 2:
          echo"filmaroon"; // blue
          break;
        case 3:
          echo"filpurple"; //green
          break;
        case 4:
          echo"filindigo"; // orange
          break;
        case 5:
          echo"filblue"; // red
          break;
        case 6:
          echo"filgreen"; // red
          break;
        case 7:
          echo"filyellowgreen"; // red
          break;
        case 8:
          echo"filorange"; // red
          break;
        case 9:
          echo"filyellow"; // red
          break;
        case 10:
          echo"filred0"; // red
          break;
        default:
          echo"filgray"; //pink

      } 
      

      
    }

?>