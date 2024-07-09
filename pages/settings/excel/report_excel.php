<?php
ini_set('memory_limit','2048M');
//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('max_execution_time', 0); // for infinite time of execution 
//include_once("../connection/class.client.php");
error_reporting(0);
include("../../phpexcel/xlsxwriter.class.php");
include("../../data/connection.php");
$filename = "uploaded".date('Y-m-d').".xlsx";
session_start();
ob_end_clean();

header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');
ob_end_clean();

$writer = new XLSXWriter();

$clinic_ids=$_SESSION['clinic_id'];
$uids=$_SESSION['uid_data'];
$account_types=trim(strtolower($_SESSION['u_account_type']));



if($account_types!=="admin"){
$sql= "SELECT mr.*,tc.name,(SELECT concat(mus.fname,' ',mus.lname) FROM medical_users as mus WHERE id = mr.doctor_attended) as doctors  from medical_record    as   mr   INNER     JOIN tbl_clinics    as   tc   ON   tc.id=mr.branch_id WHERE  is_submitted='0' ";
}else{

$sql= "SELECT mr.*,tc.name,(SELECT concat(mus.fname,' ',mus.lname) FROM medical_users as mus WHERE id = mr.doctor_attended) as doctors from medical_record    as   mr   INNER     JOIN tbl_clinics    as   tc   ON   tc.id=mr.clinics WHERE  is_submitted='0'";
}
if(!empty(filter_var(htmlspecialchars(urldecode($_GET['data']),ENT_QUOTES), FILTER_SANITIZE_STRING))) {
        $data=filter_var(htmlspecialchars(urldecode($_GET['data']),ENT_QUOTES), FILTER_SANITIZE_STRING);
       
    $temp_array=explode(",",$data);
       
     if(!empty($temp_array[0])){
        if($temp_array[0]!=="All"){
    $clinics=$temp_array[0];
    $sql.=" AND mr.clinics='$clinics'  ";  
             }
   }

                    //date_Created
    if(!empty($temp_array[1])){
        $date_array=array();
    $date_array=explode("-",$temp_array[1]);
    $d1=date('Y-m-d',strtotime(trim($date_array[0]).""));
    $d2=date('Y-m-d',strtotime(trim($date_array[1]).""));
    $sql.=" and cast(date_created as date) BETWEEN ('$d1') AND ('$d2')";
 //   $sql.=" AND  date_format(str_to_date(date_created, '%Y-%m-%d'), '%m/%d/%Y') BETWEEN ('$d1') AND ('$d2')  ";  
        } 
}

  
$sql.="  order by mr.date_created desc";

$q=mysqli_query($conn,$sql);

$rowcount=mysqli_num_rows($q);



$date_covered="Show All Data";
if($d1!="" || $d2!="" )
{
  $date_covered=$d1." - ".$d2;
}

$get_clinic_name="SELECT name FROM tbl_clinics WHERE id ='$clinics'";
$q_clinic=mysqli_query($conn,$get_clinic_name);
$row_clinic=mysqli_fetch_assoc($q_clinic);


$clinic_name=$row_clinic['name'];

    $writer->writeSheetRow('Sheet1', array("Medical Reports ","") );
    $writer->writeSheetRow('Sheet1', array("Date Generated :",date('Y-m-d H:i:s')) );
    $writer->writeSheetRow('Sheet1', array("Perion Covered ",$date_covered) );

    $writer->writeSheetRow('Sheet1', array("Clinic :",$clinic_name) );
    $writer->writeSheetRow('Sheet1', array("Transaction for the period",$rowcount) );
    $writer->writeSheetRow('Sheet1', array("","") );

$styles1 = array( 'font'=>'Arial','font-size'=>10,'font-style'=>'bold', 'fill'=>'#eee', 'halign'=>'center', 'border-style'=>'thick','border'=>'left,right,top,bottom','wrap_text'=>true);
  $writer->writeSheetRow('Sheet1', array('ID','Drivers License','Name','Purpose','Clinic','Doctors Attended','Date')
  ,$styles1);


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
$billing_stat=$row['paid_status'];
          if($billing_stat=="" || empty($billing_stat)){
                   $show_billing='UNBILLED';
      }else{
                $show_billing='BILLED';
      }


$temp_array_value=array(
 $row["uid"],
 $row['driver_license'],
 $row['first_name']." ".$row['last_name'],
 $med_type_string,
 $row['name'],
 $row['doctors'],
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