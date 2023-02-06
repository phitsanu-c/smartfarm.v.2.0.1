<?php
// session_start();
// require "connectdb.php";
require 'routes/tu/phpMQTT.php';
$host = '203.150.37.144';     // change if necessary
$port = 1883;                     // change if necessary
$username = '';                   // set your username
$password = '';                   // set your password
$topic = "Energy_Monitor/Ubon250K/notify/PM-ESS001";//"web_system";
$mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());
//
if ($mqtt->connect(true,NULL,$username,$password)) {
    $data_mq = $mqtt->subscribeAndWaitForMessage($topic, 1);
    // echo json_encode($data_mq);
    echo $data_mq;
    // $mqtt->publish($topic,0, 1);
    // $mqtt->close();
}

function encode($string){
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($string . 'zasn'));
}
