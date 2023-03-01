<?php
// Set the URL of the API endpoint
$url = "https://api.orangesmspro.sn:8443/api";

// Set the login ID
$login = "LOGIN-ID";

// Set the API access key
$api_access_key= "API-ACCESS-KEY";

// Set the API token
$token= "API-TOKEN";

// Set the subject of the SMS
$subject= "SUBJECT";

// Set the signature of the SMS
$signature= "SIGNATURE";

// Set the recipient phone number with the phone code
$recipient = "RECIPIENT-PHONE-NUMBER-WITH-PHONE-CODE";

// Set the body of the SMS
$content = "SMS-BODY";

// Get the current timestamp
$timestamp=time();

// Concatenate the message data to be encrypted
$msgToEncrypt=$token . $subject . $signature . $recipient . $content . $timestamp;

// Generate a hash-based message authentication code (HMAC) with the SHA-1 algorithm
$key=hash_hmac('sha1', $msgToEncrypt, $api_access_key);

// Create an array of the SMS data
$data = array (
    'token' => $token,
    'subject' => $subject,
    'signature' => $signature,
    'recipient' => $recipient,
    'content' => $content,
    'timestamp' => $timestamp,
    'key' => $key
);

// Encode the SMS data into a format that can be sent via HTTP POST
$post = http_build_query($data);

// Initialize a new cURL session with the API endpoint URL
$x = curl_init($url);

// Set the cURL session to use HTTP POST
curl_setopt($x, CURLOPT_POST, true);

// Set the cURL session to return the result as a string
curl_setopt($x, CURLOPT_RETURNTRANSFER, true);

// Disable SSL certificate verification
curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);

// Set the cURL session to use basic HTTP authentication
curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

// Set the username and password for HTTP authentication
curl_setopt($x, CURLOPT_USERPWD, "$key:$token");

// Set the SMS data as the POST fields
curl_setopt($x, CURLOPT_POSTFIELDS, $post);

// Execute the cURL session and close it
curl_exec($x);
curl_close($x);
?>
