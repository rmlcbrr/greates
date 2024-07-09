<?php
error_reporting(0);
include_once("connection.php");
/* Database connection end */
session_start();
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
$columns = array( 
// datatable column index  => database column name
     0 =>'uid',
     1 =>'uid',
     2 =>'internal_reference_no',
     3 =>'uid',
     4 =>'last_name',
     5=>'medical_type',
     6=>'driver_license',
     7=>'clinics',
     8=>'doctors',
     9=>'(date_created)'
);


$clinic_ids=$_SESSION['clinic_id'];
$uids=$_SESSION['uid_data'];
$account_types=trim(strtolower($_SESSION['u_account_type']));


if($account_types!=="admin"){
$sql= "SELECT count(mr.uid) as totals from medical_record    as   mr   INNER     JOIN tbl_clinics    as   tc   ON   tc.id=mr.branch_id WHERE  is_submitted='0' and clinics='$clinic_ids' ";
}else{

$sql= "SELECT count(mr.uid) as totals from medical_record    as   mr   INNER     JOIN tbl_clinics    as   tc   ON   tc.id=mr.branch_id WHERE  is_submitted='0'";
}
$query=mysqli_query($conn, $sql); //or die("employee-grid-data.php: get employees");
$rows_total= mysqli_fetch_assoc($query);
$totalData= $rows_total['totals'];
$totalFiltered = $rows_total['totals'];  // when there is no search parameter then total number rows = total number filtered rows.
if($account_types!=="admin"){
$sql= "SELECT mr.uid,mr.internal_reference_no,mr.paid_status,mr.last_name,mr.first_name,
mr.date_created,mr.driver_license,mr.medical_type,tc.name,
(SELECT concat(mus.fname,' ',mus.lname) FROM medical_users as mus WHERE id = mr.doctor_attended) as doctors  from medical_record    as   mr   INNER     JOIN tbl_clinics    as   tc   ON   tc.id=mr.branch_id WHERE  is_submitted='0' and clinics='$clinic_ids' ";
}else{

$sql= "SELECT mr.uid,mr.internal_reference_no,mr.paid_status,mr.last_name,mr.first_name,
mr.date_created,mr.driver_license,mr.medical_type,tc.name,(SELECT concat(mus.fname,' ',mus.lname) FROM medical_users as mus WHERE id = mr.doctor_attended) as doctors from medical_record    as   mr   INNER     JOIN tbl_clinics    as   tc   ON   tc.id=mr.clinics WHERE  is_submitted='0'";
}
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
     $sql.=" AND (first_name LIKE '%".$requestData['search']['value']."%'";
     $sql.=" or last_name LIKE '%".$requestData['search']['value']."%'";
     $sql.=" or middle_name LIKE '%".$requestData['search']['value']."%'";
     $sql.=" or driver_license LIKE '%".$requestData['search']['value']."%' ";
     
     $sql.=" or internal_reference_no LIKE '%".$requestData['search']['value']."%' ";
     $sql.=" or uid LIKE '%".$requestData['search']['value']."%' )";
     //$sql.=" HAVING driver1 LIKE '".$requestData['search']['value']."%' or hp1 LIKE '".$requestData['search']['value']."%' ";
}



if(!empty($requestData['columns'][1]['search']['value'])) {
    $temp_array=explode(",",$requestData['columns'][1]['search']['value']);
       
     if(!empty($temp_array[0])){

    $clinics=$temp_array[0];
     if($clinics!=="All"){
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

//echo $sql;
$query=mysqli_query($conn, $sql); 
//or die("employee-grid-data.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

//echo $sql;


$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */    
$query=mysqli_query($conn, $sql); //or die("employee-grid-data.php: get employees");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array

//if(($unserialized['profile_position'])=="Driver" && ($unserialized['profile_position'])!=""){
    $nestedData=array(); 


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
                     //    <button type='button' id='".($row["uid"])."'  class='extend_btn  btn-warning btn-sm'  title='Extend Record'><i class='fa fa-plus' ></i> Extend</button> 
  
   // $nestedData[] = htmlentities(htmlspecialchars($row["uid"]));

  $nestedData[] = htmlentities(htmlspecialchars($row["internal_reference_no"]));

    //       if($billing_stat=="" || empty($billing_stat)){
    //                $show_billing='<h6 class="label label-warning">UNBILLED</h6>';
    //   }else{
    //             $show_billing='<h6 class="label label-success">BILLED</h6>';
    //   }
    // $nestedData[] =$show_billing;

    $nestedData[] = htmlentities(htmlspecialchars(($row['first_name']." ".$row['last_name'])));
    $nestedData[] = htmlentities(htmlspecialchars(($med_type_string)));
    $nestedData[] = htmlentities(htmlspecialchars(($row['driver_license'])));
    $nestedData[] = htmlentities(htmlspecialchars(($row['name'])));

    $nestedData[] = htmlentities(htmlspecialchars(($row['doctors'])));

          $today=$row['date_created'];
          $today=date('F j, Y H:i:s',strtotime($today));
            $current_date= date($today,strtotime("+60 days"));
            $current_date=strtotime($current_date);
            $from_date=date('F j, Y',strtotime("+60 days",strtotime($today)));

    $nestedData[] = htmlentities(htmlspecialchars(($today)));

    $nestedData[] = htmlentities(htmlspecialchars(($from_date)));
    $nestedData[] = "<div class='d-flex'><button type='button' id='".base64_encode($row["uid"])."'  class='edit_btn  btn-info btn-sm'  title='Edit Record'><i class='fa fa-pencil' ></i></button>&nbsp; 
    <button type='button' id='".base64_encode($row["uid"])."'   class='  btn-success btn-sm view_btn' data-toggle='modal' title='View Record'><i class='fa fa-eye' ></i> </button></div>";
    $data[] = $nestedData;
            //  }
}



$json_data = array(
            "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal"    => intval( $totalData ),  // total number of records
            "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );

echo json_encode($json_data);  // send data as json format

?>
