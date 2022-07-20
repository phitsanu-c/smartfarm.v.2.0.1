<?php
    // session_start();
    require "../connectdb.php";

    $house_master = $_POST["house_master"];
    $row_1 = $dbcon->query("SELECT * FROM tbn_house INNER JOIN tbn_site ON tbn_house.house_siteID = tbn_site.site_id WHERE house_master = '$house_master'")->fetch();
    $row_2 = $dbcon->query("SELECT * FROM tbn_status_sn WHERE sn_status_an = '$house_master'")->fetch();
    $row_3 = $dbcon->query("SELECT * FROM tbn_status_cn WHERE cn_status_sn = '$house_master'")->fetch();

    $controlstatus[1] = intval($row_3["cn_status_1"]);
    $controlstatus[2] = intval($row_3["cn_status_2"]);
    $controlstatus[3] = intval($row_3["cn_status_3"]);
    $controlstatus[4] = intval($row_3["cn_status_4"]);
    $controlstatus[5] = intval($row_3["cn_status_5"]);
    $controlstatus[6] = intval($row_3["cn_status_6"]);
    $controlstatus[7] = intval($row_3["cn_status_7"]);
    $controlstatus[8] = intval($row_3["cn_status_8"]);
    $controlstatus[9] = intval($row_3["cn_status_9"]);
    $controlstatus[10] = intval($row_3["cn_status_10"]);
    $controlstatus[11] = intval($row_3["cn_status_11"]);
    $controlstatus[12] = intval($row_3["cn_status_12"]);

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
        +
        $account_status = $row_6['userST_level'];
    }else {
        $account_status = $_SESSION['account_status'];
    }
    echo json_encode([
        'account_user' => $_SESSION["account_user"],
        's_master'=> $row_1,
        'config_sn'=> $row_2,
        'config_cn'=> $row_3,
        'controlstatus'=> $controlstatus,
        'set_maxmin' => $set_maxmin,
        'sensor' => $sensor,
        'userLevel'=> $account_status,
        'h' => "SELECT `userST_level` FROM `tbn_userst` WHERE `userST_accountID`=$account_id AND `userST_houseID`=$houseID"
    ]);
