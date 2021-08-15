<?php


// Include the main TCPDF library (search for installation path).
require('../tcpdf/tcpdf.php'); 
require('database.php');

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
$pdf = new MYPDF('L', 'mm', array(400,850), true, 'UTF-8', false);
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
$pdf->SetFont('helvetica', 'N', 8);

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
          </b></h3>
          <br>
          DRY SEASON  PLANTING REPORT CY 2020-2021
          <br></td>
        </tr>
    </table>';
    $query1=mysqli_query($connection,"SELECT * FROM tbl_seed_type;");
    $numseedtype=mysqli_num_rows($query1);

    $query2=mysqli_query($connection,"SELECT * FROM tbl_seed;");
    $numseed=mysqli_num_rows($query2);

    $query3=mysqli_query($connection,"SELECT * FROM tbl_ecosystem;");
    $numeco=mysqli_num_rows($query3);

    $tbl.='<table  style="text-align:center" border="1" width="100%">';
    $tbl.='<tr>
      <td  width="5%" rowspan="4">PROVINCE/<br>DISTRICT/<br>MUNICIPLITY</td>
      <td  width="5%" rowspan="4">TOTAL<br>TARGET</td>
      <td  width="5%" rowspan="4">TOTAL<br>ACCOMP.</td>
      <td  width="'.((85/$numseed)*3).'%" >HYBRID</td>
      <td  width="'.((85/$numseed)*6).'%">TAGGED SEEDS(Registered, Certified)</td>
      <td  width="'.((85/$numseed)*3).'%" >UNTAGGED(Good Seeds)</td>
      <td  width="'.(85/$numseed).'%" >FARMERS SAVED SEEDS</td>';
        $tbl.='</tr>';

    $tbl.='<tr>';
        while($row2 = mysqli_fetch_array($query2)){  
            $tbl.='<td width="'.(85/$numseed).'%" colspan="6">'.$row2['seed_description'].'</td>';
        }
    $tbl.='</tr>';
    $tbl.='<tr>';
    for ($x = 1; $x<=$numseed; $x++) {
        $tbl.='
      <td colspan="2">IRRIGATED</td>
      <td colspan="2">RAINFED</td>
      <td colspan="2">UPLAND</td>';
    }
    $tbl.='</tr>';

    $tbl.='<tr>';
    for ($x = 1; $x<=$numseed*6; $x++) {
        $tbl.='
      <td>AREA</td>
      <td>FARMERS</td>';
    }
    $tbl.='</tr>';
    

    
    $queryR = mysqli_query($connection,"SELECT mn.mun_id,mn.municipality, 
      (SELECT target FROM tbl_target as tr WHERE tr.mun_id=mn.mun_id AND tr.project='PLANTING' AND tr.period='WET' AND tr.year='2020' )target,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id)taccomp, 
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='1' AND pl.eco_id='1')area1, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='1' AND pl.eco_id='1')farmer1,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='1' AND pl.eco_id='2')area2, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='1' AND pl.eco_id='2')farmer2,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='1' AND pl.eco_id='3')area3, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='1' AND pl.eco_id='3')farmer3,

      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='2' AND pl.eco_id='1')area4, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='2' AND pl.eco_id='1')farmer4,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='2' AND pl.eco_id='2')area5, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='2' AND pl.eco_id='2')farmer5,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='2' AND pl.eco_id='3')area6, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='2' AND pl.eco_id='3')farmer6,

      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='3' AND pl.eco_id='1')area7, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='3' AND pl.eco_id='1')farmer7,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='3' AND pl.eco_id='2')area8, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='3' AND pl.eco_id='2')farmer8,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_id='3' AND pl.eco_id='3')area9, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='3' AND pl.eco_id='3')farmer9,
      
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='4' AND pl.eco_id='1')area10, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='4' AND pl.eco_id='1')farmer10,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='4' AND pl.eco_id='2')area11, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='4' AND pl.eco_id='2')farmer11,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_id='4' AND pl.eco_id='3')area12, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='4' AND pl.eco_id='3')farmer12,

      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='5' AND pl.eco_id='1')area13, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='5' AND pl.eco_id='1')farmer13,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='5' AND pl.eco_id='2')area14, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='5' AND pl.eco_id='2')farmer14,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_id='5' AND pl.eco_id='3')area15, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='5' AND pl.eco_id='3')farmer15,

      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='6' AND pl.eco_id='1')area16, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='6' AND pl.eco_id='1')farmer16,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='6' AND pl.eco_id='2')area17, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='6' AND pl.eco_id='2')farmer17,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_id='6' AND pl.eco_id='3')area18, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='6' AND pl.eco_id='3')farmer18,

      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='7' AND pl.eco_id='1')area19, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='7' AND pl.eco_id='1')farmer19,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='7' AND pl.eco_id='2')area20, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='7' AND pl.eco_id='2')farmer20,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_id='7' AND pl.eco_id='3')area21, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='7' AND pl.eco_id='3')farmer21,

      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='8' AND pl.eco_id='1')area22, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='8' AND pl.eco_id='1')farmer22,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='8' AND pl.eco_id='2')area23, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='8' AND pl.eco_id='2')farmer23,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_id='8' AND pl.eco_id='3')area24, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='8' AND pl.eco_id='3')farmer24,

      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='9' AND pl.eco_id='1')area25, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='9' AND pl.eco_id='1')farmer25,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='9' AND pl.eco_id='2')area26, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='9' AND pl.eco_id='2')farmer26,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_id='9' AND pl.eco_id='3')area27, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='9' AND pl.eco_id='3')farmer27,

      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='10' AND pl.eco_id='1')area28, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='10' AND pl.eco_id='1')farmer28,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='10' AND pl.eco_id='2')area29, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='10' AND pl.eco_id='2')farmer29,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_id='10' AND pl.eco_id='3')area30, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='10' AND pl.eco_id='3')farmer30,

      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='11' AND pl.eco_id='1')area31, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='11' AND pl.eco_id='1')farmer31,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='11' AND pl.eco_id='2')area32, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='11' AND pl.eco_id='2')farmer32,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_id='11' AND pl.eco_id='3')area33, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='11' AND pl.eco_id='3')farmer33,

      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='12' AND pl.eco_id='1')area34, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='12' AND pl.eco_id='1')farmer34,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='12' AND pl.eco_id='2')area35, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='12' AND pl.eco_id='2')farmer35,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_id='12' AND pl.eco_id='3')area36, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='12' AND pl.eco_id='3')farmer36,

      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='13' AND pl.eco_id='1')area37, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='13' AND pl.eco_id='1')farmer37,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='13' AND pl.eco_id='2')area38, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='13' AND pl.eco_id='2')farmer38,
      (SELECT COALESCE(SUM(areas), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id AND pl.seed_id='13' AND pl.eco_id='3')area39, 
      (SELECT COALESCE(SUM(farmers), 0) FROM tbl_planting as pl WHERE pl.mun_id=mn.mun_id  AND pl.seed_id='13' AND pl.eco_id='3')farmer39
      FROM tbl_municipality as mn ORDER BY  mn.mun_id ASC;");
       
        while($row=mysqli_fetch_array($queryR)){
            $tbl.='<tr>'; 
            $tbl.='<td>'.$row['municipality'].'</td>';   
            $tbl.='<td>'.$row['target'].'</td>'; 
            $tbl.='<td>'.$row['taccomp'].'</td>'; 
            $tbl.='<td>'.$row['area1'].'</td>'; 
            $tbl.='<td>'.$row['farmer1'].'</td>'; 
            $tbl.='<td>'.$row['area2'].'</td>'; 
            $tbl.='<td>'.$row['farmer2'].'</td>'; 
            $tbl.='<td>'.$row['area3'].'</td>'; 
            $tbl.='<td>'.$row['farmer3'].'</td>'; 
            $tbl.='<td>'.$row['area4'].'</td>'; 
            $tbl.='<td>'.$row['farmer4'].'</td>'; 
            $tbl.='<td>'.$row['area5'].'</td>'; 
            $tbl.='<td>'.$row['farmer5'].'</td>'; 
            $tbl.='<td>'.$row['area6'].'</td>'; 
            $tbl.='<td>'.$row['farmer6'].'</td>'; 
            $tbl.='<td>'.$row['area7'].'</td>'; 
            $tbl.='<td>'.$row['farmer7'].'</td>'; 
            $tbl.='<td>'.$row['area8'].'</td>'; 
            $tbl.='<td>'.$row['farmer8'].'</td>'; 
            $tbl.='<td>'.$row['area9'].'</td>'; 
            $tbl.='<td>'.$row['farmer9'].'</td>'; 
            $tbl.='<td>'.$row['area10'].'</td>'; 
            $tbl.='<td>'.$row['farmer10'].'</td>'; 
            $tbl.='<td>'.$row['area11'].'</td>'; 
            $tbl.='<td>'.$row['farmer11'].'</td>'; 
            $tbl.='<td>'.$row['area12'].'</td>'; 
            $tbl.='<td>'.$row['farmer12'].'</td>'; 
            $tbl.='<td>'.$row['area13'].'</td>'; 
            $tbl.='<td>'.$row['farmer13'].'</td>'; 
            $tbl.='<td>'.$row['area14'].'</td>'; 
            $tbl.='<td>'.$row['farmer14'].'</td>'; 
            $tbl.='<td>'.$row['area15'].'</td>'; 
            $tbl.='<td>'.$row['farmer15'].'</td>'; 
            $tbl.='<td>'.$row['area16'].'</td>'; 
            $tbl.='<td>'.$row['farmer16'].'</td>'; 
            $tbl.='<td>'.$row['area17'].'</td>'; 
            $tbl.='<td>'.$row['farmer17'].'</td>'; 
            $tbl.='<td>'.$row['area18'].'</td>'; 
            $tbl.='<td>'.$row['farmer18'].'</td>'; 
            $tbl.='<td>'.$row['area19'].'</td>'; 
            $tbl.='<td>'.$row['farmer19'].'</td>'; 
            $tbl.='<td>'.$row['area20'].'</td>'; 
            $tbl.='<td>'.$row['farmer20'].'</td>'; 
            $tbl.='<td>'.$row['area21'].'</td>'; 
            $tbl.='<td>'.$row['farmer21'].'</td>'; 
            $tbl.='<td>'.$row['area22'].'</td>'; 
            $tbl.='<td>'.$row['farmer22'].'</td>'; 
            $tbl.='<td>'.$row['area23'].'</td>'; 
            $tbl.='<td>'.$row['farmer23'].'</td>'; 
            $tbl.='<td>'.$row['area24'].'</td>'; 
            $tbl.='<td>'.$row['farmer24'].'</td>'; 
            $tbl.='<td>'.$row['area25'].'</td>'; 
            $tbl.='<td>'.$row['farmer25'].'</td>'; 
            $tbl.='<td>'.$row['area26'].'</td>'; 
            $tbl.='<td>'.$row['farmer26'].'</td>'; 
            $tbl.='<td>'.$row['area27'].'</td>'; 
            $tbl.='<td>'.$row['farmer27'].'</td>'; 
            $tbl.='<td>'.$row['area28'].'</td>'; 
            $tbl.='<td>'.$row['farmer28'].'</td>'; 
            $tbl.='<td>'.$row['area29'].'</td>'; 
            $tbl.='<td>'.$row['farmer29'].'</td>'; 
            $tbl.='<td>'.$row['area30'].'</td>'; 
            $tbl.='<td>'.$row['farmer30'].'</td>'; 
            $tbl.='<td>'.$row['area31'].'</td>'; 
            $tbl.='<td>'.$row['farmer31'].'</td>'; 
            $tbl.='<td>'.$row['area32'].'</td>'; 
            $tbl.='<td>'.$row['farmer32'].'</td>'; 
            $tbl.='<td>'.$row['area33'].'</td>'; 
            $tbl.='<td>'.$row['farmer33'].'</td>'; 
            $tbl.='<td>'.$row['area34'].'</td>'; 
            $tbl.='<td>'.$row['farmer34'].'</td>'; 
            $tbl.='<td>'.$row['area35'].'</td>'; 
            $tbl.='<td>'.$row['farmer35'].'</td>'; 
            $tbl.='<td>'.$row['area36'].'</td>'; 
            $tbl.='<td>'.$row['farmer36'].'</td>';
            $tbl.='<td>'.$row['area37'].'</td>'; 
            $tbl.='<td>'.$row['farmer37'].'</td>';  
            $tbl.='<td>'.$row['area38'].'</td>'; 
            $tbl.='<td>'.$row['farmer38'].'</td>'; 
            $tbl.='<td>'.$row['area39'].'</td>'; 
            $tbl.='<td>'.$row['farmer39'].'</td>'; 
            $tbl.='</tr>';
        }

    $tbl.='</table>';  

    $pdf->writeHTML($tbl, true, false, false, false, '');
    $savename="REPORT.pdf";
    $pdf->Output($savename, 'I');
//============================================================+
// END OF FILE
//============================================================+