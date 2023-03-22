<?php
require "../connectdb.php";
$user_id = $_SESSION['account_id'];
$houseID = $_GET["houseID"];
    echo '<option value="0">เลือกผู้ใช้งาน</option>';
    if ($_SESSION["sn"]['account_status'] == 1) {
        $stmtUser = $dbcon->prepare("SELECT * FROM tbn_userst INNER JOIN tbn_account ON tbn_userst.userST_accountID = tbn_account.account_id WHERE userST_houseID != '$houseID' GROUP BY userST_accountID");
    } else {
        $stmtUser = $dbcon->prepare("SELECT * FROM tbn_userst INNER JOIN tbn_account ON tbn_userst.userST_accountID = tbn_account.account_id WHERE userST_main='$user_id' AND userST_houseID != '$houseID' GROUP BY userST_accountID");
    }
    $stmtUser->execute();
    while ($rowUser = $stmtUser->fetch(PDO::FETCH_BOTH)) {
        if($rowUser["userST_level"] != 1 || $rowUser["userST_houseID"] != $houseID){
            echo '<option value="'.$rowUser["account_id"].'">'.$rowUser["account_user"].'</option>';
        }
    }
