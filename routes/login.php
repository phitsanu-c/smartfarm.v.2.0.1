<?php
session_start();
require "connectdb.php";


if (isset($_POST['name'])) {
// if (isset($_POSTname["mode_user"])) {
//     $mode_user = $_POST["mode_user"];
    $username = $_POST['name'];
    $password = $_POST['pass'];
    // echo $username." and ".$password." and ".$_POST["status"];
    // exit();
    //เข้ารหัส รหัสผ่าน
    $salt = 'tikde78uj4ujuhlaoikiksakeidke';
    $new_password = hash_hmac('sha256', $password, $salt);
    // echo $new_password;exit();
    // if ($mode_user == "username") { //login user_mode
        
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
        $account_id = $_SESSION['account_id'] = $row_count["account_id"];
        $_SESSION["account_user"] = $row_count['account_user'];
        // $_SESSION["account_status"] = $row_count["login_status"];
        $_SESSION["login_theme"] = $row_count["account_theme"];
        // $_SESSION["time"] = date("d");
        if ($row_count["account_img"] === "") {
            $_SESSION["account_img"] = "user.png";
        } else {
            $_SESSION["account_img"] = $row_count["account_img"];
        }
    }
    
    function encode($string){
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($string . 'zasn'));
    }

    $_SESSION["account_email"] = $row_count["account_email"];
    $_SESSION["account_tel"] = $row_count["account_tel"];
    if($row_count["account_status"] != 1){ // != supperadmin
        $rowc = $dbcon->query("SELECT `userST_siteID`, house_master, ROW_NUMBER() OVER(PARTITION BY `userST_accountID`) AS count_site FROM `tbn_userst` INNER JOIN `tbn_house` ON tbn_userst.userST_houseID = tbn_house.house_id WHERE `userST_accountID`='$account_id' GROUP BY `userST_accountID`, `userST_siteID` ORDER BY count_site DESC LIMIT 1")->fetch(); // INNER JOIN tbn_house ON tbn_userst.userST_houseID = tbn_house.house_id WHERE `userST_accountID`='$account_id' GROUP BY userST_siteID 
        if($rowc['count_site'] == 1 ){ // 1 Site chack house
            $userST_siteID = $rowc['userST_siteID'];
            $rowc2 = $dbcon->query("SELECT COUNT('userST_houseID') FROM `tbn_userst` WHERE `userST_accountID`='$account_id' AND userST_siteID = '$userST_siteID'")->fetch();
            if($rowc2[0] == 1){ // 1 Site  1 house
                $_SESSION["sn"] = array('count_site' => $rowc['count_site'], 'count_house' => $rowc2[0], 'siteID' => $userST_siteID, 'master' => $rowc['house_master'], 'en_url' => encode($userST_siteID.','.$rowc['house_master']), 'account_status'=>$row_count["account_status"] );
            }else{ // 1 Site  > 1 house
                $_SESSION["sn"] = array('count_site' => $rowc['count_site'], 'count_house' => $rowc2[0], 'siteID' => $userST_siteID, 'en_url' => encode($userST_siteID.','), 'account_status'=>$row_count["account_status"] );
            }
        }else{ // > 1 Site
            $_SESSION["sn"] = array('count_site' => $rowc['count_site'], 'account_status'=>$row_count["account_status"]);
        }
    }else{ // = supperadmin
        $_SESSION["sn"] = array('count_site' => '', 'account_status'=>$row_count["account_status"]);
    }
}



if (isset($_POST['logout'])) {
    session_destroy();
    echo json_encode("logout_succress");
    exit();
}

if (isset($_SESSION["account_user"])) {           
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
        'sn'  => $_SESSION["sn"]
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(['name_login'  => ""]);
}
