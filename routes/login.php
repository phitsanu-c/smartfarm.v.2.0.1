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
    
    $_SESSION["account_email"] = $row_count["account_email"];
    $_SESSION["account_tel"] = $row_count["account_tel"];
    if($row_count["account_status"] != 1){
        $rowc = $dbcon->query("SELECT COUNT('userST_accountID') FROM `tbn_userst` WHERE `userST_accountID`='$account_id'")->fetch();
        // $rwcstu = $dbcon->query("SELECT COUNT('userST_id') FROM `tb_userST` WHERE `userST_accountID`='$account_id' AND userST_user_status=2")->fetch();
        $_SESSION['count_statusUser'] = $rowc[0];
        if($rowc[0] == 1 ){
            $row_ms = $dbcon->query("SELECT house_master FROM `tbn_userst`INNER JOIN tbn_house ON tbn_userst.userST_houseID = tbn_house.house_id WHERE `userST_accountID`='$account_id'")->fetch(); 
            $_SESSION["sn"] = $row_ms[0];
        }else{
            $_SESSION["sn"] = "";
        }
    }else{
        // $rowc = $dbcon->query("SELECT COUNT(`site_id`) FROM tb2_site ")->fetch();
        $_SESSION['count_statusUser'] = "supperadmin";
        $_SESSION["sn"] = "";
    }
    // $_SESSION['count_house'] = $rowc[0];
    // if($rowc[0] == 1){
    //     $_SESSION['master'] = $dbcon->query("SELECT site_name, house_master, house_name FROM `tb3_userst`
    //     INNER JOIN tb2_login ON tb3_userst.userST_loginID = tb2_login.login_id 
    //     INNER JOIN tb2_site ON tb3_userst.userST_siteID = tb2_site.site_id 
    //     INNER JOIN tb2_house ON tb3_userst.userST_houseID = tb2_house.house_id WHERE tb3_userst.userST_loginID = '$login_userid' ")->fetch();
    // }else{$_SESSION['master'] = '';}
    // } elseif ($mode_user == "email") { //login email_mode


    // }
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
        'count_statusUser' => $_SESSION['count_statusUser'],
        'theme' => $_SESSION["login_theme"],
        'email' => $_SESSION["account_email"],
        'tel' => $_SESSION["account_tel"],
        'sn'  => $_SESSION["sn"]
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(['name_login'  => ""]);
}
