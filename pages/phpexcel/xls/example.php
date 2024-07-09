<?php
error_reporting(0);
include_once("phpexcel/xlsxwriter.class.php");

$filename = "example.xlsx";
$writer = new XLSXWriter();
$writer->writeSheetHeader('Sheet1',    array('Date'=>'string',
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
	' Finish'=>'string',
	'X'=>'string',
	'TRANSPORT PLANNER'=>'string',
	'Signature'=>'string',
	'XI'=>'string',
	'MANIFEST ENCODER'=>'string'	,
	'XII'=>'string'	,
	'WHSE MAN'=>'string',
	'WHSE2 TL /Ispected by'=>'string'	
	,'Remarks'=>'string'

),['freeze_rows'=>2, 'freeze_columns'=>2] );
$writer->setAuthor('Some Author'); 



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
echo $sql;
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
	 	$row['pickers_3_remakrs'], //////FOR CSS
	 	date('H:m',strtotime($row['picking_starttime'])),
	 	date('d/m/Y',strtotime($row['picking_starttime'])),
	 	date('H:m',strtotime($row['picking_endtime'])),
	 	$row['team_lead']
	 )


	);


		
}


header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');


$writer->writeToStdOut();
//$writer->writeToFile('example.xlsx');
//echo $writer->writeToString();
//exit(0);


?>