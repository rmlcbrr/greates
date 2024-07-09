<?php  
//error_reporting(0);
ini_set('memory_limit', '2048M'); // 4x default 
ini_set('max_execution_time', 200); //300 seconds = 5 minutes
date_default_timezone_set("Asia/Manila"); 

header('Access-Control-Allow-Origin: '.$_SERVER['SERVER_ADDR']);
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type');
//echo 'User IP Address - '.$_SERVER['SERVER_ADDR'];  
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../../class.admin.php");
  $auth_item = new admin(); 

/*
$json=trim($_POST['json']);*/
$bio=($_POST['bio']);
$username_login=trim($_POST['username_login']);
$lto_accreditation_no=trim($_POST['lto_accreditation_no']);
$uid=trim($_POST['uid']);

$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';   
        $input_length =strlen($permitted_chars);

        $random_string = '';
        for($i = 0; $i <5; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
     $reference_no_generated="";
     $reference_no_generated=strtoupper($random_string).strtotime(date('Y-m-d H:i:s'));


  $stmt = $auth_item->runQuery("SELECT mr.*,tc.name as clinicname,CONCAT(mu.fname,' ',mu.lname) as doc_fullname,mu.prc_license_number,mu.ptr_number from medical_record as  mr  
    INNER JOIN  tbl_clinics as  tc  ON  tc.id=mr.branch_id
    LEFT JOIN  medical_users as mu ON mu.id=mr.doctor_attended WHERE mr.uid='$uid'");
  $stmt->execute();
  $Row=$stmt->fetch(PDO::FETCH_ASSOC);



// Get the image and convert into string
$img = file_get_contents('../../control/upload/$Row["imgs"]');
$data64_img="";
// Encode the image string data into base64
$data64_img = base64_encode($img);
  
// Display the output
//echo $data64;
  
  $general_physique="0";
  if($general_physique!=="undefined"){
    $general_physique=$Row['general_physique'];
  }

  $contagious_desiease="0";
  if($contagious_desiease!=="undefined"){
    $contagious_desiease=$Row['contagious_desiease'];
  }
$bt=$Row['blood_type'];
if($bt=="O positive"){ $temp_blood_type="O+";}else
if($bt=="O negative"){ $temp_blood_type="O-";}else
if($bt=="A positive"){ $temp_blood_type="A+";}else
if($bt=="A negative"){ $temp_blood_type="A-";}else
if($bt=="B positive"){ $temp_blood_type="B+";}else
if($bt=="B negative"){ $temp_blood_type="B-";}else
if($bt=="AB positive"){ $temp_blood_type="AB+";}else
if($bt=="AB negative"){ $temp_blood_type="AB-";}else{
  $temp_blood_type="-";
}
$marital_status=$Row['marital_status'];
if($marital_statu=="Married"){ $temp_marital_status="M";}else
if($marital_statu=="Separated"){  $temp_marital_status="P";}else
if($marital_statu=="Single"){  $temp_marital_status="S";}else
if($marital_statu=="Widow"){  $temp_marital_status="W";}else{  $temp_marital_status="S";}


$driver_assessment=$Row['assessment'];

if($driver_assessment=="1"){ $temp_driver_assessment="Fit";}else
if($driver_assessment=="2"){ $temp_driver_assessment="Unfit";}else
if($driver_assessment=="3"){ $temp_driver_assessment="Temporary"; }else
if($driver_assessment=="4"){ $temp_driver_assessment="Permanent";}else
if($driver_assessment=="5"){ $temp_driver_assessment="Refer";}

$gender=$Row['gender'];
if($gender=="Male"){$temp_gen="M";}else{$temp_gen="F";}


$eye_color_temp=$Row['eye_color_right'];

if($eye_color_temp==="" || empty($eye_color_temp)){
  $eye_color_temp="1";
}
$json_data='{
  "physician_username":"'.$username_login.'",
  "physician_biometrics": ["'.$bio.'"],
  "lto_accreditation_no": "'.$lto_accreditation_no.'",
  "Exam_Datas": [
    {
      "lto_client_id": "",
      "first_name": "'.$Row['first_name'].'",
      "last_name":  "'.$Row['last_name'].'",
      "middle_name":  "'.$Row['middle_name'].'",
      "address":  "'.$Row['address'].'",
      "date_of_birth":  "'.$Row['bdate'].'",
      "gender": "'.$temp_gen.'",
      "nationality":  "'.$Row['nationality'].'",
      "civil_status":  "'. $temp_marital_status.'",
      "height": "'.$Row['height'].'",
      "weight": "'.$Row['weight'].'",
      "purpose": "'.$Row['purpose'].'",
      "license_no": "'.$Row['license_no'].'",
      "condition": "'.$Row['condition_driving'].'",
      "assessment": "'.$temp_driver_assessment.'",
      "assessment_status": "'.$temp_driver_assessment.'",
      "medical_exam_date":"'.date('Y-m-d').'",
      "client_application_date": "'.date('Y-m-d').'",
      "itpcode": "",
      "reference_no": "'.$reference_no_generated.'",
      "physician_prc_license_no": "'.$_SESSION['prc_license_number'].'",
      "occupation": "",
      "applicant_photo": "'.$data64_img.'",
      "blood_pressure": "'.$Row['bp'].'",
      "disability": "'.$general_physique.'",
      "disease": "'.$contagious_desiease.'",
      "snellen_bailey_lovie_left": "'.$Row['eye_vision_left'].'",
      "snellen_bailey_lovie_right": "'.$Row['eye_vision_right'].'",
      "corrective_lens_left": "'.$Row['eye_left_correction'].'",
      "corrective_lens_right":"'.$Row['eye_right_correction'].'",
      "color_blind_left": "'.$Row['eye_vision_other_left'].'",
      "color_blind_right": "'.$Row['eye_vision_other_right'].'",
      "hearing_left": "'.$Row['hearing_left'].'",
      "hearing_right": "'.$Row['hearing_right'].'",
      "upper_extremities_left":  "'.$Row['upper_extreme_left'].'",
      "upper_extremities_right": "'.$Row['upper_extreme_right'].'",
      "lower_extremities_left": "'.$Row['lower_extreme_left'].'",
      "lower_extremities_right": "'.$Row['lower_extreme_right'].'",
      "diabetes":"'.$Row['diabetes'].'",
      "diabetes_treatment": "'.$Row['under_medication_diabetes'].'",
      "epilepsy": "'.$Row['epilepsy'].'",
      "epilepsy_treatment": "'.$Row['under_medication_epilepsy'].'",
      "last_seizure":"'.$Row['date_seizure'].'",
      "sleepapnea": "'.$Row['sleep_apnes'].'",
      "sleepapnea_treatment": "'.$Row['under_medication_apnes'].'",
      "mental": "'.$Row['aggressive_depressive_order'].'",
      "mental_treatment": "'.$Row['under_medication_aggressive'].'",
      "other": "'.$Row['other'].'",
      "other_treatment":"'.$Row['under_medication_other'].'",
      "other_medical_condition": "",
      "temporary_duration": "",
      "remarks": "'.$Row['remarks'].'",
      "medical_certificate_validity": "'.date("Y-m-d",strtotime("+60 days")).'",
      "eye_color": "'.$eye_color_temp.'",
      "blood_type":  "'.$temp_blood_type.'"
    }
  ]
}';

/*
$json_data='        {

  "physician_username":"JOANMARIETAYCO@GMAIL.COM",

  "physician_biometrics": ["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"],

  "lto_accreditation_no": "R04-22-004066",

  "Exam_Datas": [

    {

      "lto_client_id": "",

      "first_name": "FRANCHESCA",

      "last_name":  "TUAZON",

      "middle_name":  "LIGUATON",

      "address":  "42 LIBRA ST., CAMELLA HOMES  SALINAS III BACOOR CITY CAVITE",

      "date_of_birth":  "2002-04-11",

      "gender": "F",

      "nationality":  "PHL",

      "civil_status":  "S",

      "height": "154",

      "weight": "62",

      "purpose": "10",

      "license_no": "",

      "condition": "0",

      "assessment": "Fit",

      "assessment_status": "Fit",

      "medical_exam_date":"2022-09-01",

      "client_application_date": "2022-09-01",

      "itpcode": "",

      "reference_no": "eeeee16620178411AA",

      "physician_prc_license_no": "",

      "occupation": "",

      "applicant_photo": "",

      "blood_pressure": "120/80",

      "disability": "0",

      "disease": "0",

      "snellen_bailey_lovie_left": "20/25",

      "snellen_bailey_lovie_right": "20/30",

      "corrective_lens_left": "undefined",

      "corrective_lens_right":"undefined",

      "color_blind_left": "undefined",

      "color_blind_right": "undefined",

      "hearing_left": "1",

      "hearing_right": "1",

      "upper_extremities_left":  "Normal",

      "upper_extremities_right": "Normal",

      "lower_extremities_left": "Normal",

      "lower_extremities_right": "Normal",

      "diabetes":"0",

      "diabetes_treatment": "undefined",

      "epilepsy": "0",

      "epilepsy_treatment": "undefined",

      "last_seizure":"",

      "sleepapnea": "0",

      "sleepapnea_treatment": "undefined",

      "mental": "0",

      "mental_treatment": "undefined",

      "other": "0",

      "other_treatment":"undefined",

      "other_medical_condition": "",

      "temporary_duration": "",

      "remarks": "",

      "medical_certificate_validity": "2022-10-31",

      "eye_color": "1",

      "blood_type":  "O+"

    }

  ]

}';*/
//echo $json_data;
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
  CURLOPT_POSTFIELDS =>$json_data,
));

$response = curl_exec($curl);

/*$out = preg_split('/(\r?\n){2}/', $response, 2);
$headers = $out[0];
$headersArray = preg_split('/\r?\n/', $headers);
$headersArray = array_map(function($h) {
    return preg_split('/:\s{1,}/', $h, 2);
}, $headersArray);

$tmp = [];
foreach($headersArray as $h) {
    $tmp[strtolower($h[0])] = isset($h[1]) ? $h[1] : $h[0];
}
$headersArray = $tmp; $tmp = null;
// $headersArray contains your headers
print_r($headersArray);



*/
//echo "Proceed to processing";


//ECHO $response;
function isJSON($string){
   return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
}


if(isJSON($response)){
$json_data_response = json_decode($response);
$internal_reference_no=$json_data_response->internal_reference_no;
echo $internal_reference_no;
$date=date("Y-m-d H:i:s");
 $result=$auth_item->updateQuery("UPDATE medical_record SET  internal_reference_no='$internal_reference_no' ,date_created='$date' WHERE uid='$uid'");
//echo "Updating";
}else{
 //echo $response;
 echo "failed";
}


curl_close($curl);


