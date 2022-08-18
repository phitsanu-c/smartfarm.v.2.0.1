<?php
    require "connectdb.php";
    $siteID = $_GET["siteID"];
    $userID = $_SESSION['account_id'];
    if(!isset($_GET['us'])){
        echo '<option value="">เลือกโรงเรือน</option>';
        echo '<option value="0">ทุกโรงเรือน</option>';
    }
    if ($_SESSION["sn"]['account_status'] == 1){
        $house_stmt = $dbcon->prepare("SELECT * FROM tbn_house WHERE house_siteID ='$siteID' ");
    }else {
        $house_stmt = $dbcon->prepare("SELECT * FROM tbn_userst INNER JOIN tbn_house ON tbn_userst.userST_houseID = tbn_house.house_id WHERE userST_accountID = '$userID' AND house_siteID ='$siteID' ");
    }
    $house_stmt->execute();
    while ($row_house = $house_stmt->fetch(PDO::FETCH_BOTH)) {
        echo '<option value="'.$row_house["house_id"].'">'.$row_house["house_name"].'</option>';
    } ?>
