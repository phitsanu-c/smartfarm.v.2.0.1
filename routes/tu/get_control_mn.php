<?php
    require "../connectdb.php";
    require 'phpMQTT.php';
    $host = '203.150.37.144';     // change if necessary
    $port = 1883;                     // change if necessary
    $username = '';                   // set your username
    $password = '';                   // set your password
    $topic = "web_system";
    $mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());
    //
    if ($mqtt->connect(true,NULL,$username,$password)) {
        $data_mq = $mqtt->subscribeAndWaitForMessage($topic, 1);
        $decodedJson = json_decode(substr($data_mq, 2), true);
        $new_dt = ['account_id' => $_SESSION['account_id'], 'name' => $_SESSION["account_user"], 'dt' => date("Y-m-d H:i:s", strtotime('3 hour')), 'siteID' => $_SESSION["sn"]['siteID'], 'count_site' => $_SESSION['sn']['count_site']]; // '-6 hour'));
        $decodedJson[$_SESSION['account_id']] = $new_dt;
        $message = json_encode($decodedJson);
        $mqtt->publish($topic,$message, 1);
        $mqtt->close();
    }

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
