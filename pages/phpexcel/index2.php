<?php 
ob_end_clean();
ini_set('memory_limit', '-1');
error_reporting(0);
$con=mysqli_connect("localhost","root","","whd");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


//$reader = IOFactory::createReader('Xlsx');
/** PHPExcel_IOFactory */
require_once 'Classes/PHPExcel.php';


$objPHPExcel = new PHPExcel();
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("sample2.xlsx");




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
$objPHPExcel->getActiveSheet()->setCellValue('B'.$cnt , $row['control_no']);
$objPHPExcel->getActiveSheet()->setCellValue('C'.$cnt , $row['warehouse_no']);
if($row['picker_person1']!=""){$picker_count=$picker_count+1;}else
if($row['picker_person2']!=""){$picker_count=$picker_count+1;}else
if($row['picker_person3']!=""){$picker_count=$picker_count+1;}else
if($row['picker_person4']!=""){$picker_count=$picker_count+1;}
$objPHPExcel->getActiveSheet()->setCellValue('D'.$cnt , $picker_count);
$objPHPExcel->getActiveSheet()->setCellValue('E'.$cnt , $row['pickers_1']);
if( $row['pickers_1_sign']!="" ||  $row['pickers_1_sign']!=''){
$objPHPExcel->getActiveSheet()->setCellValue('F'.$cnt , $row['pickers_1_sign']);
}

$objPHPExcel->getActiveSheet()->setCellValue('G'.$cnt , $row['pickers_2']);
if( $row['pickers_2_sign']!="" ||  $row['pickers_2_sign']!=''){
$objPHPExcel->getActiveSheet()->setCellValue('H'.$cnt , $row['pickers_2_sign']);
}

$objPHPExcel->getActiveSheet()->setCellValue('I'.$cnt , $row['pickers_3']);
if( $row['pickers_3_sign']!="" ||  $row['pickers_3_sign']!=''){
$objPHPExcel->getActiveSheet()->setCellValue('J'.$cnt , $row['pickers_3_sign']);
}
$objPHPExcel->getActiveSheet()->setCellValue('K'.$cnt , $row['pickers_3_remakrs']);

$objPHPExcel->getActiveSheet()->setCellValue('L'.$cnt , $row['pickers_4']);
if( $row['pickers_4_sign']!="" ||  $row['pickers_4_sign']!=''){
$objPHPExcel->getActiveSheet()->setCellValue('M'.$cnt , $row['pickers_4_sign']);
}

$objPHPExcel->getActiveSheet()->setCellValue('N'.$cnt , $row['pickers_4_sign']); // FOR CSS NAME SHOULD BE


$objPHPExcel->getActiveSheet()->setCellValue('O'.$cnt , date('H:m',strtotime($row['picking_starttime']))); // time start
$objPHPExcel->getActiveSheet()->setCellValue('P'.$cnt , date('d/m/Y',strtotime($row['picking_starttime']))); //date start
$objPHPExcel->getActiveSheet()->setCellValue('Q'.$cnt , date('H:m',strtotime($row['picking_endtime']))); //date end
$objPHPExcel->getActiveSheet()->setCellValue('R'.$cnt , $row['team_lead']); //date start

	//*******************************************************FOR PACKING*************************************///
$objPHPExcel->getActiveSheet()->setCellValue('S'.$cnt , $row['picking_receive_by']); 
if($row['packer_person1']!=""){$packer_count=$packer_count+1;}else
if($row['packer_person2']!=""){$packer_count=$packer_count+1;}else
if($row['packer_person3']!=""){$packer_count=$packer_count+1;}else
if($row['packer_person4']!=""){$packer_count=$packer_count+1;}
$objPHPExcel->getActiveSheet()->setCellValue('T'.$cnt , $packer_count); 

$objPHPExcel->getActiveSheet()->setCellValue('U'.$cnt , $row['packers_5']);
if( $row['packers_5_sign']!="" ||  $row['packers_5_sign']!=''){
$objPHPExcel->getActiveSheet()->setCellValue('V'.$cnt , $row['packers_5_sign']);
}


$objPHPExcel->getActiveSheet()->setCellValue('W'.$cnt , $row['packers_6']);
if( $row['packers_6_sign']!="" ||  $row['packers_6_sign']!=''){
$objPHPExcel->getActiveSheet()->setCellValue('X'.$cnt , $row['packers_6_sign']);
}


