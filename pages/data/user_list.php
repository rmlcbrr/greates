<?php
error_reporting(0);
include_once("connection.php");
/* Database connection end */
// storing  request (ie, get/post) global array to a variable  
$requestData = $_REQUEST;
$columns = array(
	// datatable column index  => database column name
	0 => 'id',
	1 => 'fname',
	2 => 'username',
	3 => 'last_login',
	4 => 'account_type'
);


$sql = "SELECT * from medical_users WHERE account_type='admin' ";
$query = mysqli_query($conn, $sql); //or die("employee-grid-data.php: get employees");
$rows_total = mysqli_fetch_assoc($query);
$totalData = $rows_total['totals'];
$totalFiltered = $rows_total['totals'];  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * from medical_users WHERE account_type='admin'";

if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql .= " AND (fname LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " or lname LIKE '%" . $requestData['search']['value'] . "%' ";
	$sql .= " or username LIKE '%" . $requestData['search']['value'] . "%' )";

	//$sql.=" HAVING driver1 LIKE '".$requestData['search']['value']."%' or hp1 LIKE '".$requestData['search']['value']."%' ";
}



$query = mysqli_query($conn, $sql);
//or die("employee-grid-data.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.




$sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";


/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query = mysqli_query($conn, $sql); //or die("employee-grid-data.php: get employees");

$data = array();
while ($row = mysqli_fetch_array($query)) {  // preparing an array

	//if(($unserialized['profile_position'])=="Driver" && ($unserialized['profile_position'])!=""){
	$nestedData = array();


	$nestedData[] = htmlentities(htmlspecialchars($row["id"]));
	$nestedData[] = htmlentities(htmlspecialchars(($row['fname'] . "	" . $row['lname'])));
	$nestedData[] = htmlentities(htmlspecialchars(($row['username'])));
	$nestedData[] = htmlentities(htmlspecialchars(($row['last_login'])));
	$nestedData[] = htmlentities(htmlspecialchars(($row['account_type'])));

	$myArr = array($row["id"], $row['fname'], $row['lname'], base64_encode($row['clinic']), $row["username"], base64_decode($row["password"]));
	$myJSON = json_encode($myArr);
	$nestedData[] = "<button type='button' id='" . base64_encode($row["id"]) . "'  class='edit_btn  btn-info btn-sm'  data-toggle='modal'		data-name='" . $myJSON . "' title='Edit Record'><i class='fa fa-pencil' ></i></button> 
	<button type='button' id='" . base64_encode($row["tid"]) . "'   class=' btn-success mr-1 btn-sm release-info' data-toggle='modal' title='View Record'><i class='fa fa-eye'></i></button><button type='button' id='" . base64_encode($row["id"]) . "'   class=' btn-danger btn-sm remove_btn' data-toggle='modal' title='Delete Record'><i class='fa fa-trash'></i></button>";
	$data[] = $nestedData;
	//	}
}



$json_data = array(
	"draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
	"recordsTotal"    => intval($totalData),  // total number of records
	"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
	"data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
