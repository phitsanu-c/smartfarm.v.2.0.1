<?php
    // session_start();
    require "../connectdb.php";

    $house_master = $_POST["house_master"];
    // $channel = $_POST["channel"];
    $row_1 = $dbcon->query("SELECT * FROM tbn_house INNER JOIN tbn_site ON tbn_house.house_siteID = tbn_site.site_id WHERE house_master = '$house_master'")->fetch();
    // if($house_master2 == 'TUSMT'){
    //     $row_1 = $dbcon->query("SELECT * FROM tbn_status_sn WHERE SUBSTRING(sn_status_an, 1, 5) = '$house_master2' ")->fetch();
    // }else{
    $row_2 = $dbcon->query("SELECT * FROM tbn_status_sn WHERE sn_status_an = '$house_master'")->fetch();
    // }
    $row_3 = $dbcon->query("SELECT * FROM tbn_status_cn WHERE cn_status_sn = '$house_master'")->fetch();
    // $row_4 = $dbcon->query("SELECT * FROM tb3_sncanel WHERE sncanel_sn = '$house_master'")->fetch();
    // $row_5 = $dbcon->query("SELECT * FROM tb3_statussn WHERE statussn_sn = '$house_master'")->fetch();

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
    echo json_encode([
        's_master'=> $row_1,
        // 'aaa' =>$row_1,
        // 'zz' => intval(substr($house_master, 5,10)),
        'config_sn'=> $row_2,
        'config_cn'=> $row_3,
        'controlstatus'=> $controlstatus,
        // 'dashName'=> $dashName,
        // 'dashSncanel'=> $dashSncanel,
        // 'dashMode'=> $dashMode,
        // 'dashImg'=> $dashImg,
        // 'dashUnit'=> $dashUnit,
        // 'conttrolname'=> $conttrolname,
        // 'imgCon'=> [
        //     'drip_1'=> $drip_1,
        //     'drip_2'=> $drip_2,
        //     'drip_3'=> $drip_3,
        //     'drip_4'=> $drip_4,
        //     'drip_5'=> $drip_5,
        //     'drip_6'=> $drip_6,
        //     'drip_7'=> $drip_7,
        //     'drip_8'=> $drip_8,
        //     'foggy'=> $foggy,
        //     'fan'=> $fan,
        //     'shader'=> $shader,
        //     'fertilizer'=> $fertilizer
        // ],
        // 'ingMap' => $ingMap,
        // 'meter_status' => $meter_status,
        // 'meter_chenal' => $meter_chenal,
        // 'meter_mode' => $meter_mode,
        // 'meterImg' => $meterImg,
        // 'meterUnit' => $meterUnit,
        // 'time_update' => $r,
        // 'theme' => $_SESSION["login_theme"]
    ]);
