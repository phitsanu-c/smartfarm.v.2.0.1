<?php
require '../tu/phpMQTT.php';
$host = '203.154.83.117';     // change if necessary
$port = 4563;                   // change if necessary
$username = '';                   // set your username
$password = '';                   // set your password
// echo $_POST['topic2'].'<br>'.$_POST['user'].'<br>'.$_POST['topic'].'<br>'.$_POST['mess'];
// exit();
// $topic = $_POST['topic'];
$mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());
//
if ($mqtt->connect(true,NULL,$username,$password)) {
    $mqtt->publish($_POST['topic2'], $_POST['user'], 1);
    // $mqtt->close();

    $mqtt->publish($_POST['topic'], $_POST['mess'], 1);
    $mqtt->close();
    echo "succress";
}
