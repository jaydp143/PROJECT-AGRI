<?php


// Include the main TCPDF library (search for installation path).
require('../tcpdf/tcpdf.php'); 
require('./database.php');
require('./season.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
      
    }

    // Page footer
    public function Footer() {
      $footertext=date('m d y')."-This report was system generated.";
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 7);
        // Page number
        $this->Cell(0, 10, $footertext, 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
//$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new MYPDF('P', 'mm', array(210,297), true, 'UTF-8', false);
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
$pdf->SetFont('helvetica', 'N', 9);

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
          </b>
          <br>
          Provincial Agriculture Office
          </h3>
          <br>
          '.$_GET['season'].' SEASON PLANTING REPORT '.$_GET['year'].'-'.($_GET['year']+1).'
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

    $tbl.='<table  style="text-align:center" border="1" >';
    $tbl.='<tr>
      <td   rowspan="2">PROVINCE/<br>DISTRICT/<br>MUNICIPLITY</td>
      <td   rowspan="2">TOTAL<br>TARGET</td>
      <td  colspan="3" >ACCOMPLISHMENT</td>
      <td   rowspan="2">BALANCE</td>';
    $tbl.='</tr>';

    $tbl.='<tr>
    <td >AREA<br>PLANTED</td>
    <td >NO. OF<br>FARMERS</td>
    <td >PERCENTAGE</td>';
     $tbl.='</tr>';

    //PANGASINAN
     $tbl.='<tr style="background-color:#ABB2B9";>';
     $queryP = mysqli_query($connection,"SELECT 
     (SELECT COALESCE(SUM(target), 0) FROM tbl_target as tr WHERE tr.program='PLANTING' AND 		   tr.season='".$_GET['season']."' AND year='".$_GET['year']."' )target, 
     (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl  WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."')tarea,
     (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."' )tfarmer,
     (((SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl  WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT COALESCE(SUM(target), 0) FROM tbl_target as tr WHERE tr.program='PLANTING' AND tr.season='".$_GET['season']."' AND year='".$_GET['year']."' ))*100)percentage");
    
     while($row1 = mysqli_fetch_array($queryP)){ 
        
       $tbl.='<td><b>PANGASINAN</b></td>';
       $tbl.='<td><b>'.number_format($row1['target'],2).'</b></td>';
       $tbl.='<td><b>'.number_format($row1['tarea'],2).'</b></td>';
       $tbl.='<td><b>'.number_format($row1['tfarmer'],2).'</b></td>';
       $tbl.='<td><b>'.round($row1['percentage']).'%</b></td>';
       $tbl.='<td><b>'.number_format(($row1['target']-$row1['tarea']),2).'</b></td>';
      }
     $tbl.='</tr>';

    for($x=1;$x<=6;$x++){
        //PER DISTRICT
      $tbl.='<tr style="background-color:#F2F3F4";>';
      $queryD = mysqli_query($connection,"SELECT 
      (SELECT  COALESCE(SUM(target), 0) FROM tbl_target as tr INNER JOIN tbl_municipality as mn ON tr.mun_id=mn.mun_id WHERE tr.program='PLANTING' AND tr.season='".$_GET['season']."' AND tr.year='".$_GET['year']."' AND mn.district='".$x."' )target,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')area, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')farmer,
      (((SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl INNER JOIN tbl_municipality as mn ON pl.mun_id=mn.mun_id WHERE date_monitored BETWEEN '".$startdate."' AND '".$enddate."' AND mn.district='".$x."')/(SELECT  COALESCE(SUM(target), 0) FROM tbl_target as tr INNER JOIN tbl_municipality as mn ON tr.mun_id=mn.mun_id WHERE tr.program='PLANTING' AND tr.season='".$_GET['season']."' AND tr.year='".$_GET['year']."' AND mn.district='".$x."' ))*100)percentageD");
      
      while($rowD = mysqli_fetch_array($queryD)){ 
          
        $tbl.='<td><b>DISTRICT '.$x.'</b></td>';
        $tbl.='<td><b>'.number_format($rowD['target'],2).'</b></td>';
        $tbl.='<td><b>'.number_format($rowD['area'],2).'</b></td>';
        $tbl.='<td><b>'.number_format($rowD['farmer'],2).'</b></td>';
        $tbl.='<td><b>'.round($rowD['percentageD']).'%</b></td>';
        $tbl.='<td><b>'.number_format(($rowD['target']-$rowD['area']),2).'</b></td>';
        }
        $tbl.='</tr>';

    
        $queryR = mysqli_query($connection,"SELECT mn.mun_id,mn.municipality, 
        (SELECT target FROM tbl_target as tr WHERE tr.mun_id=mn.mun_id AND tr.program='PLANTING' AND tr.season='".$_GET['season']."' AND tr.year='".$_GET['year']."' )target,
        (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND date_monitored BETWEEN '".$startdate."' AND '".$enddate."')area, 
        (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND date_monitored BETWEEN '".$startdate."' AND '".$enddate."')farmer,
        (((SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND  date_monitored BETWEEN '".$startdate."' AND '".$enddate."')/(SELECT target FROM tbl_target as tr WHERE tr.mun_id=mn.mun_id AND tr.program='PLANTING' AND tr.season='".$_GET['season']."' AND tr.year='".$_GET['year']."' ))*100) percentageM
        FROM tbl_municipality as mn WHERE mn.district='".$x."' ORDER BY  mn.mun_id ASC;");
        
          while($row=mysqli_fetch_array($queryR)){
            
              $tbl.='<tr>';
              $tbl.='<td>'.$row['municipality'].'</td>'; 
              $tbl.='<td>'.number_format($row['target'],2).'</td>';
              $tbl.='<td>'.number_format($row['area'],2).'</td>';
              $tbl.='<td>'.number_format($row['farmer'],2).'</td>';
              $tbl.='<td>'.round($row['percentageM']).'%</td>';
              $tbl.='<td>'.number_format(($row['target']-$row['area']),2).'</td>';
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