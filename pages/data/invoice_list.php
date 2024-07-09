<?php
error_reporting(0);
include_once("connection.php");
/* Database connection end */
session_start();
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
$columns = array( 
// datatable column index  => database column name
	0 =>'id',
     1 =>'invoice_num',
     2=>'total',

     3=>'created_by',

     4=>'date_created',
     5=>'approved_by',
     6=>'approved_date',
);


$clinic_ids=$_SESSION['clinic_id'];
$uids=$_SESSION['uid_data'];
$account_types=trim(strtolower($_SESSION['u_account_type']));
$id=$_GET['id'];

if($account_types!=="admin"){
$sql= "SELECT count(*) as totals from tbl_billing  WHERE branch='$id' ";
}else{

$sql= "SELECT count(*) as totals from tbl_billing WHERE branch='$id' ";
}
$query=mysqli_query($conn, $sql); //or die("employee-grid-data.php: get employees");
$rows_total= mysqli_fetch_assoc($query);
$totalData= $rows_total['totals'];
$totalFiltered = $rows_total['totals'];  // when there is no search parameter then total number rows = total number filtered rows.
if($account_types!=="admin"){
$sql= "SELECT * from tbl_billing WHERE branch='$id'  ";
}else{

$sql= "SELECT * from tbl_billing WHERE branch='$id'  ";
}
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
     $sql.=" AND (invoice_num  LIKE '%".$requestData['search']['value']."%'";
     $sql.=" or control_num LIKE '%".$requestData['search']['value']."%' )";

     //$sql.=" HAVING driver1 LIKE '".$requestData['search']['value']."%' or hp1 LIKE '".$requestData['search']['value']."%' ";
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


    $nestedData[] = "
    <button type='button' id='".base64_encode($row["id"])."'   class='  btn-success btn-sm view_invoice' data-toggle='modal' title='View Record'><i class='fa fa-book' ></i> View</button>";


	$nestedData[] = htmlentities(htmlspecialchars(($row['invoice_num'])));
	$nestedData[] = htmlentities(htmlspecialchars(($row['total'])));

	$nestedData[] = htmlentities(htmlspecialchars(($row['created_by'])));


	$nestedData[] = htmlentities(htmlspecialchars(($row['date_created'])));


	$nestedData[] = htmlentities(htmlspecialchars(($row['approved_by'])));

	$nestedData[] = htmlentities(htmlspecialchars(($row['approved_date'])));

	$nestedData[] = htmlentities(htmlspecialchars(($row['status'])));

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