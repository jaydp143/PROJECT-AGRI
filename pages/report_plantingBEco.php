<?php


// Include the main TCPDF library (search for installation path).
require('../tcpdf/tcpdf.php'); 
require('database.php');
require('./season.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
      
    }

    // Page footer
    public function Footer() {
      $footertext=date('m d y');
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, $footertext, 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
//$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new MYPDF('L', 'mm', array(250,400), true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('REPORT');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(10, 20, 10);
$pdf->SetHeaderMargin(30);
$pdf->SetFooterMargin(10);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 10);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'N', 7);

// add a page
$pdf->AddPage();

   $tbl ='';//variable that holds the content of the table and will display after
   //header of the report, initialize content to tbl
   $tbl.='

   <table width ="100%">
       <tr>
          <td align="center"><h3><b>REPUBLIC OF THE PHILIPPINES
          <br>
          PROVINCE OF PANGASINAN
          <br>PROVINCIAL AGRICULTURE OFFICE
          </b></h3>
          <br>
         '.$_GET['season'].' SEASON  PLANTING REPORT BY ECOSYSTEM CY '.$_GET['year'].'
          <br></td>
        </tr>
    </table>';


    if($_GET['season']=="WET"){
        $startdate=date('Y-m-d', strtotime("03/16/".$_GET['year']));
        $enddate=date('Y-m-d', strtotime("09/15/".$_GET['year']));
    }
    else if ($_GET['season']=="DRY"){
        $startdate=date('Y-m-d', strtotime("09/16/".$_GET['year']));
        $enddate=date('Y-m-d', strtotime("03/15/".($_GET['year']+1)));
    }



    $query1=mysqli_query($connection,"SELECT * FROM tbl_seed_type;");
    $numseedtype=mysqli_num_rows($query1);

    $query2=mysqli_query($connection,"SELECT * FROM tbl_seed;");
    $numseed=mysqli_num_rows($query2);

    $query3=mysqli_query($connection,"SELECT * FROM tbl_ecosystem;");
    $numeco=mysqli_num_rows($query3);

    $tbl.='<table  style="text-align:center" border="1" width="100%">';
    $tbl.='<tr><td  width="12%" rowspan="3"><b><br><br>MUNICIPALITY</b></td>';
    $tbl.='<td  width="22%" colspan="'.($numseedtype+1).'"><b>TOTAL</b></td>';
        while($row1 = mysqli_fetch_array($query3)){  
            $tbl.='<td width="22%" colspan="'.($numseedtype+1).'"><b>'.$row1['ecosystem'].'</b></td>';
        }
    $tbl.='</tr>';

    $tbl.='<tr>';
    for ($x = 1; $x<=$numeco+1; $x++) {
        $tbl.='<td><b>HYBRID</b></td>';
        $tbl.='<td><b>TAGGED SEEDS(Registered, Certified)</b></td>';
        $tbl.='<td><b>UNTAGGED(Good Seeds)</b></td>';
        $tbl.='<td><b>FARMERS SAVED SEEDS</b></td>'; 
        $tbl.='<td><b>TOTAL</b></td>';    
    }
    $tbl.='</tr>';
    $tbl.='<tr>';
    for ($x = 1; $x<=20; $x++) {
        $tbl.='<td><b>AREA</b></td>';    
    }
    $tbl.='</tr>';


   
    $query = mysqli_query($connection,"SELECT 
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area1, 
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area2, 
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area3, 
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='4' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area4, 
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area5,
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='1'AND pl.eco_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area6, 
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='2' AND pl.eco_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area7,  
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='3' AND pl.eco_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area8, 
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='4' AND pl.eco_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area9, 
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.eco_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area10,
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='1'AND pl.eco_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area11, 
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='2' AND pl.eco_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area12,  
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='3' AND pl.eco_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area13, 
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='4' AND pl.eco_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area14, 
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.eco_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area15,
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='1'AND pl.eco_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area16, 
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='2' AND pl.eco_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area17,  
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='3' AND pl.eco_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area18, 
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='4' AND pl.eco_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area19, 
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.eco_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area20;");

    while($row = mysqli_fetch_array($query)){  
        $tbl.='<tr style="background-color:#ABB2B9";>'; 
        $tbl.='<td><b>PANGASINAN</b></td>'; 
        $tbl.='<td>'.$row['area1'].'</td>';  
        $tbl.='<td>'.$row['area2'].'</td>';  
        $tbl.='<td>'.$row['area3'].'</td>'; 
        $tbl.='<td>'.$row['area4'].'</td>';   
        $tbl.='<td>'.$row['area5'].'</td>'; 
        $tbl.='<td>'.$row['area6'].'</td>';   
        $tbl.='<td>'.$row['area7'].'</td>';  
        $tbl.='<td>'.$row['area8'].'</td>';  
        $tbl.='<td>'.$row['area9'].'</td>';  
        $tbl.='<td>'.$row['area10'].'</td>';  
        $tbl.='<td>'.$row['area11'].'</td>';  
        $tbl.='<td>'.$row['area12'].'</td>';  
        $tbl.='<td>'.$row['area13'].'</td>'; 
        $tbl.='<td>'.$row['area14'].'</td>';   
        $tbl.='<td>'.$row['area15'].'</td>'; 
        $tbl.='<td>'.$row['area16'].'</td>';   
        $tbl.='<td>'.$row['area17'].'</td>';  
        $tbl.='<td>'.$row['area18'].'</td>';  
        $tbl.='<td>'.$row['area19'].'</td>';  
        $tbl.='<td>'.$row['area20'].'</td>'; 
        $tbl.='</tr>'; 
    }

    for($x=1;$x<=6;$x++){

        $query = mysqli_query($connection,"SELECT 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area1, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area2, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area3, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='4' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area4, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area5,
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='1'AND pl.eco_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area6, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='2' AND pl.eco_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area7,  
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='3' AND pl.eco_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area8, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='4' AND pl.eco_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area9, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.eco_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area10,
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='1'AND pl.eco_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area11, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='2' AND pl.eco_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area12,  
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='3' AND pl.eco_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area13, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='4' AND pl.eco_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area14, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.eco_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area15,
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='1'AND pl.eco_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area16, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='2' AND pl.eco_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area17,  
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='3' AND pl.eco_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area18, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='4' AND pl.eco_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area19, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.eco_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area20;");

        while($row = mysqli_fetch_array($query)){  
            $tbl.='<tr style="background-color:#BFC9CA";>'; 
            $tbl.='<td><b>DISRICT '.$x.'</b></td>'; 
            $tbl.='<td>'.$row['area1'].'</td>';  
            $tbl.='<td>'.$row['area2'].'</td>';  
            $tbl.='<td>'.$row['area3'].'</td>'; 
            $tbl.='<td>'.$row['area4'].'</td>';   
            $tbl.='<td>'.$row['area5'].'</td>'; 
            $tbl.='<td>'.$row['area6'].'</td>';   
            $tbl.='<td>'.$row['area7'].'</td>';  
            $tbl.='<td>'.$row['area8'].'</td>';  
            $tbl.='<td>'.$row['area9'].'</td>';  
            $tbl.='<td>'.$row['area10'].'</td>';  
            $tbl.='<td>'.$row['area11'].'</td>';  
            $tbl.='<td>'.$row['area12'].'</td>';  
            $tbl.='<td>'.$row['area13'].'</td>'; 
            $tbl.='<td>'.$row['area14'].'</td>';   
            $tbl.='<td>'.$row['area15'].'</td>'; 
            $tbl.='<td>'.$row['area16'].'</td>';   
            $tbl.='<td>'.$row['area17'].'</td>';  
            $tbl.='<td>'.$row['area18'].'</td>';  
            $tbl.='<td>'.$row['area19'].'</td>';  
            $tbl.='<td>'.$row['area20'].'</td>'; 
            $tbl.='</tr>'; 
        }


        $query = mysqli_query($connection,"SELECT mn.mun_id,mn.municipality, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area1, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area2, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area3, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='4' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area4, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area5,
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='1'AND pl.eco_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area6, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='2' AND pl.eco_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area7,  
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='3' AND pl.eco_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area8, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='4' AND pl.eco_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area9, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.eco_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area10,
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='1'AND pl.eco_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area11, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='2' AND pl.eco_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area12,  
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='3' AND pl.eco_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area13, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='4' AND pl.eco_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area14, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.eco_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area15,
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='1'AND pl.eco_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area16, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='2' AND pl.eco_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area17,  
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='3' AND pl.eco_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area18, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='4' AND pl.eco_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area19, 
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.eco_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area20
        FROM tbl_municipality as mn WHERE mn.district='".$x."' GROUP BY  mn.mun_id ASC");

        while($row = mysqli_fetch_array($query)){  
            $tbl.='<tr>'; 
            $tbl.='<td>'.$row['municipality'].'</td>'; 
            $tbl.='<td>'.$row['area1'].'</td>';  
            $tbl.='<td>'.$row['area2'].'</td>';  
            $tbl.='<td>'.$row['area3'].'</td>'; 
            $tbl.='<td>'.$row['area4'].'</td>';   
            $tbl.='<td>'.$row['area5'].'</td>'; 
            $tbl.='<td>'.$row['area6'].'</td>';   
            $tbl.='<td>'.$row['area7'].'</td>';  
            $tbl.='<td>'.$row['area8'].'</td>';  
            $tbl.='<td>'.$row['area9'].'</td>';  
            $tbl.='<td>'.$row['area10'].'</td>';  
            $tbl.='<td>'.$row['area11'].'</td>';  
            $tbl.='<td>'.$row['area12'].'</td>';  
            $tbl.='<td>'.$row['area13'].'</td>'; 
            $tbl.='<td>'.$row['area14'].'</td>';   
            $tbl.='<td>'.$row['area15'].'</td>'; 
            $tbl.='<td>'.$row['area16'].'</td>';   
            $tbl.='<td>'.$row['area17'].'</td>';  
            $tbl.='<td>'.$row['area18'].'</td>';  
            $tbl.='<td>'.$row['area19'].'</td>';  
            $tbl.='<td>'.$row['area20'].'</td>'; 
            $tbl.='</tr>'; 
        }
    }
    $tbl.='</table>';  

    $pdf->writeHTML($tbl, true, false, false, false, '');
    $savename="REPORT.pdf";
    $pdf->Output($savename, 'I');
//============================================================+
// END OF FILE
//============================================================+