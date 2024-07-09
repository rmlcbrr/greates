<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *'); 
$output=null;
$retval=null;
$cmd = exec('java -cp "lib/*;". VideoCaptureDemo', $output, $retval);


exec($cmd,$output);
$x=end($output);
$postData = array(
        "img" => prev($output),
        "base64" => $x
);

echo json_encode($postData, JSON_PRETTY_PRINT);
?>