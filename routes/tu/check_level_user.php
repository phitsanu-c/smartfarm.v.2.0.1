<?php
    require "connect_mqtt_uptime.php";

    $siteID = $_GET['siteID'];
    $house_master = $_GET["house_master"];
    $row_1 = $dbcon->query("SELECT house_id FROM tbn_house WHERE house_master = '$house_master'")->fetch();

    $row_ = $dbcon->query("SELECT count(re_id) FROM tbn_login_re WHERE re_siteID = '$siteID' AND re_level = 2")->fetch();
    $account_id = $_SESSION['account_id'];
    $houseID = $row_1['house_id'];
    if($_SESSION['account_status'] > 2){
        $row_6 = $dbcon->query("SELECT `userST_level` FROM `tbn_userst` WHERE `userST_accountID`=$account_id AND `userST_houseID`=$houseID")->fetch();
        $account_status = $row_6['userST_level'];
    }else {
        $account_status = $_SESSION['account_status'];
    }
    echo json_encode(['count_level' => $row_[0], 'user_level' => $account_status]);
    // echo json_encode($house_master);
