<?php 
ob_end_clean();
ini_set('memory_limit', '-1');
error_reporting(0);
$con=mysqli_connect("localhost","root","r2b2/23","whd");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


//$reader = IOFactory::createReader('Xlsx');
/** PHPExcel_IOFactory */
require_once 'phpexcel/Classes/PHPExcel.php';


$objPHPExcel = new PHPExcel();
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("sample2.xlsx");

$sql="";
$starts="";
$ends="";

$starts=urldecode($_GET['start']);
$ends=urldecode($_GET['end']);
$stat=urldecode($_GET['stat']);

$start=date('Y-m-d',strtotime($starts))." 00:00:00";
$end=date('Y-m-d',strtotime($ends))." 00:00:00";

if($starts!="0" && $ende!="0"){
  $sql.=" AND date(`date`) between '$start' and '$end'  ";    
}
if($stat!=0 || $stat!="0"){
   $sql.=" AND status='$stat'  ";    
 }


$q=mysqli_query($con,"SELECT * FROM wh_outbound WHERE 1=1 ".$sql);
$cnt=2;
$picker_count=0;

$objPHPExcel->setActiveSheetIndex(0);
$bundler_count=0;
while($row=mysqli_fetch_assoc($q)){
$objPHPExcel->getActiveSheet()->setCellValue('A'.$cnt , $row['date']);


//$objPHPExcel->getActiveSheet()->setCellValue('AX'.$cnt , $row['packer11_qty']);
$cnt++;
}
$filename="test";
mysqli_close($con);

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="report.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
/*
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
*/
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

// Save
//$helper->write($spreadsheet, __FILE__);