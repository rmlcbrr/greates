<?php
ini_set('memory_limit','2048M');
//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('max_execution_time', 0); // for infinite time of execution 
//include_once("../connection/class.client.php");
error_reporting(0);
include("../../phpexcel/xlsxwriter.class.php");
include("../../data/connection.php");
$filename = "uploaded".date('Y-m-d').".xlsx";

ob_end_clean();

header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');
ob_end_clean();

$writer = new XLSXWriter();
 $sql = "SELECT  mr.*,tc.name  from medical_record    as   mr   INNER     JOIN tbl_clinics    as   tc   ON   tc.id=mr.branch_id WHERE  is_submitted='0' ";

if(!empty(filter_var(htmlspecialchars(urldecode($_GET['data']),ENT_QUOTES), FILTER_SANITIZE_STRING))) {
        $data=filter_var(htmlspecialchars(urldecode($_GET['data']),ENT_QUOTES), FILTER_SANITIZE_STRING);
       
    $temp_array=explode(",",$data);
       
     if(!empty($temp_array[0])){
    $clinics=$temp_array[0];
    $sql.=" AND mr.branch_id='$clinics'  ";  
     }

            //date_Created
    if(!empty($temp_array[1])){
        $date_array=array();
    $date_array=explode("-",$temp_array[1]);
    $d1=trim($date_array[0]." 00:00:00");
    $d2=trim($date_array[1])." 23:59:59";
    $sql.=" AND  date_format(str_to_date(date_created, '%Y-%m-%d'), '%m/%d/%Y') BETWEEN ('$d1') AND ('$d2')  ";  
        } 
}


$styles1 = array( 'font'=>'Arial','font-size'=>10,'font-style'=>'bold', 'fill'=>'#eee', 'halign'=>'center', 'border-style'=>'thick','border'=>'left,right,top,bottom','wrap_text'=>true);
  $writer->writeSheetRow('Sheet1', array('ID','Name','Purpose','Clinic','Date')
  ,$styles1);
$q=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($q)){
   $med_type=$row['medical_type'];
                    if($med_type=="1"){
                      $med_type_string="New Non-Pro Driver´s License";  
                    }else  if($med_type=="2"){
                      $med_type_string="New Pro Driver´s License";  
                    }else  if($med_type=="3"){
                      $med_type_string="Renewal of Non-Pro Driver´s License"; 
                    }else  if($med_type=="4"){
                      $med_type_string="Renewal of Pro Driver´s License"; 
                    }else  if($med_type=="5"){
                      $med_type_string="Renewal of Conductor´s License";  
                    }else  if($med_type=="6"){
                      $med_type_string="Conversion from Non-Pro to Pro DL"; 
                    }else  if($med_type=="7"){
                      $med_type_string="New Non-Pro Driver's License (with Foreign License)"; 
                    }else  if($med_type=="8"){
                      $med_type_string="New Pro Driver's License (with Foreign License)"; 
                    }else  if($med_type=="9"){
                      $med_type_string="New Conductor´s License"; 
                    }else  if($med_type=="10"){
                      $med_type_string="New Student Permit";  
                    }else  if($med_type=="11"){
                      $med_type_string="Conversion from Pro to Non-Pro DL"; 
                    }else  if($med_type=="12"){
                      $med_type_string="Add Restriction for Non-Pro Driver´s License";  
                    }else if($med_type=="13"){
                         $med_type_String="Add Restriction for Pro Driver´s License";
               }

$temp_array_value=array(
 $row["uid"],
 $row['first_name']." ".$row['last_name'],
 $med_type_string,
 $row['name'],
 $row['date_created']
    );

//print_r($temp_array_value);
 $writer->writeSheetRow('Sheet1', $temp_array_value );



}



$writer->writeToStdOut();
//$writer->writeToFile('example.xlsx');
//echo $writer->writeToString();
exit(0);
?>