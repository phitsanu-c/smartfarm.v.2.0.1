<?php
    // session_start();
    require "../connectdb.php";

    $house_master = $_POST["house_master"];
    // $channel = $_POST["channel"];
    $row_master = $dbcon->query("SELECT * FROM tbn_house INNER JOIN tbn_site ON tbn_house.house_siteID = tbn_site.site_id WHERE house_master = '$house_master'")->fetch();
    // if($house_master2 == 'TUSMT'){
    //     $row_1 = $dbcon->query("SELECT * FROM tbn_status_sn WHERE SUBSTRING(sn_status_an, 1, 5) = '$house_master2' ")->fetch();
    // }else{
        $row_1 = $dbcon->query("SELECT * FROM tbn_status_sn WHERE sn_status_an = '$house_master'")->fetch();
    // }
    // $row_3 = $dbcon->query("SELECT * FROM tb3_dashname WHERE dashname_sn = '$house_master'")->fetch();
    // $row_4 = $dbcon->query("SELECT * FROM tb3_sncanel WHERE sncanel_sn = '$house_master'")->fetch();
    // $row_5 = $dbcon->query("SELECT * FROM tb3_statussn WHERE statussn_sn = '$house_master'")->fetch();

    // $dashStatus[1] = $row_1["sn_status_1"];
    // $dashStatus[2] = $row_1["sn_status_2"]; //intval(substr($house_master, 5,10))
    // $dashStatus[3] = $row_1["sn_status_3"];
    // $dashStatus[4] = $row_1["sn_status_4"];
    // $dashStatus[5] = $row_1["sn_status_5"];
    // $dashStatus[6] = $row_1["sn_status_6"];
    // $dashStatus[7] = $row_1["sn_status_7"];

    // $dashName[1] = $row_1["sn_name_1"];
    // $dashName[2] = $row_1["sn_name_2"];
    // $dashName[3] = $row_1["sn_name_3"];
    // $dashName[4] = $row_1["sn_name_4"];
    // $dashName[5] = $row_1["sn_name_5"];
    // $dashName[6] = $row_1["sn_name_6"];
    // $dashName[7] = $row_1["sn_name_7"];

    // $row_6 = $dbcon->query("SELECT * FROM tb3_controlstatus WHERE controlstatus_sn = '$house_master'")->fetch();
    // $row_7 = $dbcon->query("SELECT * FROM tb3_conttrolname WHERE conttrolname_sn = '$house_master'")->fetch();
    // $row_8 = $dbcon->query("SELECT * FROM tb3_controlcanel WHERE controlcanel_sn = '$house_master'")->fetch();
    // $controlstatus[1] = intval($row_6["controlstatus_1"]);
    // $controlstatus[2] = intval($row_6["controlstatus_2"]);
    // $controlstatus[3] = intval($row_6["controlstatus_3"]);
    // $controlstatus[4] = intval($row_6["controlstatus_4"]);
    // $controlstatus[5] = intval($row_6["controlstatus_5"]);
    // $controlstatus[6] = intval($row_6["controlstatus_6"]);
    // $controlstatus[7] = intval($row_6["controlstatus_7"]);
    // $controlstatus[8] = intval($row_6["controlstatus_8"]);
    // $controlstatus[9] = intval($row_6["controlstatus_9"]);
    // $controlstatus[10] = intval($row_6["controlstatus_10"]);
    // $controlstatus[11] = intval($row_6["controlstatus_11"]);
    // $controlstatus[12] = intval($row_6["controlstatus_12"]);

    // $conttrolname[1] = $row_7["conttrolname_1"];
    // $conttrolname[2] = $row_7["conttrolname_2"];
    // $conttrolname[3] = $row_7["conttrolname_3"];
    // $conttrolname[4] = $row_7["conttrolname_4"];
    // $conttrolname[5] = $row_7["conttrolname_5"];
    // $conttrolname[6] = $row_7["conttrolname_6"];
    // $conttrolname[7] = $row_7["conttrolname_7"];
    // $conttrolname[8] = $row_7["conttrolname_8"];
    // $conttrolname[9] = $row_7["conttrolname_9"];
    // $conttrolname[10] = $row_7["conttrolname_10"];
    // $conttrolname[11] = $row_7["conttrolname_11"];
    // $conttrolname[12] = $row_7["conttrolname_12"];

    // $controlcanel[1] = $row_8["controlcanel_1"];
    // $controlcanel[2] = $row_8["controlcanel_2"];
    // $controlcanel[3] = $row_8["controlcanel_3"];
    // $controlcanel[4] = $row_8["controlcanel_4"];
    // $controlcanel[5] = $row_8["controlcanel_5"];
    // $controlcanel[6] = $row_8["controlcanel_6"];
    // $controlcanel[7] = $row_8["controlcanel_7"];
    // $controlcanel[8] = $row_8["controlcanel_8"];
    // $controlcanel[9] = $row_8["controlcanel_9"];
    // $controlcanel[10] = $row_8["controlcanel_10"];
    // $controlcanel[11] = $row_8["controlcanel_11"];
    // $controlcanel[12] = $row_8["controlcanel_12"];

    echo json_encode([
        's_master'=> $row_master,
        // 'aaa' =>$row_1,
        // 'zz' => intval(substr($house_master, 5,10)),
        'config_sn'=> $row_1,
        // 'dashName'=> $dashName,
        // 'dashSncanel'=> $dashSncanel,
        // 'dashMode'=> $dashMode,
        // 'dashImg'=> $dashImg,
        // 'dashUnit'=> $dashUnit,
        // 'controlstatus'=> $controlstatus,
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
