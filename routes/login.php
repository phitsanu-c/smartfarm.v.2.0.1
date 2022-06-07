<?php
// session_start();
require "connectdb.php";
require 'tu/phpMQTT.php';
$host = '203.150.37.144';     // change if necessary
$port = 1883;                     // change if necessary
$username = '';                   // set your username
$password = '';                   // set your password
$topic = "web_system";
$mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());
//
$decodedJson=[];
if ($mqtt->connect(true,NULL,$username,$password)) {
    $data_mq = $mqtt->subscribeAndWaitForMessage($topic, 1);
    if(substr($data_mq, 2) != "0"){
        $decodedJson = json_decode(substr($data_mq, 2), true);
        if(isset($_SESSION['account_id'])){
            if(isset($decodedJson[$_SESSION['account_id']]['account_id'])){
                if($decodedJson[$_SESSION['account_id']]['account_id'] == $_SESSION['account_id']){
                    if($decodedJson[$_SESSION['account_id']]['dt'] <= date("Y-m-d").' '.date("H:i:s")){
                        session_destroy();
                    }
                }
            }else {
                session_destroy();
            }
        }
    }

    // print_r($decodedJson);
    // exit();
    if (isset($_POST['name'])) {
        // if (isset($_POSTname["mode_user"])) {
        // $mode_user = $_POST["mode_user"];
        $username = $_POST['name'];
        $password = $_POST['pass'];
        // echo $username." and ".$password." and ".$_POST["status"];
        // exit();
        //เข้ารหัส รหัสผ่าน
        $salt = 'tikde78uj4ujuhlaoikiksakeidke';
        $new_password = hash_hmac('sha256', $password, $salt);
        // echo $new_password;exit();
        if ($_POST["status"] == "user") {
            $query = $dbcon->prepare("SELECT * FROM tbn_account WHERE account_user = '$username' AND account_pass = '$new_password' ");
        }else{
            $query = $dbcon->prepare("SELECT * FROM tbn_account WHERE account_email = '$username' AND account_pass = '$new_password' ");
        }
        $query->execute();
        $row_count = $query->fetch(PDO::FETCH_BOTH);
        // echo $count_User["login_id"];
        if ($row_count == false) {
            echo json_encode(['name_login'  => "No user"], JSON_UNESCAPED_UNICODE);
            exit();
        } elseif ($row_count["account_id"] > 0) {
            $account_id = $row_count["account_id"];
            if(substr($data_mq, 2) != 0){
                $check_ulogin = $dbcon->query("SELECT COUNT(`fe_id`) FROM `tbn_login_re` WHERE `re_userID`='$account_id'")->fetch();
                if($check_ulogin[0] >= 1){
                    echo json_encode(['name_login'  => "already logged in", 'a'=>$check_ulogin], JSON_UNESCAPED_UNICODE);
                    exit();
                }
            }
            if($row_count["account_status"] != 1){ // != supperadmin
                 // mqsql v.8 $rowc = $dbcon->query("SELECT `userST_siteID`, house_master, ROW_NUMBER() OVER(PARTITION BY `userST_accountID`) AS count_site FROM `tbn_userst` INNER JOIN `tbn_house` ON tbn_userst.userST_houseID = tbn_house.house_id WHERE `userST_accountID`=$account_id GROUP BY `userST_accountID`, `userST_siteID` ORDER BY count_site DESC LIMIT 1")->fetch(); // INNER JOIN tbn_house ON tbn_userst.userST_houseID = tbn_house.house_id WHERE `userST_accountID`='$account_id' GROUP BY SET
                // $zz = "";
                // $zz = "SET @row_number = 0; SELECT `userST_siteID`, house_master, (@row_number:=@row_number + 1) AS count_site FROM `tbn_userst` INNER JOIN `tbn_house` ON tbn_userst.userST_houseID = tbn_house.house_id WHERE `userST_accountID`=$account_id GROUP BY `userST_accountID`, `userST_siteID` ORDER BY count_site DESC LIMIT 1";
                $rowc = $dbcon->query("SELECT `userST_siteID`, house_master, (SELECT count(*) FROM `tbn_userst` WHERE `userST_accountID`=$account_id ) AS count_site FROM `tbn_userst` INNER JOIN `tbn_house` ON tbn_userst.userST_houseID = tbn_house.house_id WHERE `userST_accountID`=$account_id GROUP BY `userST_accountID`, `userST_siteID` ORDER BY count_site DESC LIMIT 1")->fetch();
                // print_r($rowc['count_site']);exit();
                if($rowc['count_site'] == 1 ){ // 1 Site chack house
                    $userST_siteID = $rowc['userST_siteID'];
                    $check_uslogin = $dbcon->query("SELECT COUNT(`fe_id`) FROM `tbn_login_re` WHERE `re_siteID`='$userST_siteID'")->fetch();
                    if($check_uslogin[0] > 10){
                        echo json_encode(['name_login'  => "site > 10"], JSON_UNESCAPED_UNICODE);
                        exit();
                    }
                    $rowc2 = $dbcon->query("SELECT COUNT('userST_houseID') FROM `tbn_userst` WHERE `userST_accountID`='$account_id' AND userST_siteID = '$userST_siteID'")->fetch();
                    if($rowc2[0] == 1){ // == 1 Site  1 house
                        $_SESSION["sn"] = array('count_site' => $rowc['count_site'], 'count_house' => $rowc2[0], 'siteID' => $userST_siteID, 'master' => $rowc['house_master'], 'en_url' => encode($userST_siteID.','.$rowc['house_master']), 'account_status'=>$row_count["account_status"] );
                    }else{ // == 1 Site  > 1 house
                        $_SESSION["sn"] = array('count_site' => $rowc['count_site'], 'count_house' => $rowc2[0], 'siteID' => $userST_siteID, 'en_url' => encode($userST_siteID.','), 'account_status'=>$row_count["account_status"] );
                    }
                    // print_r($_SESSION["sn"]);exit();
                    $log_login = [
                        'dt'   => date("Y-m-d").' '.date("H:i:s"),
                        'userID'  => $account_id,
                        'status'  => 'เข้าสู่ระบบ',
                        'siteID'  => $userST_siteID
                    ];
                    // echo date("Y-m-d").' '.date("H:i");
                    // exit();
                    if ($dbcon->prepare("INSERT INTO `tbn_login_log`( `logLogin_timestamp`, `logLogin_UserID`, `logLogin_status`, `logLogin_siteID`) VALUES (:dt, :userID, :status, :siteID)")->execute($log_login) === TRUE) {}
                }else{ // > 1 Site
                    $_SESSION["sn"] = array('count_site' => $rowc['count_site'], 'count_house' => '', 'siteID' =>'', 'account_status'=>$row_count["account_status"]);
                }
            }
            else{ // = supperadmin
                $_SESSION["sn"] = array('count_site' => '', 'count_house' => '', 'siteID' =>'', 'account_status'=>$row_count["account_status"]);
            }
            $_SESSION['account_id'] = $account_id;
            $_SESSION["account_user"] = $row_count['account_user'];
            // $_SESSION["account_status"] = $row_count["login_status"];
            $_SESSION["login_theme"] = $row_count["account_theme"];
            // $_SESSION["time"] = date("d");
            if ($row_count["account_img"] === "") {
                $_SESSION["account_img"] = "user.png";
            } else {
                $_SESSION["account_img"] = $row_count["account_img"];
            }
            $_SESSION["account_email"] = $row_count["account_email"];
            $_SESSION["account_tel"] = $row_count["account_tel"];
            $log_re = [
                'dt'   => date("Y-m-d").' '.date("H:i:s", strtotime('3 minute')),
                'userID'  => $_SESSION['account_id'],
                'siteID'  => $_SESSION['sn']['siteID']
            ];
           // if ($dbcon->prepare("INSERT INTO `tbn_login_re`(`re_datetime`, `re_userID`, `re_siteID`) VALUES (:dt, :userID, :siteID)")->execute($log_re) === TRUE) {}
        }
    }

    if (isset($_POST['logout'])) {
        $userID = $_SESSION['account_id'];
        if($_SESSION['sn']['count_site'] == 1){
            $jog_login = [
                'dt' => date("Y-m-d").' '.date("H:i:s"),
                'userID'    => $userID,
                'status'    => 'ออกจากระบบ',
                'siteID'    => $_SESSION["sn"]['siteID']
            ];
            // echo json_encode($jog_login);
            // exit();
            if ($dbcon->prepare("INSERT INTO `tbn_login_log`( `logLogin_timestamp`, `logLogin_UserID`, `logLogin_status`, `logLogin_siteID`) VALUES (:dt, :userID, :status, :siteID)")->execute($jog_login) === TRUE) {}
        }
        if ($dbcon->prepare("DELETE FROM `tbn_login_re` WHERE `re_userID`= $userID")->execute() === TRUE) {}
        unset($decodedJson[$_SESSION['account_id']]);
        if(count($decodedJson) == 0){$message = json_encode(0);}else {$message = json_encode($decodedJson); }
        $mqtt->publish($topic,$message, 1);
        $mqtt->close();
        session_destroy();
        echo json_encode("logout_succress");
        exit();
    }

    if (isset($_SESSION["account_user"])) {
        $new_dt = ['account_id' => $_SESSION['account_id'], 'dt' => date("Y-m-d").' '.date("H:i:s", strtotime('30 minute')), 'name_login' => $_SESSION["account_user"],'email' => $_SESSION["account_email"]]; // '-6 hour'));
        // if(substr($data_mq, 2) == "0"){
        //     $decodedJson[$_SESSION['account_id']] = $new_dt;
        // }else {
            $decodedJson[$_SESSION['account_id']] = $new_dt;
            // echo json_encode($decodedJson);
            // var_dump($decodedJson);
            // $decoded_json = json_decode($data_mq, true);
            // $decode_data = json_decode($data_mq);
            // foreach($decode_data as $key=>$value){
            //         print_r($value);
            // }
        // }
        $message = json_encode($decodedJson);
        $mqtt->publish($topic,$message, 1);
        $mqtt->close();
        // }else{
        //     echo "Fail or time out";

        echo json_encode([
            'account_id'       => $_SESSION['account_id'],
            'name_login'      => $_SESSION["account_user"],
            // 'status'        => $_SESSION["login_status"],
            'image'         => $_SESSION["account_img"],
            // 'date_start'    => $_SESSION["time"],
            // 'count_house'   => $_SESSION['count_house'],
            // 'master'        => $_SESSION['master'],
            // 'count_statusUser' => $_SESSION['count_statusUser'],
            'theme' => $_SESSION["login_theme"],
            'email' => $_SESSION["account_email"],
            'tel' => $_SESSION["account_tel"],
            'sn'  => $_SESSION["sn"],
            'c'=>$decodedJson
        ], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(['name_login'  => ""]);
    }
}

function encode($string){
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($string . 'zasn'));
}
