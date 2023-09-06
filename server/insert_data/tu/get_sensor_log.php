<?php
    require "../connectdb.php";


    $house_master = [
        'TUSMT001',
        'TUSMT002',
        'TUSMT003',
        'TUSMT004',
        'TUSMT005',
        'TUSMT006',
        'TUSMT007',
        'TUSMT008'
    ];//$_POST["house_master"];
    for($i = 0; $i < count($house_master); $i++){
        // $house_masters = $house_master[$i];
        // echo $house_master[$i];
        // exit();
        $stmt = $dbcon->query("SELECT * FROM tbn_sensor_log WHERE `sensor_log_id` IN (SELECT MAX(`sensor_log_id`) FROM tbn_sensor_log WHERE sensor_log_sn = '$house_master[$i]' GROUP BY `sensor_log_name`) ");
        foreach ($stmt as $row_) {
            $data2[$i][] = [
                'house_master' => $row_['sensor_log_sn'],
                'name'         => $row_['sensor_log_name'],
                'status'       => $row_['sensor_log_status']
            ];
        }
        $data[$row_['sensor_log_sn']] = $data2[$i];
    }
    // $control_log = [
    //     "serial_id" => $house_master,
    //     "mode"      => $row_cont_log['cn_mode'],
    //     "dripper_1" => $row_cont_log['cn_load_1'],
    //     "dripper_2" => $row_cont_log['cn_load_2'],
    //     "dripper_3" => $row_cont_log['cn_load_3'],
    //     "dripper_4" => $row_cont_log['cn_load_4'],
    //     "fan_1"     => $row_cont_log['cn_load_5'],
    //     "fan_2"     => $row_cont_log['cn_load_6'],
    //     "fan_3"     => $row_cont_log['cn_load_7'],
    //     "fan_4"     => $row_cont_log['cn_load_8'],
    //     "foggy_1"   => $row_cont_log['cn_load_9'],
    //     "foggy_2"   => $row_cont_log['cn_load_10'],
    //     "spray"     => $row_cont_log['cn_load_11'],
    //     "shading"   => $row_cont_log['cn_load_12'],
    //     "user_control" => $row_cont_log['cn_user']
    // ];
    echo json_encode($data);