<?php
ob_end_clean();
ob_flush();
ob_clean();
include_once("phpexcel/xlsxwriter.class.php");
$filename = "example.xlsx";
$writer = new XLSXWriter();

header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');


$writer->writeSheetHeader('Sheet1',    
	array('Date'=>'string',
	'Control No(s)'=>'string',
	'WH#'=>'string',
	'No. of Pickers'=>'string',
	'I'=>'string',
	'Time Stamp'=>'string',
	'II'=>'string',
	'Time Stamp'=>'string',
	'III'=>'string',
	'Time Stamp'=>'string',
	'Damage Remarks'=>'string',	
	'IV'=>'string',
	'Time Stamp'=>'string',
	'CSS'=>'string',	
	'Time Start'=>'string',
	'Date Finish'=>'string',
	'Time Finish'=>'string',
	'Team Leader'=>'string',	
	'WH2 Team Leader'=>'string',
	'No. of Bundlers'=>'string',
	'V'=>'string',	
	'Time Stamp'=>'string',
	'VI'=>'string',
	'Time Stamp'=>'string',
	'VII'=>'string'	,
	'Time Stamp'=>'string',
	'Date Start'=>'string',
	'Time Start'=>'string',
	'Date Finish'=>'string',
	'Time Finish'=>'string'	,
	'VIII'=>'string',
	'Time Stamp'=>'string',
	'Date Start'=>'string',
	'Time Start'=>'string',
	'Date Finish'=>'string',
	'Time Finish'=>'string'	,
	'IX'=>'string'	,
	'Date Start'=>'string'	,
	'Time Start'=>'string'	,
	'Date Finish'=>'string'	,
	'Time'=>'string',
	'Finish'=>'string',
	'X'=>'string',
	'TRANSPORT PLANNER'=>'string',
	'Signature'=>'string',
	'XI'=>'string',
	'MANIFEST ENCODER'=>'string'	,
	'XII'=>'string'	,
	'WHSE MAN'=>'string',
	'WHSE2 TL /Ispected by'=>'string',
	'Remarks'=>'string'),array('freeze_rows'=>1,'freeze_columns'=>1));



$con=mysqli_connect("localhost","root","r2b2/23","whd");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$starts="";
$ends="";
$stat="";
$sql="";
$start="";
$end="";

$starts=urldecode($_GET['start']);
$ends=urldecode($_GET['end']);
$stat=urldecode($_GET['stat']);

$start=date('Y-m-d',strtotime($starts))." 00:00:00";
$end=date('Y-m-d',strtotime($ends))." 00:00:00";

if($starts!="0" && $ends!="0" && $starts=="" && $ends=""){
  $sql.=" AND date(`date`) between '$start' and '$end'  ";    
}
if($stat!=0 && $stat!="0"){
   $sql.=" AND status='$stat'  ";    
 }

$picker_count=0;
$packer_count=0;
$q=mysqli_query($con,"SELECT * FROM wh_outbound WHERE 1=1 ".$sql);

