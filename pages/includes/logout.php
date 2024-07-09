<?php
error_reporting(0);
include("../../class.admin.php");
session_start();
/*
$auth_item = new admin();
$date=date('Y-m-d H:i:s');
$log_type="Logout via [Web]";
$log_activity="EMPLOYEE-".$_SESSION['uid'];
$log_uid=$_SESSION['uid'];
$log_remarks=("User ".$_SESSION['u_name']." Logout ");
$sql_logs="INSERT INTO tpl_sys_log(type, activity, date, uid, remarks) 
VALUES ('$log_type','$log_activity','$date','$log_uid','$log_remarks')";
$auth_item->logs($sql_logs);
*/
session_destroy();
header("location:../../index.php");
?>