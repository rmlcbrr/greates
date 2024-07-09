<?php 
try {
	
ini_set('max_execution_time', 450); //300 seconds = 5 minutes
//error_reporting(0);
// include_once("../data/connection.php");
$remove[] = "'";
$remove[] = '"';
$remove[] = "-"; // just as another example
 	include("class.admin.php");
$auth_item = new admin();
$db_extension="lto";	
	require_once('../3pl/pages/reports/phpexcel/Classes/PHPExcel.php');
//	$db = new PDO('sqlite:batch_wb_update.sqlite');
	//$filename=$_FILES["file"]["tmp_name"];
	$fileName="area.xlsx";
	$excel = PHPExcel_IOFactory::load($fileName);
	$excel->setActiveSheetIndex(0);
	//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
//  $db->exec("CREATE TABLE wb(id INTEGER PRIMARY KEY, waybill TEXT )"); 
echo "<table border=1>";
echo "start";
$i=1;
$remove[] = "'";
$remove[] = '"';
$success_up=0;
while(($excel->getActiveSheet()->getCell('A'.$i)->getValue())!='') {

	$a = strtoupper(trim($excel->getActiveSheet()->getCell('A'.$i)->getValue()));
	$b =strtoupper(str_replace($remove, '',(trim($excel->getActiveSheet()->getCell('B'.$i)->getValue()))));


			$ups="INSERT INTO  nationalities(name,return_value) VALUES ('$a','$b') ";
			$stmt_wb2 =$auth_item->runQuery($ups);
			$stmt_wb2->execute();

$i=$i+1;
}

echo "Total Success : ".$i;

} catch (Exception $e) {
    var_dump($e);
    exit;
}



?>