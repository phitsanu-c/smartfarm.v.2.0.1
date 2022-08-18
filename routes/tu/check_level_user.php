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
        $new_dt = ['account_id' => $_SESSION['account_id'], 'name' => $_SESSION["account_user"], 'dt' => date("Y-m-d").' '.date("H:i:s", strtotime('3 hour')), 'siteID' => $_SESSION["sn"]['siteID'], 'count_site' => $_SESSION['sn']['count_site']]; // '-6 hour'));
        $decodedJson[$_SESSION['account_id']] = $new_dt;
        $message = json_encode($decodedJson);
        $mqtt->publish($topic,$message, 1);
        $mqtt->close();
        // echo json_encode($decodedJson);
    }
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
