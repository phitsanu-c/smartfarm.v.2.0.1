<?php
    require "../connectdb.php";

    $house_master = $_POST["house_master"];
    $log_sw = $_POST["log_sw"];
    $row = $dbcon->query("SELECT * FROM `tbn_control_mn_log` WHERE `mn_sn`= '$house_master' ORDER BY `mn_id` DESC LIMIT 1")->fetch();
    $data = [
        'dripper_1' => $row['mn_load_1'],
        'dripper_2' => $row['mn_load_2'],
        'dripper_3' => $row['mn_load_3'],
        'dripper_4' => $row['mn_load_4'],
        'fan_1'     => $row['mn_load_5'],
        'fan_2'     => $row['mn_load_6'],
        'fan_3'     => $row['mn_load_7'],
        'fan_4'     => $row['mn_load_8'],
        'foggy_1'   => $row['mn_load_9'],
        'foggy_2'   => $row['mn_load_10'],
        'spray'     => $row['mn_load_11'],
        'shading'   => $row['mn_load_12']
    ];
    if($log_sw['mode'] == 1){
        $data['dripper_1'] = $log_sw['sw_1'];
        $data['dripper_2'] = $log_sw['sw_2'];
        $data['dripper_3'] = $log_sw['sw_3'];
        $data['dripper_4'] = $log_sw['sw_4'];
    }elseif ($log_sw['mode'] == 2){
        $data['fan_1'] = $log_sw['sw_1'];
        $data['fan_2'] = $log_sw['sw_2'];
        $data['fan_3'] = $log_sw['sw_3'];
        $data['fan_4'] = $log_sw['sw_4'];
    }elseif ($log_sw['mode'] == 3){
        $data['foggy_1'] = $log_sw['sw_1'];
        $data['foggy_2'] = $log_sw['sw_2'];
    }
    $data2 = $data;
    if($log_sw['mode'] < 4){
        $data["load_sn"] = $house_master;
        $data["losd_user"] = $_SESSION["account_user"];
        $sql = "INSERT INTO `tbn_control_mn_log`(`mn_sn`, `mn_user`,
                        `mn_load_1`, `mn_load_2`, `mn_load_3`, `mn_load_4`, `mn_load_5`, `mn_load_6`,
                        `mn_load_7`, `mn_load_8`, `mn_load_9`, `mn_load_10`, `mn_load_11`, `mn_load_12`)
                VALUES (:load_sn, :losd_user,
                        :dripper_1, :dripper_2, :dripper_3, :dripper_4,
                        :fan_1, :fan_2, :fan_3, :fan_4,
                        :foggy_1, :foggy_2, :spray, :shading)";
        if ($dbcon->prepare($sql)->execute($data) === TRUE) {
            echo json_encode(['status' => "Insert_Success", 'data' => $data2 ], JSON_UNESCAPED_UNICODE );
        }else{
            echo json_encode(['status' => "Insert_Error ".$tb_name, 'data' => '' ], JSON_UNESCAPED_UNICODE );
        }
    }
