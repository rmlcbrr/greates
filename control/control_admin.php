<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
session_start();
include("../class.admin.php");

date_default_timezone_set("Asia/Manila");
/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/
$auth_item = new admin();
//error_reporting(0);
session_start();
$log_uid = $_SESSION['u_id'];
$date = date("Y-m-d H:i:s");
$dt = new DateTime("now", new DateTimeZone('Asia/Manila'));
$date = $dt->format("Y-m-d H:i:s");
$status = urldecode($_POST['status']);


if ($status == "1" || $status === "1" ||  $status == 1) {
	/************************************FOR LIST LOGIN****************************************/


	$uname = urldecode($_POST['uname']);
	// $pass = base64_encode(urldecode($_POST['pass']));

	$pass = $_POST['pass'];

	$query = "SELECT * FROM medical_users WHERE username='$uname' and password='$pass' and status='1'";
	$result = $auth_item->login($query);
	echo "$result";

	$log_type = "Login via [Web]";
	$log_activity = "" . $uname;
	$log_remarks = (" " . $uname . " Login Succesfuly");
	exit;
} else if ($status == "2" || $status === "2" ||  $status == 2) {
	/************************************FOR SAVING CLINICS****************************************/
	$name = str_replace("'", "", urldecode($_POST['name']));
	$expire_date = urldecode($_POST['expire_date']);
	$lto_accre = str_replace("'", "", urldecode($_POST['lto_accre']));
	$payment = str_replace("'", "", urldecode($_POST['payment']));


	$query = "INSERT INTO tbl_clinics(`name`,`lto_accreditation_no`,`date_of_expiration_ltms`,`payment`)VALUES ('$name','$lto_accre','$expire_date','$payment')";

	$result = $auth_item->saveQuery($query);
	$log_type = "FOR SAVING NEW CLINICS";
	$log_activity = "USER SAVE CLINICS " . $name . " RECORD VIA WEB";
	$log_remarks = ("Save Succesfuly");
} else if ($status == "3" || $status === "3" ||  $status == 3) {
	/************************************FOR UPDATING CLINICS****************************************/
	$name = str_replace("'", "", urldecode($_POST['name']));
	$id = urldecode(base64_decode($_POST['id']));
	$lto_accre = str_replace("'", "", urldecode($_POST['lto_accre']));
	$expire_date = urldecode($_POST['expire_date']);
	$payment = str_replace("'", "", urldecode($_POST['payment']));


	$query = "UPDATE tbl_clinics SET `name`='$name' , lto_accreditation_no='$lto_accre' , date_of_expiration_ltms ='$expire_date' , payment='$payment' WHERE id='$id'";
	$result = $auth_item->updateQuery($query);

	$log_type = "FOR UPDATING CLINICS";
	$log_activity = "USER UPDATE CLINICS " . $name . " RECORD VIA WEB";
	$log_remarks = ("Update Succesfuly");
} else if ($status == "4" || $status === "4" ||  $status == 4) {
	/************************************FOR SAVING new pHYSICIANS****************************************/
	$uname = str_replace("'", "", urldecode($_POST['uname']));


	$stmt = $auth_item->runQuery("SELECT count(*) as totals FROM medical_users WHERE username='$uname'");
	$stmt->execute();
	$Row = $stmt->fetch(PDO::FETCH_ASSOC);
	$pwd = base64_encode(str_replace("'", "", urldecode($_POST['pwd'])));
	$fname = str_replace("'", "", urldecode($_POST['fname']));
	$clinics = str_replace("'", "", urldecode($_POST['clinics']));
	$lname = str_replace("'", "", urldecode($_POST['lname']));
	$prc = str_replace("'", "", urldecode($_POST['prc_num']));
	$ptr = str_replace("'", "", urldecode($_POST['ptr_num']));
	$email = str_replace("'", "", urldecode($_POST['email']));
	if ($Row['totals'] < 1) {

		$query = "INSERT INTO medical_users(fname, lname,  account_type, username, password, status, prc_license_number, ptr_number,clinic,email)VALUES ('$fname','$lname','physician','$uname','$pwd','1','$prc','$ptr','$clinics','$email')";

		$result = $auth_item->saveQuery($query);
		$fullname = $fname . " " . $lname;
		$log_type = "FOR SAVING NEW PHYSICIANS";
		$log_activity = "USER ADD PHYSICIANS " . $fullname . " RECORD VIA WEB";
		$log_remarks = ("Save Succesfuly");
	} else {

		echo "alread_exist";
		$log_type = "FOR SAVING NEW PHYSICIANS FAILED";
		$log_activity = "USER ADD PHYSICIANS " . $fullname . " ALREADY EXIST IN DATABASE PRCOESS VIA WEB";
		$log_remarks = ("Save Failed");
	}
} else if ($status == "5" || $status === "5" ||  $status == 5) {
	/************************************FOR DELETE_CLINICS****************************************/
	$id = base64_decode($_POST['id']);
	$query = "DELETE FROM tbl_clinics WHERE id='$id' ";
	$auth_item->deleteQuery($query);

	$log_type = "FOR DELETE CLINICS";
	$log_activity = "USER DELETE CLINIC  RECORD VIA WEB";
	$log_remarks = ("Delete Succesfuly ID : " . $id);
} else if ($status == "6" || $status === "6" ||  $status == 6) {
	/************************************FOR UPDATES_OF_PHYSICIAN****************************************/
	$id = base64_decode($_POST['id']);
	$uname = str_replace("'", "", urldecode($_POST['uname']));

	$stmt = $auth_item->runQuery("SELECT count(*) as totals FROM medical_users WHERE username='$uname'  and id<>'$id'");
	$stmt->execute();
	$Row = $stmt->fetch(PDO::FETCH_ASSOC);

	$clinics = str_replace("'", "", urldecode($_POST['clinics']));
	$pwd = base64_encode(str_replace("'", "", urldecode($_POST['pwd'])));
	$fname = str_replace("'", "", urldecode($_POST['fname']));
	$lname = str_replace("'", "", urldecode($_POST['lname']));
	$prc = str_replace("'", "", urldecode($_POST['prc_num']));
	$ptr = str_replace("'", "", urldecode($_POST['ptr_num']));
	if ($Row['totals'] < 1) {

		$query = "UPDATE medical_users SET fname='$fname', lname='$lname', username='$uname', password='$pwd', prc_license_number='$prc', ptr_number='$ptr',clinic='$clinics' WHERE id='$id'";

		$result = $auth_item->updateQuery($query);
		$fullname = $fname . " " . $lname;
		$log_type = "FOR UPDATE OF PHYSICIANS";
		$log_activity = "USER UPDATE PHYSICIANS " . $fullname . " RECORD VIA WEB";
		$log_remarks = ("Update Succesfuly");
	} else {

		echo "alread_exist";
		$log_type = "FOR UPDATING PHYSICIANS FAILED";
		$log_activity = "USER UPDATED PHYSICIANS " . $fullname . " ALREADY EXIST IN DATABASE PRCOESS VIA WEB";
		$log_remarks = ("Update Failed");
	}
} else if ($status == "7" || $status === "7" ||  $status == 7) {
	/************************************FOR SAVING MEDICAL RECORD****************************************/



	$transtype = str_replace("'", "", urldecode($_POST['transtype']));
	$license = (str_replace("'", "", urldecode($_POST['license'])));
	$bdate = str_replace("'", "", urldecode($_POST['bdate']));
	$surname = str_replace("'", "", urldecode($_POST['surname']));
	$mname = str_replace("'", "", urldecode($_POST['mname']));
	$fname = str_replace("'", "", urldecode($_POST['fname']));
	$gender = str_replace("'", "", urldecode($_POST['gender']));
	$marital_status = (str_replace("'", "", urldecode($_POST['marital_status'])));
	$nationalities = str_replace("'", "", urldecode($_POST['nationalities']));
	$address = str_replace("'", "", urldecode($_POST['address']));
	$mobile = str_replace("'", "", urldecode($_POST['mobile']));
	$email = str_replace("'", "", urldecode($_POST['email']));

	$heights = str_replace("'", "", urldecode($_POST['heights']));
	$weights = (str_replace("'", "", urldecode($_POST['weights'])));
	$bp = str_replace("'", "", urldecode($_POST['bp']));
	$bt = str_replace("'", "", urldecode($_POST['bt']));
	$gen = str_replace("'", "", urldecode($_POST['gen']));
	$cont = str_replace("'", "", urldecode($_POST['cont']));
	$lower_extreme_left = str_replace("'", "", urldecode($_POST['lower_extreme_left']));
	$upper_extreme_left = (str_replace("'", "", urldecode($_POST['upper_extreme_left'])));
	$lower_extreme_right = str_replace("'", "", urldecode($_POST['lower_extreme_right']));
	$upper_extreme_right = (str_replace("'", "", urldecode($_POST['upper_extreme_right'])));
	$general_physique = str_replace("'", "", urldecode($_POST['general_physique']));
	$contagious_disease = str_replace("'", "", urldecode($_POST['contagious_disease']));



	$metabolic_diabetes = str_replace("'", "", urldecode($_POST['metabolic_diabetes']));
	$under_medication_diabetes = (str_replace("'", "", urldecode($_POST['under_medication_diabetes'])));
	$metabolic_epilepsy = str_replace("'", "", urldecode($_POST['metabolic_epilepsy']));
	$under_medication_epilepsy = str_replace("'", "", urldecode($_POST['under_medication_epilepsy']));
	$metabolic_apnes = str_replace("'", "", urldecode($_POST['metabolic_apnes']));
	$under_medication_apnes = str_replace("'", "", urldecode($_POST['under_medication_apnes']));
	$metabolic_aggressive = str_replace("'", "", urldecode($_POST['metabolic_aggressive']));
	$under_medication_aggressive = (str_replace("'", "", urldecode($_POST['under_medication_aggressive'])));
	$metabolic_other = str_replace("'", "", urldecode($_POST['metabolic_other']));
	$under_medication_other = str_replace("'", "", urldecode($_POST['under_medication_other']));

	$snellen_left = str_replace("'", "", urldecode($_POST['snellen_left']));
	$snellen_right = str_replace("'", "", urldecode($_POST['snellen_right']));
	$eye_left_color = (str_replace("'", "", urldecode($_POST['eye_left_color'])));
	$eye_right_color = str_replace("'", "", urldecode($_POST['eye_right_color']));
	$eye_left_correction = (str_replace("'", "", urldecode($_POST['eye_left_correction'])));
	$eye_right_correction = str_replace("'", "", urldecode($_POST['eye_right_correction']));


	$hearing_left = str_replace("'", "", urldecode($_POST['hearing_left']));
	$hearing_right = str_replace("'", "", urldecode($_POST['hearing_right']));
	$eye_right_color_data = str_replace("'", "", urldecode($_POST['eye_right_color_data']));
	$eye_left_color_data = str_replace("'", "", urldecode($_POST['eye_left_color_data']));


	$med_diabetes = str_replace("'", "", urldecode($_POST['med_diabetes']));
	$med_epilepsy = str_replace("'", "", urldecode($_POST['med_epilepsy']));
	$med_apnea = str_replace("'", "", urldecode($_POST['med_apnea']));
	$med_disorder = str_replace("'", "", urldecode($_POST['med_disorder']));
	$med_other = str_replace("'", "", urldecode($_POST['med_other']));


	$condition_driving = str_replace("'", "", urldecode($_POST['condition_driving']));
	$driver_assessment = str_replace("'", "", urldecode($_POST['driver_assessment']));
	$driver_remarks = (str_replace("'", "", urldecode($_POST['driver_remarks'])));

	$duration_temporary = (str_replace("'", "", urldecode($_POST['duration_temporary'])));

	$last_seizure = (str_replace("'", "", urldecode($_POST['last_seizure'])));
	$jsonData = $_POST['jsonData'];

	$internal_reference_no = (str_replace("'", "", urldecode($_POST['internal_reference_no'])));
	//internal_reference_no

	//***************IMAGE**************//
	$img = $_POST['img_data'];
	$uri = substr($img, strpos($img, ",") + 1);
	//echo $img;

	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$imagedata = base64_decode($img);
	$filename = md5(date("dmYhisA"));

	//Location to where you want to created sign image
	//echo $_POST['img_data']	


	$branch_id = $_SESSION['clinic_id'];
	$doctor = $_SESSION['u_id'];
	$clinic_ids = $_SESSION['clinic_id'];
	$uids = $_SESSION['uid_data'];

	$tmp_name = uniqid() . $filename . '.png';
	$file_name = 'upload/' . $tmp_name;

	$success = file_put_contents($file_name, $imagedata);

	// print $success ? $file_name : 'Unable to save the file.';
	//***************8FORRANDOMNUMBER**************//

	/*	 $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';   
        $input_length =strlen($permitted_chars);

        $random_string = '';
        for($i = 0; $i < 8; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
	*/
	//$trans=$random_string;
	$trans = (str_replace("'", "", urldecode($_POST['reference_no_generated'])));


	$query = "INSERT INTO medical_record(uid,branch_id,purpose,medical_type ,first_name, last_name, middle_name, bdate, driver_license, address, mobile, email, gender, marital_status, nationality,height, weight, bp, blood_type, general_physique, contagious_desiease,lower_extreme_left,upper_extreme_left, general_physique_reason, contagious_desiease_reason, diabetes, epilepsy, sleep_apnes, aggressive_depressive_order, other, eye_vision_left, eye_vision_other_left, hearing_left, condition_driving, assessment, remarks, date_created, doctor_attended, under_medication_diabetes, under_medication_epilepsy,under_medication_apnes, under_medication_aggressive, under_medication_other,hearing_right, eye_vision_right,eye_vision_other_right,date_seizure,eye_left_correction,eye_right_correction,durations,lower_extreme_right,upper_extreme_right,is_submitted,imgs,clinics,creator,internal_reference_no,eye_color_left,eye_color_right,med_diabetes,med_epilepsy,med_apnea,med_disorder,med_other)

	VALUES ('$trans','$branch_id','$transtype','$transtype','$fname','$surname','$mname','$bdate','$license','$address','$mobile','$email','$gender','$marital_status','$nationalities','$heights','$weights','$bp','$bt','$general_physique','$contagious_disease','$lower_extreme_left','$upper_extreme_left','$gen','$cont','$metabolic_diabetes','$metabolic_epilepsy','$metabolic_apnes','$metabolic_aggressive','$metabolic_other','$snellen_left','$eye_left_color','$hearing_left','$condition_driving','$driver_assessment','$driver_remarks','$date','$doctor','$under_medication_diabetes','$under_medication_epilepsy','$under_medication_apnes','$under_medication_aggressive','$under_medication_other','$hearing_right','$snellen_right','$eye_right_color','$last_seizure','$eye_left_correction','$eye_right_correction','$duration_temporary','$lower_extreme_right','$upper_extreme_right','0','$tmp_name','$clinic_ids','$uids','$internal_reference_no','$eye_left_color_data','$eye_right_color_data','$med_diabetes','$med_epilepsy','$med_apnea','$med_disorder','$med_other')";


	//echo $query;
	$result = $auth_item->saveQuery($query);
	$fullname = $fname . " " . $mname . " " . $surname;
	$log_type = "FOR SAVING MEDICAL RECORD";
	$log_activity = "USER ADD MEDICAL RECORD OF  " . $fullname . " RECORD VIA WEB";
	$log_remarks = ("Save Succesfuly");
} else if ($status == "8" || $status === "8" ||  $status == 8) {
	/************************************FOR UPDATING MEDICAL RECORD****************************************/


	$uid = str_replace("'", "", urldecode($_POST['uid']));
	$transtype = str_replace("'", "", urldecode($_POST['transtype']));
	$license = (str_replace("'", "", urldecode($_POST['license'])));
	$bdate = str_replace("'", "", urldecode($_POST['bdate']));
	$surname = str_replace("'", "", urldecode($_POST['surname']));
	$mname = str_replace("'", "", urldecode($_POST['mname']));
	$fname = str_replace("'", "", urldecode($_POST['fname']));
	$gender = str_replace("'", "", urldecode($_POST['gender']));
	$marital_status = (str_replace("'", "", urldecode($_POST['marital_status'])));
	$nationalities = str_replace("'", "", urldecode($_POST['nationalities']));
	$address = str_replace("'", "", urldecode($_POST['address']));
	$mobile = str_replace("'", "", urldecode($_POST['mobile']));
	$email = str_replace("'", "", urldecode($_POST['email']));

	$heights = str_replace("'", "", urldecode($_POST['heights']));
	$weights = (str_replace("'", "", urldecode($_POST['weights'])));
	$bp = str_replace("'", "", urldecode($_POST['bp']));
	$bt = str_replace("'", "", urldecode($_POST['bt']));
	$gen = str_replace("'", "", urldecode($_POST['gen']));
	$cont = str_replace("'", "", urldecode($_POST['cont']));
	$lower_extreme_left = str_replace("'", "", urldecode($_POST['lower_extreme_left']));
	$upper_extreme_left = (str_replace("'", "", urldecode($_POST['upper_extreme_left'])));
	$lower_extreme_right = str_replace("'", "", urldecode($_POST['lower_extreme_right']));
	$upper_extreme_right = (str_replace("'", "", urldecode($_POST['upper_extreme_right'])));
	$general_physique = str_replace("'", "", urldecode($_POST['general_physique']));
	$contagious_disease = str_replace("'", "", urldecode($_POST['contagious_disease']));



	$metabolic_diabetes = str_replace("'", "", urldecode($_POST['metabolic_diabetes']));
	$under_medication_diabetes = (str_replace("'", "", urldecode($_POST['under_medication_diabetes'])));
	$metabolic_epilepsy = str_replace("'", "", urldecode($_POST['metabolic_epilepsy']));
	$under_medication_epilepsy = str_replace("'", "", urldecode($_POST['under_medication_epilepsy']));
	$metabolic_apnes = str_replace("'", "", urldecode($_POST['metabolic_apnes']));
	$under_medication_apnes = str_replace("'", "", urldecode($_POST['under_medication_apnes']));
	$metabolic_aggressive = str_replace("'", "", urldecode($_POST['metabolic_aggressive']));
	$under_medication_aggressive = (str_replace("'", "", urldecode($_POST['under_medication_aggressive'])));
	$metabolic_other = str_replace("'", "", urldecode($_POST['metabolic_other']));
	$under_medication_other = str_replace("'", "", urldecode($_POST['under_medication_other']));

	$snellen_left = str_replace("'", "", urldecode($_POST['snellen_left']));
	$snellen_right = str_replace("'", "", urldecode($_POST['snellen_right']));
	$eye_left_color = (str_replace("'", "", urldecode($_POST['eye_left_color'])));
	$eye_right_color = str_replace("'", "", urldecode($_POST['eye_right_color']));
	$eye_left_correction = (str_replace("'", "", urldecode($_POST['eye_left_correction'])));
	$eye_right_correction = str_replace("'", "", urldecode($_POST['eye_right_correction']));


	$eye_right_color_data = str_replace("'", "", urldecode($_POST['eye_right_color_data']));
	$eye_left_color_data = str_replace("'", "", urldecode($_POST['eye_left_color_data']));


	$med_diabetes = str_replace("'", "", urldecode($_POST['med_diabetes']));
	$med_epilepsy = str_replace("'", "", urldecode($_POST['med_epilepsy']));
	$med_apnea = str_replace("'", "", urldecode($_POST['med_apnea']));
	$med_disorder = str_replace("'", "", urldecode($_POST['med_disorder']));
	$med_other = str_replace("'", "", urldecode($_POST['med_other']));


	$hearing_left = str_replace("'", "", urldecode($_POST['hearing_left']));
	$hearing_right = str_replace("'", "", urldecode($_POST['hearing_right']));
	$condition_driving = str_replace("'", "", urldecode($_POST['condition_driving']));
	$driver_assessment = str_replace("'", "", urldecode($_POST['driver_assessment']));
	$driver_remarks = (str_replace("'", "", urldecode($_POST['driver_remarks'])));

	$duration_temporary = (str_replace("'", "", urldecode($_POST['duration_temporary'])));
	$doctor = $_SESSION['u_id'];
	$last_seizure = (str_replace("'", "", urldecode($_POST['last_seizure'])));
	$trans = (str_replace("'", "", urldecode($_POST['reference_no_generated'])));

	$internal_reference_no = (str_replace("'", "", urldecode($_POST['internal_reference_no'])));

	//***************IMAGE**************//
	//***************IMAGE**************//

	$add_img = "";
	$did_change_img = $_POST['did_change_img'];
	if ($did_change_img === "1" || $did_change_img === '1') {
		// $imagedata = substr($_POST['img_data'],strpos($_POST['img_data'],",")+1);
		// $imagedata=base64_decode($imagedata);
		// $filename = md5(date("dmYhisA"));
		//Location to where you want to created sign image
		$img = $_POST['img_data'];
		$uri = substr($img, strpos($img, ",") + 1);
		//echo $img;

		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$imagedata = base64_decode($img);
		$filename = md5(date("dmYhisA"));



		$branch_id = $_SESSION['clinic_id'];
		$doctor = $_SESSION['u_id'];
		$clinic_ids = $_SESSION['clinic_id'];
		$uids = $_SESSION['uid_data'];

		$tmp_name = uniqid() . $filename . '.png';
		$file_name = 'upload/' . $tmp_name;
		$add_img = ",imgs='$tmp_name'";

		file_put_contents($file_name, $imagedata);
	} else {
		$add_img = "";
	}



	//***************8FORRANDOMNUMBER**************//

	$query = "UPDATE medical_record SET uid='$trans' ,medical_type='$transtype', first_name='$fname', last_name='$surname', middle_name='$mname', bdate='$bdate', driver_license='$license', address='$address', mobile='$mobile', email='$email', gender='$gender', marital_status='$marital_status', nationality='$nationalities',height='$heights', weight='$weights', bp='$bp', blood_type='$bt', general_physique='$general_physique', contagious_desiease='$contagious_disease',lower_extreme_left='$lower_extreme_left',upper_extreme_left='$upper_extreme_left', general_physique_reason='$gen', contagious_desiease_reason='$cont', diabetes='$metabolic_diabetes', epilepsy='$metabolic_epilepsy', sleep_apnes='$metabolic_apnes', aggressive_depressive_order='$metabolic_aggressive', other='$metabolic_other', eye_vision_left='$snellen_left', eye_vision_other_left='$eye_left_color', hearing_left='$hearing_left', condition_driving='$condition_driving', assessment='$driver_assessment', remarks='$driver_remarks',under_medication_diabetes='$under_medication_diabetes', under_medication_epilepsy='$under_medication_epilepsy',under_medication_apnes='$under_medication_apnes', under_medication_aggressive='$under_medication_aggressive', under_medication_other='$under_medication_other',hearing_right='$hearing_right', eye_vision_right='$snellen_right',eye_vision_other_right='$eye_right_color',date_seizure='$last_seizure',eye_left_correction='$eye_left_correction',eye_right_correction='$eye_right_correction',durations='$duration_temporary',lower_extreme_right='$lower_extreme_right',upper_extreme_right='$upper_extreme_right' ,eye_color_left='$eye_left_color_data',eye_color_right='$eye_right_color_data',med_diabetes='$med_diabetes',med_epilepsy='$med_epilepsy',med_apnea='$med_apnea',med_disorder='$med_disorder',med_other='$med_other',internal_reference_no='$internal_reference_no' $add_img	WHERE	uid='$uid'";





	$result = $auth_item->updateQuery($query);
	$fullname = $fname . " " . $mname . " " . $surname;
	$log_type = "FOR UPDATING MEDICAL RECORD";
	$log_activity = "USER UPDATE MEDICAL RECORD OF  " . $fullname . " RECORD VIA WEB";
	$log_remarks = ("Update Succesfuly");
} else if ($status == "9" || $status === "9" ||  $status == 9) {
	/************************************FOR LIST LOGIN****************************************/
	$uname = urldecode($_POST['uname']);
	$query = "SELECT * FROM medical_users WHERE username='$uname'	and status='1'";
	$result = $auth_item->login($query);
	echo "$result";

	$log_type = "Login via " . $type . " [Web] using biometrics";
	$log_activity = ("USER-" . $uname);
	$log_remarks = ("User " . $uname . " Login ");
} else if ($status == "10" || $status === "10" ||  $status == 10) {
	/************************************FOR SAVING new pHYSICIANS****************************************/
	$uname = str_replace("'", "", urldecode($_POST['uname']));


	$stmt = $auth_item->runQuery("SELECT count(*) as totals FROM medical_users WHERE username='$uname'");
	$stmt->execute();
	$Row = $stmt->fetch(PDO::FETCH_ASSOC);
	$pwd = base64_encode(str_replace("'", "", urldecode($_POST['pwd'])));
	$fname = str_replace("'", "", urldecode($_POST['fname']));
	$lname = str_replace("'", "", urldecode($_POST['lname']));
	$clinic = base64_decode(str_replace("'", "", urldecode($_POST['clinic'])));
	if ($Row['totals'] < 1) {

		$query = "INSERT INTO medical_users(fname, lname,  account_type, username, password, status, clinic)VALUES ('$fname','$fname','Admin','$uname','$pwd','1','$clinic')";

		$result = $auth_item->saveQuery($query);
		$fullname = $fname . " " . $lname;
		$log_type = "FOR SAVING NEW USER";
		$log_activity = "USER ADD " . $fullname . " RECORD VIA WEB";
		$log_remarks = ("Save Succesfuly");
	} else {

		echo "alread_exist";
		$log_type = "FOR SAVING NEW USER FAILED";
		$log_activity = "USER ADD  " . $fullname . " ALREADY EXIST IN DATABASE PRCOESS VIA WEB";
		$log_remarks = ("Save Failed");
	}
} else if ($status == "11" || $status === "11" ||  $status == 11) {
	/************************************FOR UPDATES_OF_PHYSICIAN****************************************/
	$id = base64_decode($_POST['id']);
	$uname = str_replace("'", "", urldecode($_POST['uname']));

	$stmt = $auth_item->runQuery("SELECT count(*) as totals FROM medical_users WHERE username='$uname'  and id<>'$id'");
	$stmt->execute();
	$Row = $stmt->fetch(PDO::FETCH_ASSOC);
	$pwd = base64_encode(str_replace("'", "", urldecode($_POST['pwd'])));
	$fname = str_replace("'", "", urldecode($_POST['fname']));
	$lname = str_replace("'", "", urldecode($_POST['lname']));
	$clinic = base64_decode(str_replace("'", "", urldecode($_POST['clinic'])));
	if ($Row['totals'] < 1) {

		$query = "UPDATE medical_users SET fname='$fname', lname='$lname', username='$uname', password='$pwd', clinic ='$clinic' WHERE id='$id'";

		$result = $auth_item->updateQuery($query);
		$fullname = $fname . " " . $lname;
		$log_type = "FOR UPDATE OF USER";
		$log_activity = "USER UPDATE " . $fullname . " RECORD VIA WEB";
		$log_remarks = ("Update Succesfuly");
	} else {

		echo "alread_exist";
		$log_type = "FOR UPDATING USER FAILED";
		$log_activity = "USER UPDATED  " . $fullname . " ALREADY EXIST IN DATABASE PRCOESS VIA WEB";
		$log_remarks = ("Update Failed");
	}
} else if ($status == "12" || $status === "12" ||  $status == 12) {
	/************************************FOR DELETING OF USERS AND PHYSICIANS****************************************/
	$id = base64_decode($_POST['id']);
	$query = "DELETE FROM medical_users WHERE id='$id' ";
	$auth_item->deleteQuery($query);

	$log_type = "FOR DELETE USER";
	$log_activity = "USER DELETE ID NUM:" . $id . " RECORD VIA WEB";
	$log_remarks = ("Delete Succesfuly ID : " . $id);
} else if ($status == "13" || $status === "13" ||  $status == 13) {
	/************************************FOR SAVING CLINICS****************************************/
	$purpose = str_replace("'", "", urldecode($_POST['purpose']));
	$value_data = str_replace("'", "", urldecode($_POST['value_data']));
	$query = "INSERT INTO tbl_settings(`value`,`purpose`)VALUES ('$value_data','$purpose')";

	$result = $auth_item->saveQuery($query);
	$log_type = "FOR SAVING NEW SYSDATA";
	$log_activity = "USER SAVE SYSDATA " . $purpose . " RECORD VIA WEB";
	$log_remarks = ("Save Succesfuly");
} else if ($status == "14" || $status === "14" ||  $status == 14) {
	/************************************FOR UPDATING CLINICS****************************************/
	$purpose = str_replace("'", "", urldecode($_POST['purpose']));
	$value_data = str_replace("'", "", urldecode($_POST['value_data']));
	$id = urldecode(base64_decode($_POST['id']));
	$query = "UPDATE tbl_settings SET `purpose`='$purpose' , `value`='$value_data' WHERE id='$id'";
	$result = $auth_item->updateQuery($query);

	$log_type = "FOR UPDATING SYSDATA";
	$log_activity = "USER UPDATE SYSDATA " . $purpose . " RECORD VIA WEB";
	$log_remarks = ("Update Succesfuly");
} else if ($status == "15" || $status === "15" ||  $status == 15) {
	/************************************FOR UPDATING CLINICS****************************************/

	$jsonData = $_POST['jsonData'];
	$date = date("Y-m-d H:i:s");
	$branch_id = $_SESSION['clinic_id'];
	$query = "INSERT INTO failed_upload(json_string,created_by,clinic)VALUES('$jsonData','$date','$branch_id')";
	echo $query;
	$result = $auth_item->saveQuery($query);
	$fullname = $fname . " " . $mname . " " . $surname;
	$log_type = "FOR FAILED SAVING MEDICAL RECORD";
	$log_activity = "USER FAILED ADD MEDICAL RECORD OF  " . $fullname . " RECORD VIA WEB";
	$log_remarks = ("Save Failed");
} else if ($status == "16" || $status === "16" ||  $status == 16) {
	/************************************FOR BILLING CLINICS****************************************/

	$contrl_num = $_POST['contrl_num'];
	$date = date("Y-m-d H:i:s");
	$clinics = $_POST['clinics'];
	$created_by = $_SESSION['full_names'];
	$date_ranged = $_POST['date_created'];
	$query = "INSERT INTO tbl_billing( branch,  uploaded ,date_create, created_by, status, control_num)VALUES('$clinics','$date_ranged','$date','$created_by','FOR REVIEW','$contrl_num')";
	//echo $query;

	$result = $auth_item->saveQuery($query);
	////**********************LOGS************************************///
	$stmt = $auth_item->runQuery("SELECT name FROM tbl_clinics WHERE id='$clinics'");
	$stmt->execute();
	$Row = $stmt->fetch(PDO::FETCH_ASSOC);
	$clinic_name = $Row['name'];
	$fullname = $fname . " " . $mname . " " . $surname;
	$log_type = "FOR GENERATION OF BILLING RECORD";
	$log_activity = "USER CREATED BILLING FOR MEDICAL RECORD OF  " . $clinic_name . " RECORD VIA WEB";
	$log_remarks = ("Save Success");

	echo $result;
} else if ($status == "17" || $status === "17" ||  $status == 17) {
	/************************************FOR billing per CLINICS****************************************/

	$date = date("Y-m-d H:i:s");
	$user_id = $_POST['user_id'];
	$billing_id = $_POST['billing_id'];
	$query = "INSERT INTO tbl_billing_uploaded( billing_id, user_id, date_created)VALUES('$billing_id','$user_id','$date')";
	//echo $query;

	$result = $auth_item->saveQuery($query);

	if (!empty($result)) {
		echo "success";
		$query = "UPDATE medical_record SET `paid_status`='1' WHERE uid='$user_id'";
		$result = $auth_item->updateQuery($query);
	} else {
		echo "faield";
	}
}




/************************************SAVE LOGS****************************************/
//if(!empty(trim($log_type)) && !empty(trim($log_remarks)) && !empty(trim($log_activity))){
$date = date("Y-m-d H:i:s");
if ($log_type !== "" || $log_type !== '') {

	$log_uid = $_SESSION['uid'];
	if ($log_uid == "") {
		$log_uid = $_SESSION['u_id'];
	}

	$sql_logs = "INSERT INTO tpl_sys_log(type, activity, date, uid, remarks) 
VALUES ('$log_type','$log_activity','$date','$log_uid','$log_remarks')";
	$auth_item->logs($sql_logs);
}
//}
