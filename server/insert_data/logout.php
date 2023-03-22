<?php
    require "connectdb.php";
    $decodedJson = json_decode($_POST['arr_'], true);
    $userID = $_POST['userID'];
    $siteID = $_POST['siteID'];
    if($_POST['count_site'] == 1){
        $jog_login = [
            'dt' => date("Y-m-d").' '.date("H:i:s"),
            'userID'    => $userID,
            'status'    => 'ออกจากระบบ',
            'siteID'    => $siteID
        ];
        // echo json_encode($jog_login);
        // exit();
        if ($dbcon->prepare("INSERT INTO `tbn_login_log`( `logLogin_timestamp`, `logLogin_UserID`, `logLogin_status`, `logLogin_siteID`) VALUES (:dt, :userID, :status, :siteID)")->execute($jog_login) === TRUE) {}
    }
    if ($dbcon->prepare("DELETE FROM `tbn_login_re` WHERE `re_userID`= $userID")->execute() === TRUE) {}
    unset($decodedJson[$userID]);
    if(count($decodedJson) == 0){$message = json_encode(0);}else {$message = $decodedJson; }

    echo json_encode($message);
    exit();
