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
$pdf = new MYPDF('L', 'mm', array(210,297), true, 'UTF-8', false);
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
$pdf->SetMargins(10, 10, 10);
$pdf->SetHeaderMargin(10);
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
$pdf->SetFont('helvetica', 'N', 6.5);

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
          <br>
          PROVINCIAL AGRICULTURE OFFICE
          </b></h3>
          <br>
          '.$_GET['season'].' SEASON  PLANTING REPORT BY SEED TYPE CY '.$_GET['year'].'-'.($_GET['year']+1).'
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
    $tbl.='<tr>
      <td  width="20%" rowspan="2"><b><br><br>MUNICIPALITY</b></td>';

        while($row1 = mysqli_fetch_array($query1)){  
            $tbl.='<td width="16%" colspan="2"><b>'.$row1['seed_type'].'</b></td>';
        }
    $tbl.='<td colspan="2" width="16%"><b>TOTAL</b></td>';
    $tbl.='</tr>';

    $tbl.='<tr>';
    for ($x = 1; $x<=$numseedtype+1; $x++) {
        $tbl.='
      <td><b>AREA<br>PLANTED</b></td>
      <td><b>NO. OF<br>FARMERS</b></td>';
    }
    $tbl.='</tr>';
    $query = mysqli_query($connection,"SELECT  
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='1'  AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area1, 
    (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')farmer1, 
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area2, 
    (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')farmer2, 
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area3, 
    (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')farmer3, 
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='4' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area4, 
    (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE  pl.seed_type_id='4' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')farmer4,
    (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE   date_monitored BETWEEN '".$startdate."' AND '".$enddate."')areaT, 
    (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE   date_monitored BETWEEN '".$startdate."' AND '".$enddate."')farmerT");

    while($row = mysqli_fetch_array($query)){  
      $tbl.='<tr style="background-color:#85C1E9";>'; 
        $tbl.='<td><b>PANGASINAN</b></td>'; 
        $tbl.='<td>'.$row['area1'].'</td>';  
        $tbl.='<td>'.$row['farmer1'].'</td>';  
        $tbl.='<td>'.$row['area2'].'</td>';  
        $tbl.='<td>'.$row['farmer2'].'</td>'; 
        $tbl.='<td>'.$row['area3'].'</td>';  
        $tbl.='<td>'.$row['farmer3'].'</td>'; 
        $tbl.='<td>'.$row['area4'].'</td>';  
        $tbl.='<td>'.$row['farmer4'].'</td>'; 
        $tbl.='<td>'.$row['areaT'].'</td>';  
        $tbl.='<td>'.$row['farmerT'].'</td>'; 
        $tbl.='</tr>'; 
    }

    for($x=1;$x<=6;$x++){

      $query = mysqli_query($connection,"SELECT  
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='1'  AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area1, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')farmer1, 
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area2, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')farmer2, 
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area3, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')farmer3, 
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='4' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area4, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE  pl.seed_type_id='4' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')farmer4,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE   date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')areaT, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality AS mn ON pl.mun_id=mn.mun_id WHERE   date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')farmerT");

      while($row = mysqli_fetch_array($query)){  
        $tbl.='<tr style="background-color:#ABB2B9";>'; 
          $tbl.='<td><b>DISRICT '.$x.'</b></td>'; 
          $tbl.='<td>'.$row['area1'].'</td>';  
          $tbl.='<td>'.$row['farmer1'].'</td>';  
          $tbl.='<td>'.$row['area2'].'</td>';  
          $tbl.='<td>'.$row['farmer2'].'</td>'; 
          $tbl.='<td>'.$row['area3'].'</td>';  
          $tbl.='<td>'.$row['farmer3'].'</td>'; 
          $tbl.='<td>'.$row['area4'].'</td>';  
          $tbl.='<td>'.$row['farmer4'].'</td>'; 
          $tbl.='<td>'.$row['areaT'].'</td>';  
          $tbl.='<td>'.$row['farmerT'].'</td>'; 
          $tbl.='</tr>'; 
      }

      

      $query = mysqli_query($connection,"SELECT mn.mun_id,mn.municipality, 
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='1'  AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area1, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='1' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')farmer1, 
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area2, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='2' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')farmer2, 
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area3, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='3' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')farmer3, 
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='4' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area4, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_type_id='4' AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')farmer4,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')areaT, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')farmerT
      FROM tbl_municipality as mn WHERE mn.district='".$x."' GROUP BY  mn.mun_id ASC");

      while($row = mysqli_fetch_array($query)){  
          $tbl.='<tr>'; 
          $tbl.='<td>'.$row['municipality'].'</td>'; 
          $tbl.='<td>'.$row['area1'].'</td>';  
          $tbl.='<td>'.$row['farmer1'].'</td>';  
          $tbl.='<td>'.$row['area2'].'</td>';  
          $tbl.='<td>'.$row['farmer2'].'</td>'; 
          $tbl.='<td>'.$row['area3'].'</td>';  
          $tbl.='<td>'.$row['farmer3'].'</td>'; 
          $tbl.='<td>'.$row['area4'].'</td>';  
          $tbl.='<td>'.$row['farmer4'].'</td>'; 
          $tbl.='<td>'.$row['areaT'].'</td>';  
          $tbl.='<td>'.$row['farmerT'].'</td>'; 
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