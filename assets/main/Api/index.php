<?php
$method = $_SERVER['REQUEST_METHOD'];
if ($method = "POST") {
  $json = json_decode(file_get_contents("php://input"));
  if (isset($json->image)) {
    $curl = curl_init();

    $data = array(
      "images" => array($json->image),
      "latitude" => 49.207,
      "longitude" => 16.608,
      "similar_images" => true
    );

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://insect.kindwise.com/api/v1/identification?details=common_names,url,description,image',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => array(
        'Api-Key: VsRppBfGu16qdgpBid3knhcsTpKFqjaj4A0Ti1FGSkOS9hx11i',
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo json_encode($response, JSON_PRETTY_PRINT);
  } else {
    $error = array(
      "status" => 400,
      "message" => "No image was set."
    );
    echo json_encode($error, JSON_PRETTY_PRINT);
  }
} else {
  $error = array(
    "status" => 401,
    "message" => "Request not allowed."
  );
  echo json_encode($error, JSON_PRETTY_PRINT);
}
