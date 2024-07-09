<?php
header('Access-Control-Allow-Origin: *');
define('TIMEZONE', "Asia/Manila");
date_default_timezone_set(TIMEZONE);
session_start();
/* Database connection start */
$servername = "127.0.0.1";
$dbname = "dbmedical";
$username = "dbmedical";
$password = "@#dbmedical";


$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
$extension_database = "";
