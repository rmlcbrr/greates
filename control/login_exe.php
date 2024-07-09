	$uname=urldecode($_POST['uname']);	
		$pass=base64_encode(urldecode($_POST['pass']));
		$query="SELECT * FROM medical_users WHERE username='$uname' and password='$pass' and status='1'";
		$result=$auth_item->login($query);
		echo "$result";
	
		$log_type="Login via [Web]";	
		$log_activity="USER-".$uname;
		$log_remarks=("User ".$uname." Login Succesfuly");