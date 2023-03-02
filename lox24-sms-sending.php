<?php
// Set the URL for the Lox24 SMS API
$url = 'https://api.lox24.eu/sms';

// Set the client ID and authentication token
$clientId = CLIENT-NUMBER;
$token = 'TOKEN-HERE';

// Set the sender ID for the SMS
$sender_id = 'SENDER-ID-HERE';

// Set the SMS message body and recipient phone number
$message = "SMS-BODY-HERE";
$phone = "RECIPIENT-NUMBER-WITH-COUNTRY-CODE";

// Create an array with the necessary data to send the SMS
$body = [
  'sender_id' => $sender_id,
  'text' => $message,
  'service_code' => 'direct',
  'phone' => $phone,
  'delivery_at' => 0,
  'is_unicode' => null,
];

// Encode the data into JSON format
if(!$body = json_encode($body)) {
  die('JSON encoding error!');
}

// Send a POST request to the Lox24 SMS API using cURL
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_POST => true,
  CURLOPT_URL => $url,
  CURLOPT_POSTFIELDS => $body,
  CURLOPT_HTTPHEADER => [
    "X-LOX24-CLIENT-ID: {$clientId}",
    "X-LOX24-AUTH-TOKEN: {$token}",
    'Accept: application/json',
    'Content-Type: application/json',
  ],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 20,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
]);
$response = curl_exec($curl);
$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

// Decode the response into a JSON object
$data = json_decode($response, JSON_OBJECT_AS_ARRAY);

// Print the response data if the SMS was sent successfully
if(201 === $code) {
  echo 'Success: response data = ' . var_export($data, true);
} else {
  // Otherwise, print the error code and data
  echo "Error: code = {$code}, data = " . var_export($data, true);
}

