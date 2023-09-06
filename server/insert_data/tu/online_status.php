<?php
require '../../phpMQTT.php';
$host = '203.154.83.117';     // change if necessary
$port = 4563;                     // change if necessary
$username = '';                   // set your username
$password = '';                   // set your password

$mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());
if ($mqtt->connect(true,NULL,$username,$password)) {
    for ($i=1; $i <= 8; $i++) {
        $house_master = 'TUSMT00'.$i;
        $data_mq = $mqtt->subscribeAndWaitForMessage($house_master."/control/response", 1);
        $decodedJson = json_decode(substr($data_mq, 2), true);
        // echo json_encode($decodedJson);
        // echo $decodedJson['serial_id'];
        // exit();
        if($decodedJson['mode'] == 'Auto'){
            $mqtt->publish($house_master.'/control/loads_auto/dripper_1', $decodedJson['dripper_1'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/dripper_2', $decodedJson['dripper_2'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/dripper_3', $decodedJson['dripper_3'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/dripper_4', $decodedJson['dripper_4'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/fan_1',     $decodedJson['fan_1'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/fan_2',     $decodedJson['fan_2'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/fan_3',     $decodedJson['fan_3'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/fan_4',     $decodedJson['fan_4'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/foggy_1',   $decodedJson['foggy_1'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/foggy_2',   $decodedJson['foggy_2'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/spray',     $decodedJson['spray'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/shading',   $decodedJson['shading'], 1);
        }
        else { // manual
            $mqtt->publish($house_master.'/control/loads/shading',      $decodedJson['shading'], 1);
        }
    }
}
$mqtt->close();
?>
