<?php
// echo date('H:i:s');
// sleep(1);
// flush();
// echo "<br>";
// echo date('H:i:s');

$house_master = 'TUSMT006';

// $url = 'http://localhost/smartfarm.v.2.0.1/test_2.php';
// $url = 'http://172.30.60.24/smartfarm.v.2.0.1/server/insert_data/tu/get_config.php';
$url = 'http://decc-bigdata.com/smartfarm/server/insert_data/tu/get_config.php';
// $url = 'http://203.154.83.117/../decc-bigdata.com/smartfarm/server/insert_data/tu/get_config.php';
// $url = 'api.zolution.fun/smartfarm/server/insert_data/tu/';
$data = array(
    'house_master' => $house_master,
    'syst' => 1
);
// print_r($data);
// exit();
// Initialize cURL session

$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36');

// Add option to follow redirects
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);



// Execute cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
}

// Close cURL session
curl_close($ch);

// Process the response
if ($response !== false) {
    echo 'Response: ' . $response;
} else {
    echo 'Failed to send POST request.';
}
?>