$objPHPExcel->getActiveSheet()->setCellValue('Y'.$cnt , $row['packers_7']);
if( $row['packers_7_sign']!="" ||  $row['packers_7_sign']!=''){
$objPHPExcel->getActiveSheet()->setCellValue('Z'.$cnt , $row['packers_7_sign']);
}

if($row['packer7_startdate']!="" ||  $row['packer7_startdate']!=''){
$objPHPExcel->getActiveSheet()->setCellValue('AA'.$cnt , date('d/m/Y',strtotime($row['packer7_startdate']))); //date start
$objPHPExcel->getActiveSheet()->setCellValue('AB'.$cnt , date('H:m',strtotime($row['packer7_startdate']))); // time start
$objPHPExcel->getActiveSheet()->setCellValue('AC'.$cnt , date('d/m/Y',strtotime($row['packer7_enddate']))); //date end
$objPHPExcel->getActiveSheet()->setCellValue('AD'.$cnt , date('H:m',strtotime($row['packer7_enddate']))); // time end
}

$objPHPExcel->getActiveSheet()->setCellValue('AE'.$cnt , $row['packers_8']);
if( $row['packers_8_sign']!="" ||  $row['packers_8_sign']!=''){
$objPHPExcel->getActiveSheet()->setCellValue('AF'.$cnt , $row['packers_8_sign']);
}

if($row['packer8_startdate']!="" ||  $row['packer8_startdate']!=''){
$objPHPExcel->getActiveSheet()->setCellValue('AG'.$cnt , date('d/m/Y',strtotime($row['packer8_startdate']))); //date start
$objPHPExcel->getActiveSheet()->setCellValue('AH'.$cnt , date('H:m',strtotime($row['packer8_startdate']))); // time start

$objPHPExcel->getActiveSheet()->setCellValue('AI'.$cnt , date('d/m/Y',strtotime($row['packer8_enddate']))); //date end
$objPHPExcel->getActiveSheet()->setCellValue('AJ'.$cnt , date('H:m',strtotime($row['packer8_enddate']))); // time end
}

$objPHPExcel->getActiveSheet()->setCellValue('AK'.$cnt , $row['packers_9']);
if( $row['packers_9_sign']!="" ||  $row['packers_9_sign']!=''){
$objPHPExcel->getActiveSheet()->setCellValue('AL'.$cnt , $row['packers_9_sign']);
}
if($row['packer9_startdate']!="" ||  $row['packer9_startdate']!=''){

$objPHPExcel->getActiveSheet()->setCellValue('AM'.$cnt , date('d/m/Y',strtotime($row['packer9_startdate']))); //date start
$objPHPExcel->getActiveSheet()->setCellValue('AN'.$cnt , date('H:m',strtotime($row['packer9_startdate']))); // time start
//$objPHPExcel->getActiveSheet()->setCellValue('AO'.$cnt , date('d/m/Y',strtotime($row['packer9_enddate'])); //date end
$objPHPExcel->getActiveSheet()->setCellValue('AO'.$cnt , date('H:m',strtotime($row['packer9_enddate']))); // time end
}

$objPHPExcel->getActiveSheet()->setCellValue('AP'.$cnt , $row['packer10_qty']);
$objPHPExcel->getActiveSheet()->setCellValue('AQ'.$cnt , $row['packer10_planner']);
$objPHPExcel->getActiveSheet()->setCellValue('AR'.$cnt , $row['packer10_planner']); //signature

$objPHPExcel->getActiveSheet()->setCellValue('AS'.$cnt , $row['packer11_qty']);
$objPHPExcel->getActiveSheet()->setCellValue('AT'.$cnt , $row['packer11_encoder']);


$objPHPExcel->getActiveSheet()->setCellValue('AU'.$cnt , $row['packer12_qty']);
$objPHPExcel->getActiveSheet()->setCellValue('AV'.$cnt , $row['packer12_whseman']);
$objPHPExcel->getActiveSheet()->setCellValue('AW'.$cnt , $row['packing_inspected_by']);

//$objPHPExcel->getActiveSheet()->setCellValue('AX'.$cnt , $row['packer11_qty']);
$cnt++;
}
$filename="test";
mysqli_close($con);

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="01simple.xlsx"');
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