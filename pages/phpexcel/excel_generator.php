<?php 
 ob_start();
ini_set('memory_limit', '-1');
//error_reporting(0);
include_once("xlsxwriter.class.php");
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

$con=mysqli_connect("localhost","root","r2b2/23","whd");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }




$sql="";
$starts="";
$ends="";

$q=mysqli_query($con,"SELECT * FROM wh_outbound WHERE 1=1 ");
$cnt=2;
$picker_count=0;
$bundler_count=0;



    $style1 = array( ['font-style'=>'bold', 'font-size'=>10, 'font'=>'Calibri', 'border'=>'left,right,top,bottom', 'halign'=>'center'], ['font-style'=>'Calibri', 'font-size'=>10, 'border'=>'left,right,top,bottom', 'halign'=>'left']);
    $style2 = array( 'font-style'=>'bold', 'font-size'=>10, 'font'=>'Calibri', 'border'=>'left,right,top,bottom', 'halign'=>'center');
    $styleFontCalibri  = array('font'=>'Calibri', 'border'=>'left,right,bottom,top', 'halign'=>'left');
    
while($row=mysqli_fetch_assoc($q)){
//echo  $row['date']."</br>";


//$objPHPExcel->getActiveSheet()->setCellValue('AX'.$cnt , $row['packer11_qty']);
$cnt++;
}
$filename="test.xlsx";


mysqli_close($con);

$filename = "example.xlsx";
header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');

// Save
//$helper->write($spreadsheet, __FILE__);
?>