<?php
    // SETTINGS
    ini_set('max_execution_time', 0);
    ini_set('memory_limit', '1G');
    error_reporting(E_ERROR);


    // HELPER METHODS
function initCurlRequest($reqURL, $reqBody = '', $headers = array()) {


    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $reqURL);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $reqBody);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, true);
    
   	$body = curl_exec($ch);

   	// extract header
   	$headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	$header = substr($body, 0, $headerSize);
	$header = getHeaders($header);

	// extract body
	$body = substr($body, $headerSize);

    curl_close($ch);
    
    return [$header, $body];
}

function getHeaders($respHeaders) {
    $headers = array();

    $headerText = substr($respHeaders, 0, strpos($respHeaders, "\r\n\r\n"));

    foreach (explode("\r\n", $headerText) as $i => $line) {
        if ($i === 0) {
            $headers['http_code'] = $line;
        } else {
            list ($key, $value) = explode(': ', $line);

            $headers[$key] = $value;
        }
    }

    return $headers;
}

// MAIN
$requestMethod = $_SERVER["REQUEST_METHOD"];
if ($requestMethod !== 'POST') {
    $notpost = [
        'status' => 405,
        'message' => $requestMethod. ' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($notpost);
    die();
}
$inputData = file_get_contents("php://input");
$reqBody = $inputData;

if (empty($reqBody)) {
    $nocontent = [
        'status' => 204,
        'message' => '204 Empty Request Body',
    ];
    header("HTTP/1.0 204 (No Content)");
    echo json_encode($nocontent);
    die();
}

$headers = array(
    "Access-Control-Allow-Origin:*",
    "Content-Type: application/json",
    "Access-Control-Allow-Method: GET",
    "Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorozation, X-Request-With"
);

list($header, $body) = initCurlRequest('https://dermalog.ph:6167/ords/dl_interfaces/interface_CLINICS/v1/med_exam_results', $reqBody, $headers);

$data = [$header, $body];

print_r($data);

