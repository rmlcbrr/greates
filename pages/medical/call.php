<?php  
error_reporting(0);
ini_set('memory_limit', '2048M'); // 4x default 
ini_set('max_execution_time', 200); //300 seconds = 5 minutes
date_default_timezone_set("Asia/Manila"); 
header('Access-Control-Allow-Origin: '.$_SERVER['SERVER_ADDR']);
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type');
//echo 'User IP Address - '.$_SERVER['SERVER_ADDR'];  
$json=trim($_POST['json']);

$curl = curl_init();
curl_setopt_array($curl, array(
//TEST  CURLOPT_URL => 'https://dermalog.ph:6167/ords/dl_interfaces/interface_CLINICS/v1/med_exam_results',
  CURLOPT_URL => 'https://dermalog.ph:7167/ords/dl_interfaces/interface_CLINICS/v1/med_exam_results',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER=> array('Content-Type: application/json'),
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 20,
  CURLOPT_TIMEOUT => 50,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$json,
));

$response = curl_exec($curl);


function isJSON($string){
   return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
}

if(isJSON($response)){
   
$json_data = json_decode($response);
$internal_reference_no=$json_data->internal_reference_no;
 echo $internal_reference_no;
}else{
 echo "failed";
}



/*
$myfile = fopen("newfile.txt", "w") ;
fwrite($myfile, $json);
fclose($myfile);

*/

curl_close($curl);
