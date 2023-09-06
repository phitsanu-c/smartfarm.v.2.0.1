<?php
    require "../connectdb.php";
    // $json = json_djson_encodeecode($_POST['output']);
    // $json2 = json_decode($_POST['submode']);
    // echo json_encode($json);
    // echo $json['serial_id'];
    // echo $_POST['submode'];
    // echo $_POST['output'];
    // echo $json;
    function toArray($data) {
        if (is_object($data)) $data = get_object_vars($data);
        return is_array($data) ? array_map(__FUNCTION__, $data) : $data;
    }
    $json = toArray (json_decode($_POST['output']));

    // echo json_encode($newData['serial_id']);
    // exit();

    if($_POST['mode'] == 'Manual'){
        $submode = 'Manual';
    }elseif($_POST['mode'] == 'Auto'){
        require '../../phpMQTT.php';
        $host = '203.154.83.117';     // change if necessary
        $port = 4563;                     // change if necessary
        $username = '';                   // set your username
        $password = '';                   // set your password

        $mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());
        if ($mqtt->connect(true,NULL,$username,$password)) {
            sleep(1); // $_POST['load']
            $decode = json_decode(substr($mqtt->subscribeAndWaitForMessage($json['serial_id'].'/control/set_config', 1), 2), true);
            if($decode['sub_mode']['sub_mode'] == "Timer"){
                if(($_POST['channel'] < 5) || ($_POST['channel'] > 8 && $_POST['channel'] < 12)){
                    if($decode['sub_mode']['sub_mode_'.$_POST['channel']] == 'Time_set'){
                        $submode = 'Time_set';
                    }else{
                        $submode = 'Time_loop';
                    }
                }else{ // 5 6 7 8 11 12
                    $submode = 'Time_set';
                }


            }else{
                $submode = 'tracking';
            }
        }
        $mqtt->close();
    }else{
        $submode = 'เปลี่ยนโหมด';
    }

    // echo $submode;
    // exit();
    $data = [
        // 'time1' => date("Y-m-d H:i:s"),
        // 'time_d' => date("Y-m-d H:i:s", strtotime('-1 second')),
        'sn' => $json['serial_id'],
        'mode' => $json['mode'],
        'sub' => $submode,
        'user' => $json['user_control'],
        'l_1' => $json['dripper_1'],
        'l_2' => $json['dripper_2'],
        'l_3' => $json['dripper_3'],
        'l_4' => $json['dripper_4'],
        'l_5' => $json['fan_1'],
        'l_6' => $json['fan_2'],
        'l_7' => $json['fan_3'],
        'l_8' => $json['fan_4'],
        'l_9' => $json['foggy_1'],
        'l_10' => $json['foggy_2'],
        'l_11' => $json['spray'],
        'l_12' => $json['shading']
    ];
    // echo json_encode($data);
    // exit();
    // `cn_timestamp`,  :time_d,
    $sql = "INSERT INTO `tbn_control_log`
       ( `cn_sn`, `cn_mode`, `cn_submode`, `cn_user`,
        `cn_load_1`, `cn_load_2`, `cn_load_3`, `cn_load_4`, `cn_load_5`, `cn_load_6`,
        `cn_load_7`, `cn_load_8`, `cn_load_9`, `cn_load_10`, `cn_load_11`, `cn_load_12`) VALUES (
            :sn, :mode, :sub, :user,
            :l_1, :l_2, :l_3, :l_4, :l_5, :l_6,
            :l_7, :l_8, :l_9, :l_10, :l_11, :l_12)";
    if ($dbcon->prepare($sql)->execute($data) === TRUE) {
        echo json_encode(['status' => "OK",'data' => "Insert_Success" ], JSON_UNESCAPED_UNICODE );
    }else{
        echo json_encode(['status' => 'Error','data' => "Insert_Error"] , JSON_UNESCAPED_UNICODE );
    }
