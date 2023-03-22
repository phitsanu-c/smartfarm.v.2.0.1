<?php
    require '../../phpMQTT.php';
    $host = '203.150.37.144';     // change if necessary
    $port = 1883;                     // change if necessary
    $username = '';                   // set your username
    $password = '';                   // set your password

    $mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());
    if ($mqtt->connect(true,NULL,$username,$password)) {
        $sn = $_POST['sn'];
        if(isset($_POST['mode'])){
            if($_POST['mode'] == "Timer"){
                $mqtt->publish($sn.'/control/loads/user_control', $_POST['user'], 1);
                $mqtt->publish($sn.'/control/loads_auto/'.$_POST['load'], $_POST['status'], 1);
            }else{
                $load = json_decode($_POST['load']);
                $status = json_decode($_POST['status']);
                $mqtt->publish($sn.'/control/loads/user_control', $_POST['user'], 1);
                for($i = 0; $i < count($load); $i++){
                    $mqtt->publish($sn.'/control/loads_auto/'.$load[$i], $status[$i], 1); 
                }
            }
        }else{
            $mqtt->publish($sn.'/control/loads/user_control', $_POST['user'], 1);
            $mqtt->publish($sn.'/control/loads_auto/'.$_POST['load'], $_POST['status'], 1); 
        }
    }
    $mqtt->close();