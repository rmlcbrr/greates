<?php
ini_set('memory_limit','2048M');
//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('max_execution_time', 0); // for infinite time of execution 
//include_once("../connection/class.client.php");
error_reporting(0);
include("../../phpexcel/xlsxwriter.class.php");
include("../../data/connection.php");
$filename = "clinics_report".date('Y-m-d').".xlsx";
session_start();
ob_end_clean();

header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');
ob_end_clean();

$writer = new XLSXWriter();

$get_clinic_name="SELECT * FROM tbl_clinics WHERE 1=1";
$q_clinic=mysqli_query($conn,$get_clinic_name);
$row_clinic=mysqli_fetch_assoc($q_clinic);


$clinic_name=$row_clinic['name'];



$styles1 = array( 'font'=>'Arial','font-size'=>10,'font-style'=>'bold', 'fill'=>'#eee', 'halign'=>'center', 'border-style'=>'thick','border'=>'left,right,top,bottom','wrap_text'=>true);
  $writer->writeSheetRow('Sheet1', array('ID','Name ','LTO Accreditation','Expiration Date in LTMS')
  ,$styles1);


while($row=mysqli_fetch_assoc($q_clinic)){

                
$temp_array_value=array(
 $row["id"],
 $row['name'],
 $row['lto_accreditation_no'],
 $row['date_of_expiration_ltms']  
    );

//print_r($temp_array_value);
 $writer->writeSheetRow('Sheet1', $temp_array_value );



}



$writer->writeToStdOut();
//$writer->writeToFile('example.xlsx');
//echo $writer->writeToString();
exit(0);
?>