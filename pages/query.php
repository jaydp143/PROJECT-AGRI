 
 <?php

    function getPlantingPercentage($municipality) {
      require('./database.php');
      require('./season.php');
      $query = mysqli_query($connection,"SELECT  (SELECT COALESCE(SUM(areas), 0) AS ar  FROM tbl_planting as pl WHERE pl.mun_id=$municipality AND  pl.date_monitored BETWEEN '".$startdate."' AND '".$enddate."') as area,
      (SELECT COALESCE(SUM(target),0) as t FROM tbl_target as tr WHERE tr.mun_id=$municipality AND tr.year='$seasonYear' AND tr.program='PLANTING' AND tr.season='$season')as target,
      (((SELECT COALESCE(SUM(areas), 0) AS ar  FROM tbl_planting as pl WHERE pl.mun_id=$municipality AND  pl.date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(target),0) as t FROM tbl_target as tr WHERE tr.mun_id=$municipality AND tr.year='$seasonYear' AND tr.program='PLANTING' AND tr.season='$season'))*100) as percentage");
      $row = mysqli_fetch_array($query);
      $percent= round($row['percentage']);
      echo $percent;
    }

    function getPlantingPercentagePrevSeason($municipality,$season,$year) {
      require('./database.php');
      //require('./season.php');
      $startdate="";
      $enddate="";
      if($season=="WET"){
        $startdate=date('Y-m-d', strtotime("03/16/".$year));
        $enddate=date('Y-m-d', strtotime("09/15/".$year));
      }
      if($season=="DRY"){
        $startdate=date('Y-m-d', strtotime("09/16/".$year));
        $enddate=date('Y-m-d', strtotime("03/15/".($year+1)));
      }

      $query = mysqli_query($connection,"SELECT  (SELECT COALESCE(SUM(areas), 0) AS ar  FROM tbl_planting as pl WHERE pl.mun_id=$municipality AND  pl.date_monitored BETWEEN '".$startdate."' AND '".$enddate."') as area,
      (SELECT COALESCE(SUM(target),0) as t FROM tbl_target as tr WHERE tr.mun_id=$municipality AND tr.year='$year' AND tr.program='PLANTING')as target,
      (((SELECT COALESCE(SUM(areas), 0) AS ar  FROM tbl_planting as pl WHERE pl.mun_id=$municipality AND  pl.date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(target),0) as t FROM tbl_target as tr WHERE tr.mun_id=$municipality AND tr.year='$year' AND tr.program='PLANTING' AND tr.season='$season'))*100) as percentage");
      $row = mysqli_fetch_array($query);
      $percent= round($row['percentage']);
      echo $percent;
    }


    function getPlantingArea($municipality) {
      require('./database.php');
      require('./season.php');
      $query = mysqli_query($connection,"SELECT  (SELECT COALESCE(SUM(areas), 0) AS ar  FROM tbl_planting as pl WHERE pl.mun_id=$municipality AND  pl.date_monitored BETWEEN '".$startdate."' AND '".$enddate."') as area,
      (SELECT COALESCE(SUM(target),0) as t FROM tbl_target as tr WHERE tr.mun_id=$municipality AND tr.year='$seasonYear' AND tr.program='PLANTING' AND tr.season='$season')as target,
      (((SELECT COALESCE(SUM(areas), 0) AS ar  FROM tbl_planting as pl WHERE pl.mun_id=$municipality AND  pl.date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(target),0) as t FROM tbl_target as tr WHERE tr.mun_id=$municipality AND tr.year='$seasonYear' AND tr.program='PLANTING' AND tr.season='$season'))*100) as percentage");
      $row = mysqli_fetch_array($query);
      $area=number_format($row['area'],2);
      echo $area;
        
    }

    function getPlantingAreaPrevSeason($municipality,$season,$year) {
      require('./database.php');
      //require('./season.php');
      $startdate="";
      $enddate="";
      if($season=="WET"){
        $startdate=date('Y-m-d', strtotime("03/16/".$year));
        $enddate=date('Y-m-d', strtotime("09/15/".$year));
      }
      if($season=="DRY"){
        $startdate=date('Y-m-d', strtotime("09/16/".$year));
        $enddate=date('Y-m-d', strtotime("03/15/".($year+1)));
      }
      $query = mysqli_query($connection,"SELECT  (SELECT COALESCE(SUM(areas), 0) AS ar  FROM tbl_planting as pl WHERE pl.mun_id=$municipality AND  pl.date_monitored BETWEEN '".$startdate."' AND '".$enddate."') as area,
      (SELECT COALESCE(SUM(target),0) as t FROM tbl_target as tr WHERE tr.mun_id=$municipality AND tr.year='$year' AND tr.program='PLANTING' AND tr.season='$season')as target,
      (((SELECT COALESCE(SUM(areas), 0) AS ar  FROM tbl_planting as pl WHERE pl.mun_id=$municipality AND  pl.date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(target),0) as t FROM tbl_target as tr WHERE tr.mun_id=$municipality AND tr.year='$year' AND tr.program='PLANTING' AND tr.season='$season'))*100) as percentage");
      $row = mysqli_fetch_array($query);
      $area=number_format($row['area'],2);
      echo $area;
        
    }

    function getHarvestingDetails($municipality) {
      require('./database.php');
      require('./season.php');
      
      $query = mysqli_query($connection,"SELECT mn.mun_id,mn.municipality, 
        (SELECT target FROM tbl_target as tr WHERE tr.mun_id='".$municipality."' AND tr.program='HARVESTING'AND tr.season='".$season."' AND year='".$seasonYear."')target,
        (SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl WHERE pl.mun_id='".$municipality."' AND   date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area, 
        (SELECT COALESCE(SUM(production), 0) FROM tbl_harvesting as pl WHERE pl.mun_id='".$municipality."' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')production,
        ((SELECT COALESCE(SUM(production), 0) FROM tbl_harvesting as pl WHERE pl.mun_id='".$municipality."' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl WHERE pl.mun_id='".$municipality."' AND   date_monitored BETWEEN '".$startdate."' AND '".$enddate."'))yield,
        (((SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl WHERE pl.mun_id='".$municipality."' AND   date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT target FROM tbl_target as tr WHERE tr.mun_id='".$municipality."' AND tr.program='HARVESTING' AND tr.season='".$season."' AND year='".$seasonYear."'))*100) percentageM
        FROM tbl_municipality as mn WHERE mn.mun_id='".$municipality."' ORDER BY  mn.mun_id ASC;");
      $row = mysqli_fetch_array($query);
      $mun_name=$row['municipality'];
      $areaharvested=number_format($row['area'],2);
      $production=number_format($row['production'],2);
      $yield=number_format($row['yield'],2);
      $harvestPercentage=number_format($row['percentageM'],2);
      echo "MUNICIPALITY: ".$mun_name."\n AREA HARVESTED: ".$areaharvested." ha \n PRODUCTION: ".$production." \n YIELD: ".$yield." \n PERCENTAGE: ".$harvestPercentage."%";
        
    }

    function getHarvestingDetailsPrevSeason($municipality,$season,$seasonYear) {
      require('./database.php');
      //require('./season.php');
      $startdate="";
      $enddate="";
      if($season=="WET"){
        $startdate=date('Y-m-d', strtotime("03/16/".$seasonYear));
        $enddate=date('Y-m-d', strtotime("09/15/".$seasonYear));
      }
      if($season=="DRY"){
        $startdate=date('Y-m-d', strtotime("09/16/".$seasonYear));
        $enddate=date('Y-m-d', strtotime("03/15/".($seasonYear+1)));
      }

      $query = mysqli_query($connection,"SELECT mn.mun_id,mn.municipality, 
        (SELECT target FROM tbl_target as tr WHERE tr.mun_id='".$municipality."' AND tr.program='HARVESTING'AND tr.season='".$season."' AND year='".$seasonYear."')target,
        (SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl WHERE pl.mun_id='".$municipality."' AND   date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area, 
        (SELECT COALESCE(SUM(production), 0) FROM tbl_harvesting as pl WHERE pl.mun_id='".$municipality."' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')production,
        ((SELECT COALESCE(SUM(production), 0) FROM tbl_harvesting as pl WHERE pl.mun_id='".$municipality."' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl WHERE pl.mun_id='".$municipality."' AND   date_monitored BETWEEN '".$startdate."' AND '".$enddate."'))yield,
        (((SELECT COALESCE(SUM(area), 0) FROM tbl_harvesting as pl WHERE pl.mun_id='".$municipality."' AND   date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT target FROM tbl_target as tr WHERE tr.mun_id='".$municipality."' AND tr.program='HARVESTING' AND tr.season='".$season."' AND year='".$seasonYear."'))*100) percentageM
        FROM tbl_municipality as mn WHERE mn.mun_id='".$municipality."' ORDER BY  mn.mun_id ASC;");
      $row = mysqli_fetch_array($query);
      $mun_name=$row['municipality'];
      $areaharvested=number_format($row['area'],2);
      $production=number_format($row['production'],2);
      $yield=number_format($row['yield'],2);
      $harvestPercentage=number_format($row['percentageM'],2);
      echo "MUNICIPALITY: ".$mun_name."\n AREA HARVESTED: ".$areaharvested." ha \n PRODUCTION: ".$production." \n YIELD: ".$yield." \n PERCENTAGE: ".$harvestPercentage."%";
        
    }


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

    function getAccomplishmentHarvestingPrevSeason($municipality,$season,$seasonYear) {
      require('./database.php');
      //require('./season.php');
      $startdate="";
      $enddate="";
      if($season=="WET"){
        $startdate=date('Y-m-d', strtotime("03/16/".$seasonYear));
        $enddate=date('Y-m-d', strtotime("09/15/".$seasonYear));
      }
      if($season=="DRY"){
        $startdate=date('Y-m-d', strtotime("09/16/".$seasonYear));
        $enddate=date('Y-m-d', strtotime("03/15/".($seasonYear+1)));
      }

      $query = mysqli_query($connection,"SELECT  (SELECT COALESCE(SUM(area), 0) AS ar  FROM tbl_harvesting as pl WHERE pl.mun_id=$municipality AND  pl.date_monitored BETWEEN '".$startdate."' AND '".$enddate."') as area,
      (SELECT COALESCE(SUM(target),0) as t FROM tbl_target as tr WHERE tr.mun_id=$municipality AND tr.season='".$season."' AND tr.year='$seasonYear' AND tr.program='HARVESTING')as target,
      (((SELECT COALESCE(SUM(area), 0) AS ar  FROM tbl_harvesting as pl WHERE pl.mun_id=$municipality AND  pl.date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(target),0) as t FROM tbl_target as tr WHERE tr.mun_id=$municipality AND tr.season='".$season."' AND  tr.year='$seasonYear' AND tr.program='HARVESTING'))*100) as percentage");
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
      (SELECT COALESCE(SUM(target),0) as t FROM tbl_target as tr WHERE tr.mun_id=$municipality AND tr.year='$seasonYear' AND tr.program='PLANTING' AND tr.season='$season')as target,
      (((SELECT COALESCE(SUM(areas), 0) AS ar  FROM tbl_planting as pl WHERE pl.mun_id=$municipality AND  pl.date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(target),0) as t FROM tbl_target as tr WHERE tr.mun_id=$municipality AND tr.year='$seasonYear' AND tr.program='PLANTING' AND tr.season='$season'))*100) as percentage");
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

    function getAccomplishmentPrevSeason($municipality,$season,$year) {
      require('./database.php');
      //require('./season.php');
      $startdate="";
      $enddate="";
      if($season=="WET"){
        $startdate=date('Y-m-d', strtotime("03/16/".$year));
        $enddate=date('Y-m-d', strtotime("09/15/".$year));
      }
      if($season=="DRY"){
        $startdate=date('Y-m-d', strtotime("09/16/".$year));
        $enddate=date('Y-m-d', strtotime("03/15/".($year+1)));
      }

      $query = mysqli_query($connection,"SELECT  (SELECT COALESCE(SUM(areas), 0) AS ar  FROM tbl_planting as pl WHERE pl.mun_id=$municipality AND  pl.date_monitored BETWEEN '".$startdate."' AND '".$enddate."') as area,
      (SELECT COALESCE(SUM(target),0) as t FROM tbl_target as tr WHERE tr.mun_id=$municipality AND tr.year='$year' AND tr.program='PLANTING' AND tr.season='$season')as target,
      (((SELECT COALESCE(SUM(areas), 0) AS ar  FROM tbl_planting as pl WHERE pl.mun_id=$municipality AND  pl.date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(target),0) as t FROM tbl_target as tr WHERE tr.mun_id=$municipality AND tr.year='$year' AND tr.program='PLANTING' AND tr.season='$season'))*100) as percentage");
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