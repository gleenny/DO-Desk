<?php
require_once 'vendor/autoload.php';
$text = '';

//ayusin yung api key para di nakalabas dito
//$yourApiKey = 'API_KEY';
//$yourApiKey = getenv('your_API_key');
$client = OpenAI::client($yourApiKey);

try{
    $response = $client->audio()->transcribe([
        'model' => 'whisper-1',
        'file' => fopen('testing.m4a', 'r'), //change first param to audio path file
        'response_format' => 'verbose_json'
    ]);
    
    foreach ($response->segments as $segment) {
        $text .= $segment->text; // 'Hello, how are you?'
    }
}
catch(Exception $e){
    $text = 'error';
}

echo $text;

?>