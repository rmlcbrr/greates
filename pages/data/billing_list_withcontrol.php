<?php
error_reporting(0);
include_once("connection.php");
/* Database connection end */
session_start();
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
$columns = array( 
// datatable column index  => database column name
	0 =>'control_num',
     1 =>'branch',
     2=>'total',
     3=>'date_created',
     4=>'uploaded',
     5=>'status'
);


$clinic_ids=$_SESSION['clinic_id'];
$uids=$_SESSION['uid_data'];
$account_types=trim(strtolower($_SESSION['u_account_type']));

$sql= "SELECT count(mr.*) as totals from tbl_billing    as   tb   INNER     JOIN tbl_clinics    as   tc   ON   tc.id=tb.branch WHERE 1=1   ";

$query=mysqli_query($conn, $sql); //or die("employee-grid-data.php: get employees");
$rows_total= mysqli_fetch_assoc($query);
$totalData= $rows_total['totals'];
$totalFiltered = $rows_total['totals'];  // when there is no search parameter then total number rows = total number filtered rows.



$sql= "SELECT tb.id, tb.branch, tb.total, tb.uploaded, tb.date_create, tb.created_by, tb.status, tb.control_num,tc.name 
 from tbl_billing    as   tb   INNER     JOIN tbl_clinics    as   tc   ON   tc.id=tb.branch WHERE 1=1   ";

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
     $sql.=" AND (first_name LIKE '%".$requestData['search']['value']."%'";
     $sql.=" or last_name LIKE '%".$requestData['search']['value']."%'";
     $sql.=" or middle_name LIKE '%".$requestData['search']['value']."%'";
     $sql.=" or driver_license LIKE '%".$requestData['search']['value']."%' )";

     //$sql.=" HAVING driver1 LIKE '".$requestData['search']['value']."%' or hp1 LIKE '".$requestData['search']['value']."%' ";
}



if(!empty($requestData['columns'][1]['search']['value'])) {
    $temp_array=explode(",",$requestData['columns'][1]['search']['value']);
       
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



	$nestedData[] = htmlentities(htmlspecialchars($row["control_num"]));
	$nestedData[] = htmlentities(htmlspecialchars(($row['name'])));

	$nestedData[] = htmlentities(htmlspecialchars(($row['date_create'])));
	$nestedData[] = htmlentities(htmlspecialchars(($row['uploaded'])));
	$nestedData[] = htmlentities(htmlspecialchars(($row['status'])));
	$nestedData[] = "
	<button type='button' id='".base64_encode($row["id"])."'   class='  btn-success btn-sm view_btn' data-toggle='modal' title='View Record'><i class='fa fa-book' ></i> View</button>
    <button type='button' id='".base64_encode($row["id"])."'   class='  btn-info btn-sm done_billing' data-toggle='modal' title='Submit Record'><i class='fa fa-check' ></i> Submit Done</button>";
	$data[] = $nestedData;
			//	}
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
