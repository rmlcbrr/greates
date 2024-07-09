<?php 




	
//	$db->exec("INSERT INTO item_reg(mat_desc, class, brand, category, size, type, po, pr, events, owner, u_price, sap_mat, plant, promo_dur, other_desc) VALUES ('mat_desc', 'class', 'brand', 'category', 'size', 'type', 'po', 'pr', 'events', 'owner', 'u_price', 'sap_mat', 'plant', 'promo_dur', 'other_desc')");

	require_once('../3pl/pages/reports/phpexcel/Classes/PHPExcel.php');






         $dbhost = 'localhost:3306';
         $dbuser = 'root';
         $dbpass = '';
         $dbname = 'inventory';
         $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   
         if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
         }
         echo 'Connected successfully<br>';




	$filename="sample.xlsx";
	$excel = PHPExcel_IOFactory::load($filename);
	$excel->setActiveSheetIndex(0);
echo "<table border=1>";
$i=2;
while(($excel->getActiveSheet()->getCell('A'.$i)->getValue())!='') {
//	$val1 = strtoupper($excel->getActiveSheet()->getCell('A'.$i)->getValue());
//	$val2 = strtoupper($excel->getActiveSheet()->getCell('B'.$i)->getValue());
	$val3 = strtoupper($excel->getActiveSheet()->getCell('C'.$i)->getValue());
	$val4 = strtoupper($excel->getActiveSheet()->getCell('D'.$i)->getValue());
	$val5 = strtoupper($excel->getActiveSheet()->getCell('E'.$i)->getValue());
	$val6 = strtoupper($excel->getActiveSheet()->getCell('F'.$i)->getValue());
	$val7 = strtoupper($excel->getActiveSheet()->getCell('G'.$i)->getValue());
	$val8 = strtoupper($excel->getActiveSheet()->getCell('H'.$i)->getValue());
	$val9 = strtoupper($excel->getActiveSheet()->getCell('I'.$i)->getValue());
	$val10 = strtoupper($excel->getActiveSheet()->getCell('J'.$i)->getValue());
	$val11 = strtoupper($excel->getActiveSheet()->getCell('K'.$i)->getValue());
	$val12 = strtoupper($excel->getActiveSheet()->getCell('L'.$i)->getValue());
	$val13 = strtoupper($excel->getActiveSheet()->getCell('M'.$i)->getValue());
	$val14 = strtoupper($excel->getActiveSheet()->getCell('N'.$i)->getValue());
	$val15 = strtoupper($excel->getActiveSheet()->getCell('O'.$i)->getValue());
	$val16 = strtoupper($excel->getActiveSheet()->getCell('P'.$i)->getValue());
	$val17 = strtoupper($excel->getActiveSheet()->getCell('Q'.$i)->getValue());
	$val18 = strtoupper($excel->getActiveSheet()->getCell('R'.$i)->getValue());
	$val19 = strtoupper($excel->getActiveSheet()->getCell('S'.$i)->getValue());
	$val20 = strtoupper($excel->getActiveSheet()->getCell('T'.$i)->getValue());
	$val21 = strtoupper($excel->getActiveSheet()->getCell('U'.$i)->getValue());
	$val22 = strtoupper($excel->getActiveSheet()->getCell('Z'.$i)->getValue());
	$val23 = strtoupper($excel->getActiveSheet()->getCell('AA'.$i)->getValue());
	$i=$i+1;









//$for_itemname,$brand,$category,$size,$po,$pr,$sap_mat,$plant,$other_desc


	  $sql="INSERT INTO tbl_item(item_id,	description	,status,	image,	item_name	,item_type	,item_type_id	,`serial`	,location_name	,location_id	,machine,	quantity	,supplier	,part,	client,	critical	,option_number	,po_number,	`date`	,created_by,	specific_location_id	,specific_location_name)	VALUES('$val3','$val4','$val5','$val6','$val7','$val8','$val9','$val10','$val11','$val12','$val13','$val14','$val5','$val6','$val7','$val8','$val19','$val20','$val21','1','$val22','$val23')";
         $sql = 'SELECT name FROM tutorials_inf';
         $result = mysqli_query($conn, $sql);
}


echo "</table>";
	

         mysqli_close($conn);

?>