<?php
    // session_start();
    require "../connectdb.php";

    $house_master = $_POST["house_master"];
    $row_1 = $dbcon->query("SELECT * FROM tbn_house INNER JOIN tbn_site ON tbn_house.house_siteID = tbn_site.site_id WHERE house_master = '$house_master'")->fetch();
    // $row_2 = $dbcon->query("SELECT * FROM tb3_dashstatus WHERE dashstatus_sn = '$house_master'")->fetch();
    // $row_3 = $dbcon->query("SELECT * FROM tb3_controlstatus WHERE 	controlstatus_sn = '$house_master'")->fetch();

    $controlstatus[1] = 1;
    $controlstatus[2] = 1;
    $controlstatus[3] = 1;
    $controlstatus[4] = 1;
    $controlstatus[5] = 1;
    // $controlstatus[6] = intval($row_3["controlstatus_6"]);
    // $controlstatus[7] = intval($row_3["controlstatus_7"]);
    // $controlstatus[8] = intval($row_3["controlstatus_8"]);
    // $controlstatus[9] = intval($row_3["controlstatus_9"]);
    // $controlstatus[10] = intval($row_3["controlstatus_10"]);
    // $controlstatus[11] = intval($row_3["controlstatus_11"]);
    // $controlstatus[12] = intval($row_3["controlstatus_12"]);
    //
    $row_4 = $dbcon->query("SELECT * FROM tbn_set_maxmin WHERE set_maxmin_sn = '$house_master'")->fetch();
    $set_maxmin = [
        'Tmin' => $row_4["set_Tmin"],
        'Tmax' => $row_4["set_Tmax"],
        'Hmin' => $row_4["set_Hmin"],
        'Hmax' => $row_4["set_Hmax"],
        'Lmin' => $row_4["set_Lmin"],
        'Lmax' => $row_4["set_Lmax"],
        'Smin' => $row_4["set_Smin"],
        'Smax' => $row_4["set_Smax"]
    ];
    $row_5 = $dbcon->query("SELECT * FROM tb_sensor");
    foreach ($row_5 as $row_) {
        $sensor[] = $row_;
    }
    $account_id = $_SESSION['account_id'];
    $houseID = $row_1['house_id'];
    if($_SESSION['account_status'] > 2){
        $row_6 = $dbcon->query("SELECT `userST_level` FROM `tbn_userst` WHERE `userST_accountID`=$account_id AND `userST_houseID`=$houseID")->fetch();
        $account_status = $row_6['userST_level'];
    }else {
        $account_status = $_SESSION['account_status'];
    }
    echo json_encode([
        'account_user' => $_SESSION["account_user"],
        's_master'=> $row_1,
        'config_sn'=> [
            'sn_status_1' => 1,
            'sn_status_2' => 1,
            'sn_status_3' => 1,
            'sn_status_4' => 1,
            'sn_status_5' => 1,
            'sn_status_6' => 1,
            'sn_status_7' => 1,
            'sn_status_8' => 1,
            'sn_imgMap_1' => '',
            'sn_imgMap_2' => '',
            'sn_imgMap_3' => '',
            'sn_imgMap_4' => '',
            'sn_imgMap_5' => '',
            'sn_imgMap_6' => '',
            'sn_imgMap_7' => '',
            'sn_imgMap_8' => '',
            'sn_sensor_1' => 1,
            'sn_sensor_2' => 2,
            'sn_sensor_3' => 4,
            'sn_sensor_4' => 1,
            'sn_sensor_5' => 2,
            'sn_sensor_6' => 4,
            'sn_sensor_7' => 3,
            'sn_sensor_8' => 3,
            'sn_name_1' => 'อุณหภูมินอกโรงเรือน',
            'sn_name_2' => 'ความชื้นนอกโรงเรือน',
            'sn_name_3' => 'ความเข้มแสงนอกโรงเรือน',
            'sn_name_4' => 'อุณหภูมิในโรงเรือน',
            'sn_name_5' => 'ความชื้นในโรงเรือน',
            'sn_name_6' => 'ความเข้มแสงในโรงเรือน',
            'sn_name_7' => 'ความชื้นดิน 1',
            'sn_name_8' => 'ความชื้นดิน 2',
            'sn_channel_1' => 'dataST_2_3',
            'sn_channel_2' => 'dataST_2_4',
            'sn_channel_3' => 'dataST_2_2',
            'sn_channel_4' => 'dataST_1_3',
            'sn_channel_5' => 'dataST_1_4',
            'sn_channel_6' => 'dataST_1_2',
            'sn_channel_7' => 'dataST_3_2',
            'sn_channel_8' => 'dataST_3_4',
        ],
        'config_cn'=> [
            'cn_status_1' => 1,
            'cn_status_2' => 1,
            'cn_status_3' => 1,
            'cn_status_4' => 1,
            'cn_status_5' => 1,
        ],
        'controlstatus'=> $controlstatus,
        'set_maxmin' => $set_maxmin,
        'sensor' => $sensor,
        'userLevel'=> $account_status
    ]);
