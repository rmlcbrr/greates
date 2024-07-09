<?php
error_reporting(0);
include_once("connection.php");
/* Database connection end */
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
$columns = array( 
// datatable column index  => database column name
	0 =>'first_name',
	1 =>'gender',
	2=>'bdate'
);


$sql = "SELECT marital_status,nationality,address,email,mobile, first_name,last_name,middle_name,driver_license,gender,bdate from medical_record WHERE first_name<>''  ";
$query=mysqli_query($conn, $sql); //or die("employee-grid-data.php: get employees");
$rows_total= mysqli_fetch_assoc($query);
$totalData= $rows_total['totals'];
$totalFiltered = $rows_total['totals'];  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT  marital_status,nationality,address,email,mobile, first_name,last_name,middle_name,driver_license,gender,bdate from medical_record WHERE first_name<>'' ";

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND (first_name LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" or driver_license LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" or middle_name LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" or username LIKE '%".$requestData['search']['value']."%' )";

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


	$nestedData[] = htmlentities(htmlspecialchars(($row['first_name']." ".$row['middle_name']."	".$row['last_name'])));
	$nestedData[] = htmlentities(htmlspecialchars(($row['gender'])));
	$nestedData[] = htmlentities(htmlspecialchars(($row['bdate'])));

	$myArr = array("first_name"=>$row['first_name'],"middle_name"=>$row['middle_name'],"last_name"=>$row['last_name'],"gender"=>$row['gender'],"address"=>$row['address'],"marital_status"=>$row['marital_status'],"nationality"=>$row['nationality'],"mobile"=>$row['mobile'],"email"=>$row['email'],"bdate"=>$row['bdate']);
	$myJSON = json_encode($myArr);
	$nestedData[] = " 
	<button data-json='".$myJSON."' type='button' id='".base64_encode($row["id"])."'   class='  btn-success btn-sm release-info' data-toggle='modal' title='View Record'><i class='fa fa-book' ></i> Add Data</button><button ";
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
