<?php 

/*
*   PHP CURL Script
*/

$curl = curl_init();

curl_setopt_array($curl, array(  
    CURLOPT_URL => '',  // URL to send request
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',    // Request Using POST
    CURLOPT_POSTFIELDS => array( 'KEY_1'  => 'VALUE', 'KEY_2' => 'VALUE' ), // Form Data Here
));

$response = curl_exec($curl);
curl_close($curl);

echo $response;