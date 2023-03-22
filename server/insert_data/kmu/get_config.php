<?php
    require "../connectdb.php";


    $house_master = $_POST["house_master"];
    // echo json_encode($house_master);
    //     exit();
    if($house_master == 'KMUMT001'){
        
        // $channel = $_POST["channel"];
        // $row_s_master = $dbcon->query("SELECT * FROM tb2_house INNER JOIN tb2_site ON tb2_house.house_siteID = tb2_site.site_id WHERE house_master = '$house_master'")->fetch();
        $row_2 = $dbcon->query("SELECT * FROM tb3_dashstatus WHERE dashstatus_sn = '$house_master'")->fetch();
        // $row_3 = $dbcon->query("SELECT * FROM tb3_dashname WHERE dashname_sn = '$house_master'")->fetch();
        $row_4 = $dbcon->query("SELECT * FROM tb3_sncanel WHERE sncanel_sn = '$house_master'")->fetch();
        $row_5 = $dbcon->query("SELECT * FROM tb3_statussn WHERE statussn_sn = '$house_master'")->fetch();
        // $row_6 = $dbcon->query("SELECT * FROM tb_set_maxmin WHERE set_maxmin_sn = '$house_master'")->fetch();
        $row_6 = $dbcon->query("SELECT * FROM tb3_control WHERE control_sn = '$house_master' ORDER BY control_timestamp DESC LIMIT 1")->fetch();
        $row_7 = $dbcon->query("SELECT maxmin_min_1, maxmin_max_1,
                                    maxmin_min_2, maxmin_max_2,
                                    maxmin_min_3, maxmin_max_3, 
                                    maxmin_min_5, maxmin_max_5 
                                FROM tb_control_maxmin WHERE maxmin_max_sn = '$house_master' ORDER BY maxmin_timestamp DESC LIMIT 1")->fetch();
        
        $dashStatus[1] = intval($row_2["dashstatus_1_1"]);
        $dashStatus[2] = intval($row_2["dashstatus_1_2"]);
        $dashStatus[3] = intval($row_2["dashstatus_1_3"]);
        $dashStatus[4] = intval($row_2["dashstatus_1_4"]);
        $dashStatus[5] = intval($row_2["dashstatus_2_1"]);
        $dashStatus[6] = intval($row_2["dashstatus_2_2"]);
        $dashStatus[7] = intval($row_2["dashstatus_2_3"]);
        $dashStatus[8] = intval($row_2["dashstatus_2_4"]);
        $dashStatus[9] = intval($row_2["dashstatus_3_1"]);
        $dashStatus[10] = intval($row_2["dashstatus_3_2"]);
        $dashStatus[11] = intval($row_2["dashstatus_3_3"]);
        $dashStatus[12] = intval($row_2["dashstatus_3_4"]);
        $dashStatus[13] = intval($row_2["dashstatus_4_1"]);
        $dashStatus[14] = intval($row_2["dashstatus_4_2"]);
        $dashStatus[15] = intval($row_2["dashstatus_4_3"]);
        $dashStatus[16] = intval($row_2["dashstatus_4_4"]);
        $dashStatus[17] = intval($row_2["dashstatus_5_1"]);
        $dashStatus[18] = intval($row_2["dashstatus_5_2"]);
        $dashStatus[19] = intval($row_2["dashstatus_5_3"]);
        $dashStatus[20] = intval($row_2["dashstatus_5_4"]);
        $dashStatus[21] = intval($row_2["dashstatus_6_1"]);
        $dashStatus[22] = intval($row_2["dashstatus_6_2"]);
        $dashStatus[23] = intval($row_2["dashstatus_6_3"]);
        $dashStatus[24] = intval($row_2["dashstatus_6_4"]);
        $dashStatus[25] = intval($row_2["dashstatus_7_1"]);
        $dashStatus[26] = intval($row_2["dashstatus_7_2"]);
        $dashStatus[27] = intval($row_2["dashstatus_7_3"]);
        $dashStatus[28] = intval($row_2["dashstatus_7_4"]);
        $dashStatus[29] = intval($row_2["dashstatus_8_1"]);
        $dashStatus[30] = intval($row_2["dashstatus_8_2"]);
        $dashStatus[31] = intval($row_2["dashstatus_8_3"]);
        $dashStatus[32] = intval($row_2["dashstatus_8_4"]);
        $dashStatus[33] = intval($row_2["dashstatus_9_1"]);
        $dashStatus[34] = intval($row_2["dashstatus_9_2"]);
        $dashStatus[35] = intval($row_2["dashstatus_9_3"]);
        $dashStatus[36] = intval($row_2["dashstatus_9_4"]);
        $dashStatus[37] = intval($row_2["dashstatus_10_1"]);
        $dashStatus[38] = intval($row_2["dashstatus_10_2"]);
        $dashStatus[39] = intval($row_2["dashstatus_10_3"]);
        $dashStatus[40] = intval($row_2["dashstatus_10_4"]);
        
        $dashSncanel[1] = $row_4["sncanel_1_1"];
        $dashSncanel[2] = $row_4["sncanel_1_2"];
        $dashSncanel[3] = $row_4["sncanel_1_3"];
        $dashSncanel[4] = $row_4["sncanel_1_4"];
        $dashSncanel[5] = $row_4["sncanel_2_1"];
        $dashSncanel[6] = $row_4["sncanel_2_2"];
        $dashSncanel[7] = $row_4["sncanel_2_3"];
        $dashSncanel[8] = $row_4["sncanel_2_4"];
        $dashSncanel[9] = $row_4["sncanel_3_1"];
        $dashSncanel[10] = $row_4["sncanel_3_2"];
        $dashSncanel[11] = $row_4["sncanel_3_3"];
        $dashSncanel[12] = $row_4["sncanel_3_4"];
        $dashSncanel[13] = $row_4["sncanel_4_1"];
        $dashSncanel[14] = $row_4["sncanel_4_2"];
        $dashSncanel[15] = $row_4["sncanel_4_3"];
        $dashSncanel[16] = $row_4["sncanel_4_4"];
        $dashSncanel[17] = $row_4["sncanel_5_1"];
        $dashSncanel[18] = $row_4["sncanel_5_2"];
        $dashSncanel[19] = $row_4["sncanel_5_3"];
        $dashSncanel[20] = $row_4["sncanel_5_4"];
        $dashSncanel[21] = $row_4["sncanel_6_1"];
        $dashSncanel[22] = $row_4["sncanel_6_2"];
        $dashSncanel[23] = $row_4["sncanel_6_3"];
        $dashSncanel[24] = $row_4["sncanel_6_4"];
        $dashSncanel[25] = $row_4["sncanel_7_1"];
        $dashSncanel[26] = $row_4["sncanel_7_2"];
        $dashSncanel[27] = $row_4["sncanel_7_3"];
        $dashSncanel[28] = $row_4["sncanel_7_4"];
        $dashSncanel[29] = $row_4["sncanel_8_1"];
        $dashSncanel[30] = $row_4["sncanel_8_2"];
        $dashSncanel[31] = $row_4["sncanel_8_3"];
        $dashSncanel[32] = $row_4["sncanel_8_4"];
        $dashSncanel[33] = $row_4["sncanel_9_1"];
        $dashSncanel[34] = $row_4["sncanel_9_2"];
        $dashSncanel[35] = $row_4["sncanel_9_3"];
        $dashSncanel[36] = $row_4["sncanel_9_4"];
        $dashSncanel[37] = $row_4["sncanel_10_1"];
        $dashSncanel[38] = $row_4["sncanel_10_2"];
        $dashSncanel[39] = $row_4["sncanel_10_3"];
        $dashSncanel[40] = $row_4["sncanel_10_4"];
        
        $dashMode[1] = $row_5["statussn_1_1"];
        $dashMode[2] = $row_5["statussn_1_2"];
        $dashMode[3] = $row_5["statussn_1_3"];
        $dashMode[4] = $row_5["statussn_1_4"];
        $dashMode[5] = $row_5["statussn_2_1"];
        $dashMode[6] = $row_5["statussn_2_2"];
        $dashMode[7] = $row_5["statussn_2_3"];
        $dashMode[8] = $row_5["statussn_2_4"];
        $dashMode[9] = $row_5["statussn_3_1"];
        $dashMode[10] = $row_5["statussn_3_2"];
        $dashMode[11] = $row_5["statussn_3_3"];
        $dashMode[12] = $row_5["statussn_3_4"];
        $dashMode[13] = $row_5["statussn_4_1"];
        $dashMode[14] = $row_5["statussn_4_2"];
        $dashMode[15] = $row_5["statussn_4_3"];
        $dashMode[16] = $row_5["statussn_4_4"];
        $dashMode[17] = $row_5["statussn_5_1"];
        $dashMode[18] = $row_5["statussn_5_2"];
        $dashMode[19] = $row_5["statussn_5_3"];
        $dashMode[20] = $row_5["statussn_5_4"];
        $dashMode[21] = $row_5["statussn_6_1"];
        $dashMode[22] = $row_5["statussn_6_2"];
        $dashMode[23] = $row_5["statussn_6_3"];
        $dashMode[24] = $row_5["statussn_6_4"];
        $dashMode[25] = $row_5["statussn_7_1"];
        $dashMode[26] = $row_5["statussn_7_2"];
        $dashMode[27] = $row_5["statussn_7_3"];
        $dashMode[28] = $row_5["statussn_7_4"];
        $dashMode[29] = $row_5["statussn_8_1"];
        $dashMode[30] = $row_5["statussn_8_2"];
        $dashMode[31] = $row_5["statussn_8_3"];
        $dashMode[32] = $row_5["statussn_8_4"];
        $dashMode[33] = $row_5["statussn_9_1"];
        $dashMode[34] = $row_5["statussn_9_2"];
        $dashMode[35] = $row_5["statussn_9_3"];
        $dashMode[36] = $row_5["statussn_9_4"];
        $dashMode[37] = $row_5["statussn_10_1"];
        $dashMode[38] = $row_5["statussn_10_2"];
        $dashMode[39] = $row_5["statussn_10_3"];
        $dashMode[40] = $row_5["statussn_10_4"];
        
        // $set_maxmin['Tmin'] = $row_6["set_Tmin"];
        // $set_maxmin['Tmax'] = $row_6["set_Tmax"];
        // $set_maxmin['Hmin'] = $row_6["set_Hmin"];
        // $set_maxmin['Hmax'] = $row_6["set_Hmax"];
        // $set_maxmin['Lmin'] = $row_6["set_Lmin"];
        // $set_maxmin['Lmax'] = $row_6["set_Lmax"];
        // $set_maxmin['Smin'] = $row_6["set_Smin"];
        // $set_maxmin['Smax'] = $row_6["set_Smax"];
        
        $row_9 = $dbcon->query("SELECT * FROM `tb_data_sensor` WHERE `data_sn`= '$house_master' ORDER BY `data_timestamp` DESC LIMIT 1")->fetch();
        // $row_10 = $dbcon->query("SELECT `data_timestamp` FROM `tb_report_sensor` WHERE `data_sn`= '$house_master' ORDER BY `data_id` DESC LIMIT 1")->fetch();
        if($row_9 == false){
            $data_j = false;
        }
        else{
            for($i=1; $i<=40; $i++){
                if($dashStatus[$i] == 1){
                    $new_channel[] = $dashSncanel[$i];
                    $new_dashMode[] = $dashMode[$i];
                    if($row_9[$dashSncanel[$i]] == null){
                        $data_json[$dashSncanel[$i]] = 0;
                    }else {
                        $data_json['data_st'.substr($dashSncanel[$i],7,10)] = $row_9[$dashSncanel[$i]];
                    }
                }
                $data_chrnal[] = 'data_st'.substr($dashSncanel[$i],7,10);
            }
            $data_j = [
                'data_update' => [
                    'data' => [[
                        'serial_id' => $house_master,
                        'date_time' => $row_9['data_timestamp'],
                        'date' => $row_9['data_date'],
                        'time' => $row_9['data_time'],
                        'data' => $data_json,
                    ]]
                ]
            ];
        }
        echo json_encode([
            'house_master'=> $house_master,
            'dashSncanel'=> $data_chrnal,//$new_channel,
            'dashMode'=> $new_dashMode,
            // 'set_maxmun' => $set_maxmin,
            // 'time_update' => $row_9[0],
        // 'time_report_update' => $row_10[0],
            'data_json' => $data_j,
            'datetime_sever' => date("Y/m/d").' - '.date("H:i"),
            'control' => $row_6,
            'conteol_auto' => $row_7
        ]);
    }
    else{
        $row_2 = $dbcon->query("SELECT * FROM tb3_dashstatus WHERE dashstatus_sn = '$house_master'")->fetch();
        // $row_3 = $dbcon->query("SELECT * FROM tb3_dashname WHERE dashname_sn = '$house_master'")->fetch();
        $row_4 = $dbcon->query("SELECT * FROM tb3_sncanel WHERE sncanel_sn = '$house_master'")->fetch();
        $row_5 = $dbcon->query("SELECT * FROM tb3_statussn WHERE statussn_sn = '$house_master'")->fetch();
        $dashStatus[1] = intval($row_2["dashstatus_1_1"]);
        $dashStatus[2] = intval($row_2["dashstatus_1_2"]);
        $dashStatus[3] = intval($row_2["dashstatus_1_3"]);
        $dashStatus[4] = intval($row_2["dashstatus_1_4"]);
        $dashStatus[5] = intval($row_2["dashstatus_2_1"]);
        $dashStatus[6] = intval($row_2["dashstatus_2_2"]);
        $dashStatus[7] = intval($row_2["dashstatus_2_3"]);
        $dashStatus[8] = intval($row_2["dashstatus_2_4"]);
        $dashStatus[9] = intval($row_2["dashstatus_3_1"]);
        $dashStatus[10] = intval($row_2["dashstatus_3_2"]);
        $dashStatus[11] = intval($row_2["dashstatus_3_3"]);
        $dashStatus[12] = intval($row_2["dashstatus_3_4"]);
        $dashStatus[13] = intval($row_2["dashstatus_4_1"]);
        $dashStatus[14] = intval($row_2["dashstatus_4_2"]);
        $dashStatus[15] = intval($row_2["dashstatus_4_3"]);
        $dashStatus[16] = intval($row_2["dashstatus_4_4"]);
        $dashStatus[17] = intval($row_2["dashstatus_5_1"]);
        $dashStatus[18] = intval($row_2["dashstatus_5_2"]);
        $dashStatus[19] = intval($row_2["dashstatus_5_3"]);
        $dashStatus[20] = intval($row_2["dashstatus_5_4"]);
        $dashStatus[21] = intval($row_2["dashstatus_6_1"]);
        $dashStatus[22] = intval($row_2["dashstatus_6_2"]);
        $dashStatus[23] = intval($row_2["dashstatus_6_3"]);
        $dashStatus[24] = intval($row_2["dashstatus_6_4"]);
        $dashStatus[25] = intval($row_2["dashstatus_7_1"]);
        $dashStatus[26] = intval($row_2["dashstatus_7_2"]);
        $dashStatus[27] = intval($row_2["dashstatus_7_3"]);
        $dashStatus[28] = intval($row_2["dashstatus_7_4"]);
        $dashStatus[29] = intval($row_2["dashstatus_8_1"]);
        $dashStatus[30] = intval($row_2["dashstatus_8_2"]);
        $dashStatus[31] = intval($row_2["dashstatus_8_3"]);
        $dashStatus[32] = intval($row_2["dashstatus_8_4"]);
        $dashStatus[33] = intval($row_2["dashstatus_9_1"]);
        $dashStatus[34] = intval($row_2["dashstatus_9_2"]);
        $dashStatus[35] = intval($row_2["dashstatus_9_3"]);
        $dashStatus[36] = intval($row_2["dashstatus_9_4"]);
        $dashStatus[37] = intval($row_2["dashstatus_10_1"]);
        $dashStatus[38] = intval($row_2["dashstatus_10_2"]);
        $dashStatus[39] = intval($row_2["dashstatus_10_3"]);
        $dashStatus[40] = intval($row_2["dashstatus_10_4"]);
        
        $dashSncanel[1] = $row_4["sncanel_1_1"];
        $dashSncanel[2] = $row_4["sncanel_1_2"];
        $dashSncanel[3] = $row_4["sncanel_1_3"];
        $dashSncanel[4] = $row_4["sncanel_1_4"];
        $dashSncanel[5] = $row_4["sncanel_2_1"];
        $dashSncanel[6] = $row_4["sncanel_2_2"];
        $dashSncanel[7] = $row_4["sncanel_2_3"];
        $dashSncanel[8] = $row_4["sncanel_2_4"];
        $dashSncanel[9] = $row_4["sncanel_3_1"];
        $dashSncanel[10] = $row_4["sncanel_3_2"];
        $dashSncanel[11] = $row_4["sncanel_3_3"];
        $dashSncanel[12] = $row_4["sncanel_3_4"];
        $dashSncanel[13] = $row_4["sncanel_4_1"];
        $dashSncanel[14] = $row_4["sncanel_4_2"];
        $dashSncanel[15] = $row_4["sncanel_4_3"];
        $dashSncanel[16] = $row_4["sncanel_4_4"];
        $dashSncanel[17] = $row_4["sncanel_5_1"];
        $dashSncanel[18] = $row_4["sncanel_5_2"];
        $dashSncanel[19] = $row_4["sncanel_5_3"];
        $dashSncanel[20] = $row_4["sncanel_5_4"];
        $dashSncanel[21] = $row_4["sncanel_6_1"];
        $dashSncanel[22] = $row_4["sncanel_6_2"];
        $dashSncanel[23] = $row_4["sncanel_6_3"];
        $dashSncanel[24] = $row_4["sncanel_6_4"];
        $dashSncanel[25] = $row_4["sncanel_7_1"];
        $dashSncanel[26] = $row_4["sncanel_7_2"];
        $dashSncanel[27] = $row_4["sncanel_7_3"];
        $dashSncanel[28] = $row_4["sncanel_7_4"];
        $dashSncanel[29] = $row_4["sncanel_8_1"];
        $dashSncanel[30] = $row_4["sncanel_8_2"];
        $dashSncanel[31] = $row_4["sncanel_8_3"];
        $dashSncanel[32] = $row_4["sncanel_8_4"];
        $dashSncanel[33] = $row_4["sncanel_9_1"];
        $dashSncanel[34] = $row_4["sncanel_9_2"];
        $dashSncanel[35] = $row_4["sncanel_9_3"];
        $dashSncanel[36] = $row_4["sncanel_9_4"];
        $dashSncanel[37] = $row_4["sncanel_10_1"];
        $dashSncanel[38] = $row_4["sncanel_10_2"];
        $dashSncanel[39] = $row_4["sncanel_10_3"];
        $dashSncanel[40] = $row_4["sncanel_10_4"];
        
        $dashMode[1] = $row_5["statussn_1_1"];
        $dashMode[2] = $row_5["statussn_1_2"];
        $dashMode[3] = $row_5["statussn_1_3"];
        $dashMode[4] = $row_5["statussn_1_4"];
        $dashMode[5] = $row_5["statussn_2_1"];
        $dashMode[6] = $row_5["statussn_2_2"];
        $dashMode[7] = $row_5["statussn_2_3"];
        $dashMode[8] = $row_5["statussn_2_4"];
        $dashMode[9] = $row_5["statussn_3_1"];
        $dashMode[10] = $row_5["statussn_3_2"];
        $dashMode[11] = $row_5["statussn_3_3"];
        $dashMode[12] = $row_5["statussn_3_4"];
        $dashMode[13] = $row_5["statussn_4_1"];
        $dashMode[14] = $row_5["statussn_4_2"];
        $dashMode[15] = $row_5["statussn_4_3"];
        $dashMode[16] = $row_5["statussn_4_4"];
        $dashMode[17] = $row_5["statussn_5_1"];
        $dashMode[18] = $row_5["statussn_5_2"];
        $dashMode[19] = $row_5["statussn_5_3"];
        $dashMode[20] = $row_5["statussn_5_4"];
        $dashMode[21] = $row_5["statussn_6_1"];
        $dashMode[22] = $row_5["statussn_6_2"];
        $dashMode[23] = $row_5["statussn_6_3"];
        $dashMode[24] = $row_5["statussn_6_4"];
        $dashMode[25] = $row_5["statussn_7_1"];
        $dashMode[26] = $row_5["statussn_7_2"];
        $dashMode[27] = $row_5["statussn_7_3"];
        $dashMode[28] = $row_5["statussn_7_4"];
        $dashMode[29] = $row_5["statussn_8_1"];
        $dashMode[30] = $row_5["statussn_8_2"];
        $dashMode[31] = $row_5["statussn_8_3"];
        $dashMode[32] = $row_5["statussn_8_4"];
        $dashMode[33] = $row_5["statussn_9_1"];
        $dashMode[34] = $row_5["statussn_9_2"];
        $dashMode[35] = $row_5["statussn_9_3"];
        $dashMode[36] = $row_5["statussn_9_4"];
        $dashMode[37] = $row_5["statussn_10_1"];
        $dashMode[38] = $row_5["statussn_10_2"];
        $dashMode[39] = $row_5["statussn_10_3"];
        $dashMode[40] = $row_5["statussn_10_4"];

        $row_9 = $dbcon->query("SELECT * FROM `tb_data_sensor` WHERE `data_sn`= '$house_master' ORDER BY `data_timestamp` DESC LIMIT 1")->fetch();
        // $row_10 = $dbcon->query("SELECT `data_timestamp` FROM `tb_report_sensor` WHERE `data_sn`= '$house_master' ORDER BY `data_id` DESC LIMIT 1")->fetch();
        if($row_9 == false){
            $data_j = false;
        }
        else{
            for($i=1; $i<=40; $i++){
                if($dashStatus[$i] == 1){
                    $new_channel[] = $dashSncanel[$i];
                    $new_dashMode[] = $dashMode[$i];
                    if($row_9[$dashSncanel[$i]] == null){
                        $data_json[$dashSncanel[$i]] = 0;
                    }else {
                        $data_json[$dashSncanel[$i]] = $row_9[$dashSncanel[$i]];
                    }
                }
                $data_chrnal[] = $dashSncanel[$i];
            }
            $data_j = [
                'serial_id' => $house_master,
                'date_time' => $row_9['data_timestamp'],
                'date' => $row_9['data_date'],
                'time' => $row_9['data_time'],
                'data' => $data_json,
            ];
        }
        echo json_encode([
            'house_master'=> $house_master,
            'dashSncanel'=> $new_channel,
            'dashMode'=> $new_dashMode,
            'data_json' => $data_j,
            'datetime_sever' => date("Y/m/d").' - '.date("H:i"),
            'das' => $dashStatus,
            'snn' => $dashSncanel,
            'mo' => $dashMode,
            'e' => $row_2
        ]);
    }
