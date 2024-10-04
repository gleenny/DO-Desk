<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_FILES['files'])){
        require_once 'vendor/autoload.php';
        $text = '';
        $errors = [];
        $path = '../uploads/';
        $extensions = ['mp3', 'mp4', 'mpeg', 'mpga', 'm4a', 'wav', 'webm'];
        
        $file_name = $_FILES['files']['name'][0]; //file name
        $file_tmp = $_FILES['files']['tmp_name'][0]; // temp name on server
        $file_type = $_FILES['files']['type'][0]; // MIME type of file
        $file_size = $_FILES['files']['size'][0]; // file size
        $ext_temp = explode('.', $file_name);
        $file_ext = strtolower(end($ext_temp)); // file extension

        $file = $path . $file_name;
        
        if(!in_array($file_ext, $extensions)){ //checks if file extension is allowed
            $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
        }
        if($file_size > 25000000){ //checks if file size fits
            $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
        }

        if(empty($errors)){
            move_uploaded_file($file_tmp, $file);

            //ayusin yung api key para di nakalabas dito
            //$yourApiKey = 'API KEY';
            //$yourApiKey = getenv('your_API_key');
            $client = OpenAI::client($yourApiKey);
            
            try{
                $response = $client->audio()->transcribe([
                    'model' => 'whisper-1',
                    'file' => fopen($path . $file_name, 'r'), //change first param to audio path file
                    'response_format' => 'verbose_json'
                ]);
                
                foreach ($response->segments as $segment) {
                    $text .= $segment->text;
                }
            }
            catch(Exception $e){
                $text = 'error';
            }
            $fileInfo = array(
                0 => $text,
                1 => $file_name,
            );
            print_r (json_encode($fileInfo));
        }
        if($errors){
            $fileInfo = array(
                0 => $text,
                1 => $file_name,
            );
            print_r (json_encode($fileInfo));
        }
    }
}

?>