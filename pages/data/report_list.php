<?php
error_reporting(0);
include_once("connection.php");
session_start();
/* Database connection end */
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
$columns = array( 
// datatable column index  => database column name
     0 =>'uid',
     1 =>'first_name',
     2=>'medical_type',
     3=>'driver_license',
     4=>'name',
     5=>'date_created'
);



          $clinic_ids=$_SESSION['clinic_id'];
          $uids=$_SESSION['uid_data'];
$account_types=trim(strtolower($_SESSION['u_account_type']));

if($account_types!=="admin"){

$sql = "SELECT count(mr.*) as totals from medical_record    as   mr   INNER     JOIN tbl_clinics    as   tc   ON   tc.id=mr.branch_id WHERE 1=1   and is_submitted='1' and clinics='$clinic_ids' ";
}else{

$sql = "SELECT count(mr.*) as totals from medical_record    as   mr   INNER     JOIN tbl_clinics    as   tc   ON   tc.id=mr.branch_id WHERE 1=1   and is_submitted='1'";
}
$query=mysqli_query($conn, $sql); //or die("employee-grid-data.php: get employees");
$rows_total= mysqli_fetch_assoc($query);
$totalData= $rows_total['totals'];
$totalFiltered = $rows_total['totals'];  // when there is no search parameter then total number rows = total number filtered rows.
if($account_types!=="admin"){
$sql= "SELECT mr.*,tc.name from medical_record    as   mr   INNER     JOIN tbl_clinics    as   tc   ON   tc.id=mr.branch_id WHERE 1=1   and is_submitted='1' and clinics='$clinic_ids' ";
}else{

$sql= "SELECT mr.*,tc.name from medical_record    as   mr   INNER     JOIN tbl_clinics    as   tc   ON   tc.id=mr.branch_id WHERE 1=1   and is_submitted='1'";
}

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
     $sql.=" AND (first_name LIKE '%".$requestData['search']['value']."%'";
     $sql.=" or last_name LIKE '%".$requestData['search']['value']."%'";
     $sql.=" or middle_name LIKE '%".$requestData['search']['value']."%'";
     $sql.=" or driver_license LIKE '%".$requestData['search']['value']."%' )";

     //$sql.=" HAVING driver1 LIKE '".$requestData['search']['value']."%' or hp1 LIKE '".$requestData['search']['value']."%' ";
}
$query=mysqli_query($conn, $sql); 
//or die("employee-grid-data.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.




$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */  
$query=mysqli_query($conn, $sql); //or die("employee-grid-data.php: get employees");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array

//if(($unserialized['profile_position'])=="Driver" && ($unserialized['profile_position'])!=""){
     $nestedData=array(); 

                 
                    $med_type=$row['medical_type'];
                    if($med_type=="1"){
                         $med_type_string="Convertion from Pro to Non-Pro DL";  
                    }else  if($med_type=="2"){
                         $med_type_string="New Non-Pro Driver's License";  
                    }else  if($med_type=="3"){
                         $med_type_string="New Pro Driver's License"; 
                    }else  if($med_type=="4"){
                         $med_type_string="Renewal of Non-Pro Driver's License";     
                    }else  if($med_type=="5"){
                         $med_type_string="Renewal of Conductor's  License";    
                    }else  if($med_type=="6"){
                         $med_type_string="Conversion from Non-Pro to Pro DL";  
                    }else  if($med_type=="7"){
                         $med_type_string="New Non-Pro Driver's License (with Foreign License)";    
                    }else  if($med_type=="8"){
                         $med_type_string="New Pro Driver's License (with Foreign License)";   
                    }else  if($med_type=="9"){
                         $med_type_string="New Conductor's  License"; 
                    }else  if($med_type=="10"){
                         $med_type_string="New Student's  Permit";    
                    }else  if($med_type=="11"){
                         $med_type_string="Additional  Restriction Code of Non-Pro Driver's License";    
                    }else  if($med_type=="12"){
                         $med_type_string="Additional  Restriction Code of Pro Driver's License";   
                    }
     $nestedData[] = htmlentities(htmlspecialchars($row["uid"]));
     $nestedData[] = htmlentities(htmlspecialchars(($row['first_name']."   ".$row['last_name'])));
     $nestedData[] = htmlentities(htmlspecialchars(($med_type_string)));
     $nestedData[] = htmlentities(htmlspecialchars(($row['driver_license'])));
     $nestedData[] = htmlentities(htmlspecialchars(($row['name'])));
     $nestedData[] = htmlentities(htmlspecialchars(($row['date_created'])));
   //  $nestedData[] = "<button type='button' id='".base64_encode($row["uid"])."'  class='edit_btn  btn-info btn-sm'  title='Edit Record'><i class='fa fa-pencil' ></i> Edit</button> 
     $nestedData[] = "<button type='button' id='".base64_encode($row["uid"])."'   class='  btn-success btn-sm view_btn' data-toggle='modal' title='View Record'><i class='fa fa-book' ></i> View</button>";
     $data[] = $nestedData;
               //   }
}



$json_data = array(
               "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
               "recordsTotal"    => intval( $totalData ),  // total number of records
               "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
               "data"            => $data   // total data array
               );

echo json_encode($json_data);  // send data as json format

?>
