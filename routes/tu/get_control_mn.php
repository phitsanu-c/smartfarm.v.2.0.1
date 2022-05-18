<?php
    require "../connectdb.php";

    $house_master = $_POST["house_master"];
    $config_cn = $_POST["config_cn"];
    // echo $config_cn["cn_status_1"];
    // exit();

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
    echo json_encode($data);
