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
if ($mqtt->connect(true,NULL,$username,$password)) {
    $data_mq = $mqtt->subscribeAndWaitForMessage($topic, 1);

    if (isset($_POST['name'])) {
        $username = $_POST['name'];
        $password = $_POST['pass'];
        // echo $username." and ".$password." and ".$_POST["status"];
        // exit();
        //เข้ารหัส รหัสผ่าน
        $salt = 'tikde78uj4ujuhlaoikiksakeidke';
        $new_password = hash_hmac('sha256', $password, $salt);
        // echo $new_password;exit();
        if ($_POST["status"] == "user") {
            $query = $dbcon->query("SELECT *, COUNT('account_user') AS count_user FROM tbn_account WHERE account_user = '$username' AND account_pass = '$new_password' ");
        }else{
            $query = $dbcon->query("SELECT *, COUNT('account_user') AS count_user FROM tbn_account WHERE account_email = '$username' AND account_pass = '$new_password' ");
        }
        $row_count = $query->fetch();
        // echo $row_count['count_user']; exit();
        if ($row_count['count_user'] == 0) {
            echo json_encode(['name_login'  => "No user"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        $account_id = $row_count["account_id"];
        if(substr($data_mq, 2) != "0"){
            $decodedJson = json_decode(substr($data_mq, 2), true);
            if(isset($decodedJson[$account_id]['account_id'])){
                echo json_encode(['name_login'  => "already logged in"], JSON_UNESCAPED_UNICODE);
                exit();
            } else {
                $dbcon->prepare("DELETE FROM `tbn_login_re` WHERE `re_userID`= '$account_id'")->execute();
            }
        }
        // if(substr($data_mq, 2) != 0){
        //     $check_ulogin = $dbcon->query("SELECT COUNT(`fe_id`) FROM `tbn_login_re` WHERE `re_userID`='$account_id'")->fetch();
        //     if($check_ulogin[0] >= 1){
        //         echo json_encode(['name_login'  => "already logged in", 'a'=>$check_ulogin], JSON_UNESCAPED_UNICODE);
        //         exit();
        //     }
        // }// print_r($row_count['count_user']);exit();
        if($row_count["account_status"] != 1){ // != supperadmin
             // mqsql v.8 $rowc = $dbcon->query("SELECT `userST_siteID`, house_master, ROW_NUMBER() OVER(PARTITION BY `userST_accountID`) AS count_site FROM `tbn_userst` INNER JOIN `tbn_house` ON tbn_userst.userST_houseID = tbn_house.house_id WHERE `userST_accountID`=$account_id GROUP BY `userST_accountID`, `userST_siteID` ORDER BY count_site DESC LIMIT 1")->fetch(); // INNER JOIN tbn_house ON tbn_userst.userST_houseID = tbn_house.house_id WHERE `userST_accountID`='$account_id' GROUP BY SET
            // $zz = "SET @row_number = 0; SELECT `userST_siteID`, house_master, (@row_number:=@row_number + 1) AS count_site FROM `tbn_userst` INNER JOIN `tbn_house` ON tbn_userst.userST_houseID = tbn_house.house_id WHERE `userST_accountID`=$account_id GROUP BY `userST_accountID`, `userST_siteID` ORDER BY count_site DESC LIMIT 1";
            $rowc = $dbcon->query("SELECT `userST_siteID`, `house_master`, `house_webv`, (@s:=@s + 1) AS count_site FROM (SELECT @s:=0) as s, `tbn_userst` INNER JOIN `tbn_house` ON tbn_userst.userST_houseID = tbn_house.house_id WHERE `userST_accountID`=$account_id GROUP BY `userST_accountID`, `userST_siteID` ORDER BY `count_site` DESC LIMIT 1")->fetch();
            // print_r($rowc); echo $rowc['count_site'] ;exit();
            if($rowc['count_site'] == 1 ){ // 1 Site chack house
                $userST_siteID = $rowc['userST_siteID'];
                $check_uslogin = $dbcon->query("SELECT COUNT(`fe_id`) FROM `tbn_login_re` WHERE `re_siteID`='$userST_siteID'")->fetch();
                if($check_uslogin[0] > 10){
                    echo json_encode(['name_login'  => "site > 10"], JSON_UNESCAPED_UNICODE);
                    exit();
                }
                $rowc2 = $dbcon->query("SELECT COUNT('userST_houseID') FROM `tbn_userst` WHERE `userST_accountID`='$account_id' AND userST_siteID = '$userST_siteID'")->fetch();
                if($rowc2[0] == 1){ // == 1 Site  1 house
                    $_SESSION["sn"] = array('count_site' => $rowc['count_site'], 'count_house' => $rowc2[0], 'siteID' => $userST_siteID, 'master' => $rowc['house_master'], 'en_url' => encode($rowc['house_webv'].','.$userST_siteID.','.$rowc['house_master']), 'account_status'=>$row_count["account_status"] );
                }else{ // == 1 Site  > 1 house
                    $_SESSION["sn"] = array('count_site' => $rowc['count_site'], 'count_house' => $rowc2[0], 'siteID' => $userST_siteID, 'en_url' => encode($rowc['house_webv'].','.$userST_siteID.','), 'account_status' => $row_count["account_status"] );
                }
                $log_login = [
                    'dt'   => date("Y-m-d").' '.date("H:i:s"),
                    'userID'  => $account_id,
                    'status'  => 'เข้าสู่ระบบ',
                    'siteID'  => $userST_siteID
                ];
                // echo date("Y-m-d").' '.date("H:i");
                // exit();
                $dbcon->prepare("INSERT INTO `tbn_login_log`( `logLogin_timestamp`, `logLogin_UserID`, `logLogin_status`, `logLogin_siteID`) VALUES (:dt, :userID, :status, :siteID)")->execute($log_login);
            }else{ // > 1 Site
                $_SESSION["sn"] = array('count_site' => $rowc['count_site'], 'count_house' => '', 'siteID' =>'', 'account_status'=>$row_count["account_status"]);
            }
        }
        else{ // = supperadmin
            $_SESSION["sn"] = array('count_site' => '', 'count_house' => '', 'siteID' =>'', 'account_status'=>$row_count["account_status"]);
        }
        // print_r($_SESSION["sn"]);exit();
        $_SESSION['account_id'] = $account_id;
        $_SESSION["account_user"] = $row_count['account_user'];
        $_SESSION["login_theme"] = $row_count["account_theme"];
        $_SESSION["account_p"] = [$row_count['account_pass'],$row_count['account_pa']];
        if ($row_count["account_img"] == "") {
            $_SESSION["account_img"] = "user.png";
        } else {
            $_SESSION["account_img"] = $row_count["account_img"];
        }
        $_SESSION["account_email"] = $row_count["account_email"];
        $_SESSION["account_tel"] = $row_count["account_tel"];
        $_SESSION["account_status"] = $row_count["account_status"];
        $log_re = [
            'dt'   => date("Y-m-d").' '.date("H:i:s", strtotime('3 minute')),
            'userID'  => $_SESSION['account_id'],
            'siteID'  => $_SESSION['sn']['siteID']
        ];
        $dbcon->prepare("INSERT INTO `tbn_login_re`(`re_datetime`, `re_userID`, `re_siteID`) VALUES (:dt, :userID, :siteID)")->execute($log_re);
        $new_dt = ['account_id' => $_SESSION['account_id'], 'dt' => date("Y-m-d").' '.date("H:i:s", strtotime('31 minute')), 'siteID' => $_SESSION["sn"]['siteID'], 'count_site' => $_SESSION['sn']['count_site']]; // '-6 hour'));
        $decodedJson[$_SESSION['account_id']] = $new_dt;
        $message = json_encode($decodedJson);
        $mqtt->publish($topic,$message, 1);
        $mqtt->close();
        echo json_encode([
            'account_id'       => $_SESSION['account_id'],
            'name_login'      => $_SESSION["account_user"],
            'image'         => $_SESSION["account_img"],
            'theme' => $_SESSION["login_theme"],
            'email' => $_SESSION["account_email"],
            'tel' => $_SESSION["account_tel"],
            'sn'  => $_SESSION["sn"]
        ], JSON_UNESCAPED_UNICODE);
        exit();
    }

    if (isset($_POST['logout'])) {
        $decodedJson = json_decode(substr($data_mq, 2), true);
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
            $dbcon->prepare("INSERT INTO `tbn_login_log`( `logLogin_timestamp`, `logLogin_UserID`, `logLogin_status`, `logLogin_siteID`) VALUES (:dt, :userID, :status, :siteID)")->execute($jog_login);
        }
        $dbcon->prepare("DELETE FROM `tbn_login_re` WHERE `re_userID`= $userID")->execute();
        if(isset($decodedJson[$userID])){
            unset($decodedJson[$userID]);
            if(count($decodedJson) == 0){$message = json_encode(0);}else {$message = json_encode($decodedJson); }
            $mqtt->publish($topic,$message, 1);
            $mqtt->close();
            session_destroy();
            echo json_encode("logout_succress");
            exit();
        }else {
            session_destroy();
            echo json_encode("logout_succress");
            exit();
        }


    }

    if (isset($_SESSION["account_id"])) {
        if(substr($data_mq, 2) == "0"){
            session_destroy();
            echo json_encode(['name_login'  => ""]);
            exit();
        }

        $decodedJson = json_decode(substr($data_mq, 2), true);
        // print_r(array_keys($decodedJson));
        // exit();
        if(isset($decodedJson[$_SESSION['account_id']]['account_id'])){
            if($decodedJson[$_SESSION['account_id']]['dt'] <= date("Y-m-d").' '.date("H:i:s")){
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
                echo json_encode(['name_login'  => ""]);
                exit();
            }else {
                $new_dt = ['account_id' => $_SESSION['account_id'], 'dt' => date("Y-m-d").' '.date("H:i:s", strtotime('31 minute')), 'siteID' => $_SESSION["sn"]['siteID'], 'count_site' => $_SESSION['sn']['count_site']]; // '-6 hour'));
                $decodedJson[$_SESSION['account_id']] = $new_dt;
                $message = json_encode($decodedJson);
                $mqtt->publish($topic,$message, 1);
                $mqtt->close();
            }
        } else {
            session_destroy();
            echo json_encode(['name_login'  => ""]);
            exit();
        }

        echo json_encode([
            'account_id'       => $_SESSION['account_id'],
            'name_login'      => $_SESSION["account_user"],
            'image'         => $_SESSION["account_img"],
            'theme' => $_SESSION["login_theme"],
            'email' => $_SESSION["account_email"],
            'tel' => $_SESSION["account_tel"],
            'sn'  => $_SESSION["sn"]
        ], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(['name_login'  => ""]);
    }
}

function encode($string){
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($string . 'zasn'));
}
