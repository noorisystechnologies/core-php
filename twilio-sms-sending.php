// Set the Twilio Account SID and Auth Token
$id = "TWILIO-ACCOUNT-ID";
$token = "TWILIO-ACCOUNT-TOKEN";

// Set the URL for sending messages using the Twilio API
$url = "https://api.twilio.com/2010-04-01/Accounts/$id/Messages";

// Set the 'from' and 'to' phone numbers for the SMS message, along with the message body
$from = "TWILIO-ACCOUNT-PHONE-NUMBER-WITH-COUNTRY-CODE";
$to = "RECIPIENT-PHONE-NUMBER-WITH-COUNTRY-CODE";
$body = "SMS-BODY-HERE";

// Create an array with the message data
$data = array (
'From' => $from,
'To' => $to,
'Body' => $body,
);

// Build the post data for sending the message
$post = http_build_query($data);

// Initialize a cURL session for sending the message
$x = curl_init($url);

// Set the cURL options
curl_setopt($x, CURLOPT_POST, true);
curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($x, CURLOPT_USERPWD, "$id:$token");
curl_setopt($x, CURLOPT_POSTFIELDS, $post);

// Execute the cURL session to send the message and close the session
curl_exec($x);
curl_close($x);
