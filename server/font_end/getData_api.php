<?php
    require 'phpMQTT.php';
    $host = '192.168.1.86';     // change if necessary
    $port = 1883;                     // change if necessary
    $username = '';                   // set your username
    $password = '';                   // set your password

    $mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());
    if ($mqtt->connect(true,NULL,$username,$password)) {
        // $data_mq = $mqtt->subscribeAndWaitForMessage($house_master."/control/response", 1);
        // $decodedJson = json_decode(substr($data_mq, 2), true);
        
        $url = [
            "http://agritronics.nstda.or.th/ws/get.php?appkey=0c5a295bd8c07a083b41134ef5e6&p=W2G-999,4096,1",
            "http://agritronics.nstda.or.th/ws/get.php?appkey=0c5a295bd8c07a083b41134ef5e6&p=W2G-999,4096,2",
            "http://agritronics.nstda.or.th/ws/get.php?appkey=0c5a295bd8c07a083b41134ef5e6&p=W2G-999,4096,4",
            "http://agritronics.nstda.or.th/ws/get.php?appkey=0c5a295bd8c07a083b41134ef5e6&p=W2G-999,4096,5",
            "http://agritronics.nstda.or.th/ws/get.php?appkey=0c5a295bd8c07a083b41134ef5e6&p=W2G-999,4096,6",
            "http://agritronics.nstda.or.th/ws/get.php?appkey=0c5a295bd8c07a083b41134ef5e6&p=W2G-999,4096,8",
            "http://agritronics.nstda.or.th/ws/get.php?appkey=0c5a295bd8c07a083b41134ef5e6&p=W2G-999,4096,9"
        ];
        // $map_url = "http://agritronics.nstda.or.th/ws/get.php?appkey=0c5a295bd8c07a083b41134ef5e6&p=W2G-999,4096,1";
        // $xml   = simplexml_load_string(file_get_contents($url[0]), 'SimpleXMLElement', LIBXML_NOCDATA);
        // $array = json_decode(json_encode((array)$xml), TRUE);
        for($i=0; $i<7; $i++){
            $xml   = simplexml_load_string(file_get_contents($url[$i]), 'SimpleXMLElement', LIBXML_NOCDATA);
            $array = json_decode(json_encode((array)$xml), TRUE);
            $data_array[] = [
                'LastIODateTime' => $array['IO']["LastIODateTime"],
                'Name'           => $array['IO']["Name"],
                'Value'          => $array['IO']["LastValue"],
                'Unit'           => $array['IO']["Unit"],
            ];
        }
        // echo json_encode($array['IO']);
        // echo '<br><br>';
        // print_r($array['IO']['Name']);
        echo json_encode($data_array);
        $mqtt->publish('smartfarm/Ubon/environment/data_sensor', json_encode($data_array), 1);
    }
    