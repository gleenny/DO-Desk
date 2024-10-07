<?php

$ch = curl_init();
$parameters = array(
    'apikey' => 'YOUR API', //Your API KEY
    'number' => '09178628580', //message to
    'message' => 'I would like to talk about your cars extended warranty',
    'sendername' => 'DODesk' //waiting for approval ng sendername
);
curl_setopt( $ch, CURLOPT_URL,'https://api.semaphore.co/api/v4/messages' );
curl_setopt( $ch, CURLOPT_POST, 1 );

//Send the parameters set above with the request
curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

// Receive response from server
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$output = curl_exec( $ch );
curl_close ($ch);

//Show the server response
echo $output;

?>