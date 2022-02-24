<?php
$season="";
$seasonYear="";
$startdate="";
$enddate="";
$dateNow = date('Y-m-d');
$dateNow=date('Y-m-d', strtotime($dateNow));
$year=2021;
$dateB="03/16/".$year;
$dateE="09/15/".$year;
$dateYearEnd="12/31/".($year-1);
$DateBegin = date('Y-m-d', strtotime($dateB));
$DateEnd = date('Y-m-d', strtotime($dateE));
    
if (($dateNow >= $DateBegin) && ($dateNow <= $DateEnd)){
    $season="WET"; 
    $seasonYear=$year;
    $startdate=date('Y-m-d', strtotime("03/16/".$year));
    $enddate=date('Y-m-d', strtotime("09/15/".$year));
    
}else{
    $season="DRY";
    $startdate=date('Y-m-d', strtotime("09/16/".$year));
    $enddate=date('Y-m-d', strtotime("03/15/".($year+1)));
    if(($dateNow>$dateYearEnd)&&($dateNow<$DateBegin)){
        $seasonYear=$year-1;
        $startdate=date('Y-m-d', strtotime("09/16/".($year-1)));
        $enddate=date('Y-m-d', strtotime("03/15/".$year));
    }
}

?>