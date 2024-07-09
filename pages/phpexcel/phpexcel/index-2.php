<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_end_clean();
require_once("vendor/autoload.php"); 
$con=mysqli_connect("localhost","root","","whd");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//$reader = IOFactory::createReader('Xlsx');

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
$spreadsheet = $reader->load('sample2.xlsx');
//$spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
$Excel_writer = new Xlsx($spreadsheet);  /*----- Excel (Xls) Object*/

$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();

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
$bundler_count=0;
while($row=mysqli_fetch_assoc($q)){
$activeSheet->setCellValue('A'.$cnt , $row['date']);
$activeSheet->setCellValue('B'.$cnt , $row['control_no']);
$activeSheet->setCellValue('C'.$cnt , $row['warehouse_no']);
if($row['picker_person1']!=""){$picker_count=$picker_count+1;}else
if($row['picker_person2']!=""){$picker_count=$picker_count+1;}else
if($row['picker_person3']!=""){$picker_count=$picker_count+1;}else
if($row['picker_person4']!=""){$picker_count=$picker_count+1;}
$activeSheet->setCellValue('D'.$cnt , $picker_count);
$activeSheet->setCellValue('E'.$cnt , $row['pickers_1']);
if( $row['pickers_1_sign']!="" ||  $row['pickers_1_sign']!=''){
$activeSheet->setCellValue('F'.$cnt , $row['pickers_1_sign']);
}

$activeSheet->setCellValue('G'.$cnt , $row['pickers_2']);
if( $row['pickers_2_sign']!="" ||  $row['pickers_2_sign']!=''){
$activeSheet->setCellValue('H'.$cnt , $row['pickers_2_sign']);
}

$activeSheet->setCellValue('I'.$cnt , $row['pickers_3']);
if( $row['pickers_3_sign']!="" ||  $row['pickers_3_sign']!=''){
$activeSheet->setCellValue('J'.$cnt , $row['pickers_3_sign']);
}
$activeSheet->setCellValue('K'.$cnt , $row['pickers_3_remakrs']);

$activeSheet->setCellValue('L'.$cnt , $row['pickers_4']);
if( $row['pickers_4_sign']!="" ||  $row['pickers_4_sign']!=''){
$activeSheet->setCellValue('M'.$cnt , $row['pickers_4_sign']);
}

$activeSheet->setCellValue('N'.$cnt , $row['pickers_4_sign']); // FOR CSS NAME SHOULD BE


$activeSheet->setCellValue('O'.$cnt , date('H:m',strtotime($row['picking_starttime']))); // time start
$activeSheet->setCellValue('P'.$cnt , date('d/m/Y',strtotime($row['picking_starttime']))); //date start
$activeSheet->setCellValue('Q'.$cnt , date('H:m',strtotime($row['picking_endtime']))); //date end
$activeSheet->setCellValue('R'.$cnt , $row['team_lead']); //date start

	//*******************************************************FOR PACKING*************************************///
$activeSheet->setCellValue('S'.$cnt , $row['picking_receive_by']); 
if($row['packer_person1']!=""){$packer_count=$packer_count+1;}else
if($row['packer_person2']!=""){$packer_count=$packer_count+1;}else
if($row['packer_person3']!=""){$packer_count=$packer_count+1;}else
if($row['packer_person4']!=""){$packer_count=$packer_count+1;}
$activeSheet->setCellValue('T'.$cnt , $packer_count); 

$activeSheet->setCellValue('U'.$cnt , $row['packers_5']);
if( $row['packers_5_sign']!="" ||  $row['packers_5_sign']!=''){
$activeSheet->setCellValue('V'.$cnt , $row['packers_5_sign']);
}


$activeSheet->setCellValue('W'.$cnt , $row['packers_6']);
if( $row['packers_6_sign']!="" ||  $row['packers_6_sign']!=''){
$activeSheet->setCellValue('X'.$cnt , $row['packers_6_sign']);
}


$activeSheet->setCellValue('Y'.$cnt , $row['packers_7']);
if( $row['packers_7_sign']!="" ||  $row['packers_7_sign']!=''){
$activeSheet->setCellValue('Z'.$cnt , $row['packers_7_sign']);
}

if($row['packer7_startdate']!="" ||  $row['packer7_startdate']!=''){
$activeSheet->setCellValue('AA'.$cnt , date('d/m/Y',strtotime($row['packer7_startdate']))); //date start
$activeSheet->setCellValue('AB'.$cnt , date('H:m',strtotime($row['packer7_startdate']))); // time start
$activeSheet->setCellValue('AC'.$cnt , date('d/m/Y',strtotime($row['packer7_enddate']))); //date end
$activeSheet->setCellValue('AD'.$cnt , date('H:m',strtotime($row['packer7_enddate']))); // time end
}

$activeSheet->setCellValue('AE'.$cnt , $row['packers_8']);
if( $row['packers_8_sign']!="" ||  $row['packers_8_sign']!=''){
$activeSheet->setCellValue('AF'.$cnt , $row['packers_8_sign']);
}

if($row['packer8_startdate']!="" ||  $row['packer8_startdate']!=''){
$activeSheet->setCellValue('AG'.$cnt , date('d/m/Y',strtotime($row['packer8_startdate']))); //date start
$activeSheet->setCellValue('AH'.$cnt , date('H:m',strtotime($row['packer8_startdate']))); // time start

$activeSheet->setCellValue('AI'.$cnt , date('d/m/Y',strtotime($row['packer8_enddate']))); //date end
$activeSheet->setCellValue('AJ'.$cnt , date('H:m',strtotime($row['packer8_enddate']))); // time end
}

$activeSheet->setCellValue('AK'.$cnt , $row['packers_9']);
if( $row['packers_9_sign']!="" ||  $row['packers_9_sign']!=''){
$activeSheet->setCellValue('AL'.$cnt , $row['packers_9_sign']);
}
if($row['packer9_startdate']!="" ||  $row['packer9_startdate']!=''){

$activeSheet->setCellValue('AM'.$cnt , date('d/m/Y',strtotime($row['packer9_startdate']))); //date start
$activeSheet->setCellValue('AN'.$cnt , date('H:m',strtotime($row['packer9_startdate']))); // time start
//$activeSheet->setCellValue('AO'.$cnt , date('d/m/Y',strtotime($row['packer9_enddate'])); //date end
$activeSheet->setCellValue('AO'.$cnt , date('H:m',strtotime($row['packer9_enddate']))); // time end
}

$activeSheet->setCellValue('AP'.$cnt , $row['packer10_qty']);
$activeSheet->setCellValue('AQ'.$cnt , $row['packer10_planner']);
$activeSheet->setCellValue('AR'.$cnt , $row['packer10_planner']); //signature

$activeSheet->setCellValue('AS'.$cnt , $row['packer11_qty']);
$activeSheet->setCellValue('AT'.$cnt , $row['packer11_encoder']);


$activeSheet->setCellValue('AU'.$cnt , $row['packer12_qty']);
$activeSheet->setCellValue('AV'.$cnt , $row['packer12_whseman']);
$activeSheet->setCellValue('AW'.$cnt , $row['packing_inspected_by']);

//$activeSheet->setCellValue('AX'.$cnt , $row['packer11_qty']);
$cnt++;
}
$filename="test";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
header('Cache-Control: max-age=0');

$Excel_writer->save('php://output');

mysqli_close($con);
// Save
//$helper->write($spreadsheet, __FILE__);