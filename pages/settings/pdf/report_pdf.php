<?php 
ini_set('default_charset', 'utf-8');


header('Content-Encoding: UTF-8');
header('Content-type: text/csv; charset=UTF-8');
header('Content-Type: text/html; charset=ISO-8859-1');
error_reporting(0);
session_start();
include_once('../../data/connection.php');

$do=filter_var(htmlspecialchars(urldecode($_GET['do']),ENT_QUOTES), FILTER_SANITIZE_STRING);
  require("../../fpdf/fpdf.php");
  require('../../fpdf/htmlparser.inc');
  require("../../fpdf/html_table.php");
  require("../../fpdi/fpdi.php");
  $pdf=new PDF('L','mm','LEGAL');
function cleanString($String)
{
    $String = str_replace(array('á','à','â','ã','ª','ä'), "a", $String);
    $String = str_replace(array('Á','À','Â','Ã','Ä'), "a", $String);
    $String = str_replace(array('Í','Ì','Î','Ï'), "i", $String);
    $String = str_replace(array('í','ì','î','ï'), "i", $String);
    $String = str_replace(array('é','è','ê','ë'), "e", $String);
    $String = str_replace(array('É','È','Ê','Ë'), "e", $String);
    $String = str_replace(array('ó','ò','ô','õ','ö','º'), "o", $String);
    $String = str_replace(array('Ó','Ò','Ô','Õ','Ö'), "o", $String);
    $String = str_replace(array('ú','ù','û','ü'), "u", $String);
    $String = str_replace(array('Ú','Ù','Û','Ü'), "u", $String);
    $String = str_replace(array('[','^','´','`','¨','~',']'), "", $String);
    $String = str_replace("ç", "c", $String);
    $String = str_replace("Ç", "C", $String);
    $String = str_replace("ñ", "n", $String);
    $String = str_replace("Ñ", "N", $String);
    $String = str_replace("Ý", "Y", $String);
    $String = str_replace("ý", "y", $String);
    $String = str_replace("Â±", "Ñ", $String);
       $String = str_replace("ÃƒÂ±", "Ñ", $String);
             $String = str_replace("a±", "Ñ", $String);
    
    $String = str_replace("&aacute;", "a", $String);
    $String = str_replace("&Aacute;", "a", $String);
    $String = str_replace("&eacute;", "e", $String);
    $String = str_replace("&Eacute;", "e", $String);
    $String = str_replace("&iacute;", "i", $String);
    $String = str_replace("&Iacute;", "i", $String);
    $String = str_replace("&oacute;", "o", $String);
    $String = str_replace("&Oacute;", "o", $String);
    $String = str_replace("&uacute;", "u", $String);
    $String = str_replace("&Uacute;", "u", $String);
    return $String;
}




$clinic_ids=$_SESSION['clinic_id'];
$uids=$_SESSION['uid_data'];
$account_types=trim(strtolower($_SESSION['u_account_type']));





if($account_types!=="admin"){
$sql= "SELECT mr.*,tc.name,(SELECT concat(mus.fname,' ',mus.lname) FROM medical_users as mus WHERE id = mr.doctor_attended) as doctors  from medical_record    as   mr   INNER     JOIN tbl_clinics    as   tc   ON   tc.id=mr.branch_id WHERE  is_submitted='0'  ";
}else{

$sql= "SELECT mr.*,tc.name,(SELECT concat(mus.fname,' ',mus.lname) FROM medical_users as mus WHERE id = mr.doctor_attended) as doctors from medical_record    as   mr   INNER     JOIN tbl_clinics    as   tc   ON   tc.id=mr.branch_id WHERE  is_submitted='0'";
}



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
    $d1=date('Y-m-d',strtotime(trim($date_array[0]).""));
    $d2=date('Y-m-d',strtotime(trim($date_array[1]).""));
    $sql.=" and cast(date_created as date) BETWEEN ('$d1') AND ('$d2')";
 //   $sql.=" AND  date_format(str_to_date(date_created, '%Y-%m-%d'), '%m/%d/%Y') BETWEEN ('$d1') AND ('$d2')  ";  
        } 
}
$dt = new DateTime("now", new DateTimeZone('Asia/Riyadh'));
$today=$dt->format("Y-m-d H:i:s");


$get_clinic_name="SELECT name FROM tbl_clinics WHERE id ='$clinics'";

$q_clinic=mysqli_query($conn,$get_clinic_name);
$row_clinic=mysqli_fetch_assoc($q_clinic);
//$sql.=" order by  str_to_date(mr.date_created, '%Y-%m-%d')  desc";

$sql.=" order by  mr.date_created desc";

$clinic_name=$row_clinic['name'];
$q=mysqli_query($conn,$sql);
$rowcount=mysqli_num_rows($q);
     
$date_covered="Show All Data";
if($d1!="" || $d2!="" )
{
  $date_covered=$d1." - ".$d2;
}


  $new_line=10;
  $pdf->SetXY(110,72+$new_line);

    $pdf->SetAutoPageBreak(true,7);

$pdf->addPage();
$htmlTable.='<table border="1">';
$htmlTable.='<tr>
<td width="1350" height="30" colspan="8"><center>Medical Reports</center></td>
</tr>
<tr>
<td width="275" height="30">Date Generated : </td><td  width="300"  height="30">'.$today.'</td>
<td width="275"  height="30">Clinic : </td><td  width="500"  height="30">'.$clinic_name.'</td>
</tr>
<tr>
<td width="275" height="30">Period Covered : </td><td  width="300"  height="30">'.$date_covered.'</td>
<td width="275"  height="30">Transaction for the period</td><td  width="500"  height="30">'.$rowcount.'</td>
</tr>
</table>';


$pdf->SetFont('Arial','',12);
$pdf->WriteHTML($htmlTable);
$htmlTable="";


$htmlTable="";

$pdf->SetXY(10,20+$new_line);


$htmlTable="";

//                                  TOTAL
$new_line=30+$new_line;
$pdf->SetXY(10,$new_line);

// $query=mysqli_query($conn,$sql);
$htmlTable.='<table border="1">';
$htmlTable.='<tr>
<td width="150" height="30" colspan="8">ID</td>
<td width="210" height="30" colspan="8">Driver License</td>
<td  width="210" height="30">Name</td>
<td  width="210" height="30">Type</td>
<td  width="210" height="30">Clinic</td>
<td  width="210" height="30">Doctors Attended</td>
<td  width="160" height="30">Date</td>
</tr>';
$htmlTable.="</table>";
$pdf->SetFont('Arial','',8);

$pdf->WriteHTML($htmlTable);
//set width for each column (6 columns)
$pdf->SetWidths(Array(37.5,52.5,52.5,52.5,52.5,52.5,40));
$pdf->SetLineHeight(5);
//set alignment
$pdf->SetAligns(Array('','R','C','','',''));


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



 $pdf->Row(Array(
 $row["uid"],
 cleanString($row['driver_license']),
  cleanString($row['first_name']." ".$row['last_name']),
  cleanString($med_type_string),
  cleanString($row['name']),
  cleanString($row['doctors']),
 $row['date_created']
 ));
$new_line=$new_line+10;
}

$pdf->WriteHTML($htmlTableUser);
$pdf->Output();


?>