while($row=mysqli_fetch_assoc($q)){

if($row['picker_person1']!=""){$picker_count=$picker_count+1;}else
if($row['picker_person2']!=""){$picker_count=$picker_count+1;}else
if($row['picker_person3']!=""){$picker_count=$picker_count+1;}else
if($row['picker_person4']!=""){$picker_count=$picker_count+1;}

if($row['packer_person1']!=""){$packer_count=$packer_count+1;}else
if($row['packer_person2']!=""){$packer_count=$packer_count+1;}else
if($row['packer_person3']!=""){$packer_count=$packer_count+1;}else
if($row['packer_person4']!=""){$packer_count=$packer_count+1;}

if( $row['pickers_1_sign']!="" ||  $row['pickers_1_sign']!=''){
$pickers_1_sign=$row['pickers_1_sign'];
}




if( $row['pickers_2_sign']!="" ||  $row['pickers_2_sign']!=''){
$pickers_2_sign= $row['pickers_2_sign'];
}

if( $row['pickers_3_sign']!="" ||  $row['pickers_3_sign']!=''){
$pickers_3_sign=$row['pickers_3_sign'];
}

if( $row['pickers_4_sign']!="" ||  $row['pickers_4_sign']!=''){
$pickers_4_sign= $row['pickers_4_sign'];
}


if($row['picking_starttime']!==""){
	$picking_starttime=date('H:m',strtotime($row['picking_starttime']));
    $picking_date=date('d/m/Y',strtotime($row['picking_starttime']));
}

if($row['picking_endtime']!==""){
	$picking_endtime=date('H:m',strtotime($row['picking_endtime']));
   
}







//*********************************************8PART TWO *******************?????????????

if( $row['packers_5_sign']!="" ||  $row['packers_5_sign']!=''){
$packers_5_sign= $row['packers_5_sign'];
}

if( $row['packers_6_sign']!="" ||  $row['packers_6_sign']!=''){
$packers_6_sign= $row['packers_6_sign'];
}

if( $row['packers_7_sign']!="" ||  $row['packers_7_sign']!=''){
$packers_7_sign=$row['packers_7_sign'];
}

if($row['packer7_startdate']!="" ||  $row['packer7_startdate']!=''){
$p7d1=date('d/m/Y',strtotime($row['packer7_startdate'])); //date start
$p7d2= date('H:m',strtotime($row['packer7_startdate'])); // time start
$P7d3=date('d/m/Y',strtotime($row['packer7_enddate'])); //date end
$p7d4=date('H:m',strtotime($row['packer7_enddate'])); // time end
}


if( $row['packers_8_sign']!="" ||  $row['packers_8_sign']!=''){
$packers_8_sign= $row['packers_8_sign'];
}



if($row['packer8_startdate']!="" ||  $row['packer8_startdate']!=''){
$p8d1=date('d/m/Y',strtotime($row['packer8_startdate'])); //date start
$p8d2=date('H:m',strtotime($row['packer8_startdate'])); // time start

$p8d3=date('d/m/Y',strtotime($row['packer8_enddate'])); //date end
$p8d4= date('H:m',strtotime($row['packer8_enddate'])); // time end
}

if( $row['packers_9_sign']!="" ||  $row['packers_9_sign']!=''){
$packers_9_sign= $row['packers_9_sign'];
}


if($row['packer9_startdate']!="" ||  $row['packer9_startdate']!=''){

$p9d1=date('d/m/Y',strtotime($row['packer9_startdate'])); //date start
$p9d2=date('H:m',strtotime($row['packer9_startdate'])); // time start
$p9d3=date('d/m/Y',strtotime($row['packer9_enddate'])); //date end
$p9d4= date('H:m',strtotime($row['packer9_enddate'])); // time end
}
	$writer->writeSheetRow('Sheet1',  array(
		$row['date'], 
		$row['control_no'],  
		$row['warehouse_no'],
		$picker_count,
		$row['pickers_1'],
		$pickers_1_sign,
		$row['pickers_2'],
		$pickers_2_sign,
		$row['pickers_3'],
		$pickers_3_sign,
		$row['pickers_3_remakrs'],
	 	$row['pickers_4'],
	 	$pickers_4_sign,
	 	$row['pickers4_css'], //////FOR CSS
	 	$picking_starttime,
	 	$picking_date,
	 	$picking_endtime,
	 	$row['team_lead'],
	 	$row['picking_receive_by'] , ////////////////////////////////////////////////////////// SET TWO
	 	$packer_count,
	 	$row['packers_5'],
	 	$packers_5_sign,
	 	$row['packers_6'],
	 	$packers_6_sign,
	 	$row['packers_7'],
	 	$packers_7_sign,
	 	$p7d1,
	 	$p7d2,
	 	$p7d3,
	 	$p7d4,
	 	$row['packers_8'],
	 	$packers_8_sign,
	 	$p8d1,
	 	$p8d2,
	 	$p8d3,
	 	$p8d4,
	 	$row['packers_9'],
	 	$packers_9_sign,
	 	$p9d1,
	 	$p9d2,
	 	$p9d3,
	 	$p9d4,
	 	$row['packer10_qty'],
	 	$row['packer10_planner'],
	 	$row['packer10_planner'],
	 	$row['packer11_qty'],
	 	$row['packer11_encoder'],
	 	$row['packer12_qty'],
	 	$row['packer12_whseman'],
	 	$row['packing_inspected_by']
	 	)


	);

$picker_count=0;
$packer_count=0;
		
}



$writer->writeToStdOut();
//$writer->writeToFile('example.xlsx');
//echo $writer->writeToString();
exit(0);


?>