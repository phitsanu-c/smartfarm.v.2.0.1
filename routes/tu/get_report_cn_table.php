<?php
    require "../connectdb.php";

    $house_master = $_POST["house_master"];
    $config_cn = $_POST["config_cn"];
    // echo $config_cn["cn_status_1"];
    // // exit();

    if ($_POST["mode"] == 'day') {
        $start_day = date("Y-m-d H:i:s", strtotime('-1 day'));
        $stop_day = date("Y-m-d H:i:s");
    } else if ($_POST["mode"] == 'week') {
        $start_day = date("Y-m-d H:i:s", strtotime('-7 day'));
        $stop_day = date("Y-m-d H:i:s");
    } else if ($_POST["mode"] == 'month') {
        $start_day = date("Y-m-d H:i:s", strtotime('-30 day'));
        $stop_day = date("Y-m-d H:i:s");
    } else if ($_POST["mode"] == 'from_to') {
        $start_day = $_POST["val_start"].':00';
        $stop_day = $_POST["val_end"].':00';
    }

    // $numb = intval(substr($house_master, 5,10));
    // $channel =  if($config_cn['cn_status_1'] == 1){echo "cs_dripper_1 AS dripper_1,";};
    // $channel[] = "ROW_NUMBER() OVER (ORDER BY cn_id ) AS row_num";
    if($_POST['mode_report'] == 're_cn'){ // re_cn
        $channel[] = "SUBSTRING(cn_timestamp,1,10) AS nDate";
        $channel[] = "SUBSTRING(cn_timestamp,-8, 5) AS nTime";
        $channel[] = "cn_user";
        $channel[] = "cn_mode";
        if($config_cn['cn_status_1'] == 1){$channel[] = "cn_load_1 AS dripper_1";}
        if($config_cn['cn_status_2'] == 1){$channel[] = "cn_load_2 AS dripper_2";}
        if($config_cn['cn_status_3'] == 1){$channel[] = "cn_load_3 AS dripper_3";}
        if($config_cn['cn_status_4'] == 1){$channel[] = "cn_load_4 AS dripper_4";}
        if($config_cn['cn_status_5'] == 1){$channel[] = "cn_load_5 AS fan_1";}
        if($config_cn['cn_status_6'] == 1){$channel[] = "cn_load_6 AS fan_2";}
        if($config_cn['cn_status_7'] == 1){$channel[] = "cn_load_7 AS fan_3";}
        if($config_cn['cn_status_8'] == 1){$channel[] = "cn_load_8 AS fan_4";}
        if($config_cn['cn_status_9'] == 1){$channel[] = "cn_load_9 AS foggy_1";}
        if($config_cn['cn_status_10'] == 1){$channel[] = "cn_load_10 AS foggy_2";}
        if($config_cn['cn_status_11'] == 1){$channel[] = "cn_load_11 AS spray";}
        if($config_cn['cn_status_12'] == 1){$channel[] = "cn_load_12 AS shading";}

        $channel1 = implode(', ',$channel);
        // exit();
        $sql = "SELECT $channel1 FROM tbn_control_log WHERE cn_sn = '$house_master' AND cn_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY cn_timestamp ";
        $stmt = $dbcon->query($sql);
        $colcount = $stmt->columnCount();
        $i=1;
        while ($row = $stmt->fetch()) {
            $data1[0] = $row[0];
            $data1[1] = $row[1];
            $data1[2] = $row[2];
            if($row[3] == 'Manual'){$data1[3] = "กำหนดเอง";}else {$data1[3] = "อัตโนมัติ";}
            if($colcount >= 4){ if($row[4] == 'ON'){$data1[4] = "เปิด";}else {$data1[4] = "ปิด";} }
            if($colcount >= 5){ if($row[5] == 'ON'){$data1[5] = "เปิด";}else {$data1[5] = "ปิด";} }
            if($colcount >= 6){ if($row[6] == 'ON'){$data1[6] = "เปิด";}else {$data1[6] = "ปิด";} }
            if($colcount >= 7){ if($row[7] == 'ON'){$data1[7] = "เปิด";}else {$data1[7] = "ปิด";} }
            if($colcount >= 8){ if($row[8] == 'ON'){$data1[8] = "เปิด";}else {$data1[8] = "ปิด";} }
            if($colcount >= 9){ if($row[9] == 'ON'){$data1[9] = "เปิด";}else {$data1[9] = "ปิด";} }
            if($colcount >= 10){ if($row[10] == 'ON'){$data1[10] = "เปิด";}else {$data1[10] = "ปิด";} }
            if($colcount >= 11){ if($row[11] == 'ON'){$data1[11] = "เปิด";}else {$data1[11] = "ปิด";} }
            if($colcount >= 12){ if($row[12] == 'ON'){$data1[12] = "เปิด";}else {$data1[12] = "ปิด";} }
            if($colcount >= 13){ if($row[13] == 'ON'){$data1[13] = "เปิด";}else {$data1[13] = "ปิด";} }
            if($colcount >= 14){ if($row[14] == 'ON'){$data1[14] = "เปิด";}else {$data1[14] = "ปิด";} }
            if($colcount >= 15){ if($row[15] == 'ON'){$data1[15] = "เปิด";}else {$data1[15] = "ปิด";} }
            $data0[] = $data1;
            // $data0[] = $row;
            //  $data0[] =
            // [
            //     $i,
            //     substr($row['cn_timestamp'],0,10),
            //     substr($row['cn_timestamp'],11,12),
            //     // $row['cn_timestamp'],
            //     $row['cn_user'],
            //     $row['cn_mode'],
            //     $row['dripper_1'],
            //     $row['dripper_2'],
            //     $row['dripper_3'],
            //     $row['dripper_4'],
            //     $row['fan_1'],
            //     $row['fan_2'],
            //     $row['fan_3'],
            //     $row['fan_4'],
            //     $row['foggy_1'],
            //     $row['foggy_2'],
            //     $row['spray'],
            //     $row['shading']
            //     // $row[5],
            //     // $row[6],
            //     // $row[7],
            //     // $row[8],
            //     // $row[9],
            //     // $row[16],
            //     // $row[11],
            //     // $row[12],
            //     // $row[13],
            //     // $row[14],
            //     // $row[15]
            // ];
           // $data0['timestamp'][] = substr($row['data_timestamp'],0,16);
           // $data0['temp_out'][]  = $row['temp_out'];
           // $data0['hum_out'][]   = $row['hum_out'];
           // $data0['light_out'][] = $row['light_out'];
           // $data0['temp_in'][]   = $row['temp_in'];
           // $data0['hum_in'][]    = $row['hum_in'];
           // $data0['light_in'][]  = $row['light_in'];
           // $data0['soil_in'][]   = $row['soil_in'];
           $i++;
        }
    }
    elseif ($_POST['mode_report'] == 're_cnAuto') { // re_cnManual
        $table_name = 'tbn_control_au'.$_POST['load_select'];
        $channel[] = "SUBSTRING(load_timestamp,1,10) AS nDate";
        $channel[] = "SUBSTRING(load_timestamp,-8, 5) AS nTime";
        $channel[] = "load_user";
        $channel[] = "load_s_1";
        $channel[] = "load_e_1";
        $channel[] = "load_s_2";
        $channel[] = "load_e_2";
        $channel[] = "load_s_3";
        $channel[] = "load_e_3";
        $channel[] = "load_s_4";
        $channel[] = "load_e_4";
        $channel[] = "load_s_5";
        $channel[] = "load_e_5";
        $channel[] = "load_s_6";
        $channel[] = "load_e_6";

        $channel1 = implode(', ',$channel);
        // exit();
        $sql = "SELECT $channel1 FROM $table_name WHERE load_sn = '$house_master' AND load_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY load_timestamp ";
        $stmt = $dbcon->query($sql);
        $data0 = array();
        $i=1;
        while ($row = $stmt->fetch()) {
            $data0[] = $row;
        }
    }
    elseif ($_POST['mode_report'] == 're_cnManual') { // re_cnManual
        $channel[] = "SUBSTRING(mn_timestamp,1,10) AS nDate";
        $channel[] = "SUBSTRING(mn_timestamp,-8, 5) AS nTime";
        $channel[] = "mn_user";
        if($config_cn['cn_status_1'] == 1){$channel[] = "mn_load_1 AS dripper_1";}
        if($config_cn['cn_status_2'] == 1){$channel[] = "mn_load_2 AS dripper_2";}
        if($config_cn['cn_status_3'] == 1){$channel[] = "mn_load_3 AS dripper_3";}
        if($config_cn['cn_status_4'] == 1){$channel[] = "mn_load_4 AS dripper_4";}
        if($config_cn['cn_status_5'] == 1){$channel[] = "mn_load_5 AS fan_1";}
        if($config_cn['cn_status_6'] == 1){$channel[] = "mn_load_6 AS fan_2";}
        if($config_cn['cn_status_7'] == 1){$channel[] = "mn_load_7 AS fan_3";}
        if($config_cn['cn_status_8'] == 1){$channel[] = "mn_load_8 AS fan_4";}
        if($config_cn['cn_status_9'] == 1){$channel[] = "mn_load_9 AS foggy_1";}
        if($config_cn['cn_status_10'] == 1){$channel[] = "mn_load_10 AS foggy_2";}
        if($config_cn['cn_status_11'] == 1){$channel[] = "mn_load_11 AS spray";}
        if($config_cn['cn_status_12'] == 1){$channel[] = "mn_load_12 AS shading";}

        $channel1 = implode(', ',$channel);
        // exit();
        $sql = "SELECT $channel1 FROM tbn_control_mn_log WHERE mn_sn = '$house_master' AND mn_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY mn_timestamp ";
        $stmt = $dbcon->query($sql);
        $colcount = $stmt->columnCount();
        while ($row = $stmt->fetch()) {
            $data1[0] = $row[0];
            $data1[1] = $row[1];
            $data1[2] = $row[2];
            if($colcount >= 3){ if($row[3] == 'ON'){$data1[3] = "เปิดใช้งาน";}else {$data1[3] = "ปิดใช้งาน";} }
            if($colcount >= 4){ if($row[4] == 'ON'){$data1[4] = "เปิดใช้งาน";}else {$data1[4] = "ปิดใช้งาน";} }
            if($colcount >= 5){ if($row[5] == 'ON'){$data1[5] = "เปิดใช้งาน";}else {$data1[5] = "ปิดใช้งาน";} }
            if($colcount >= 6){ if($row[6] == 'ON'){$data1[6] = "เปิดใช้งาน";}else {$data1[6] = "ปิดใช้งาน";} }
            if($colcount >= 7){ if($row[7] == 'ON'){$data1[7] = "เปิดใช้งาน";}else {$data1[7] = "ปิดใช้งาน";} }
            if($colcount >= 8){ if($row[8] == 'ON'){$data1[8] = "เปิดใช้งาน";}else {$data1[8] = "ปิดใช้งาน";} }
            if($colcount >= 9){ if($row[9] == 'ON'){$data1[9] = "เปิดใช้งาน";}else {$data1[9] = "ปิดใช้งาน";} }
            if($colcount >= 10){ if($row[10] == 'ON'){$data1[10] = "เปิดใช้งาน";}else {$data1[10] = "ปิดใช้งาน";} }
            if($colcount >= 11){ if($row[11] == 'ON'){$data1[11] = "เปิดใช้งาน";}else {$data1[11] = "ปิดใช้งาน";} }
            if($colcount >= 12){ if($row[12] == 'ON'){$data1[12] = "เปิดใช้งาน";}else {$data1[12] = "ปิดใช้งาน";} }
            if($colcount >= 13){ if($row[13] == 'ON'){$data1[13] = "เปิดใช้งาน";}else {$data1[13] = "ปิดใช้งาน";} }
            if($colcount >= 14){ if($row[14] == 'ON'){$data1[14] = "เปิดใช้งาน";}else {$data1[14] = "ปิดใช้งาน";} }
            $data0[] = $data1;
        }
    }
    elseif ($_POST['mode_report'] == 're_sensor') { // re_sensor
        $numb = intval(substr($house_master, 5,10));
        $data_channel = [];
        $channel[] = "SUBSTRING(data_timestamp,1,16) AS nDate";
        // $channel[] = "SUBSTRING(data_timestamp,1,10) AS nDate";
        // $channel[] = "SUBSTRING(data_timestamp,-8, 5) AS nTime";
        $count_columns = count($config_cn[3]);
        for($i=0; $i < $count_columns; $i++){
            if ($config_cn[3][$i] == 4 || $config_cn[3][$i] == 5) {
                if($house_master == 'KMUMT001'){
                    $channel[] = 'round('.$config_cn[1][$i].$numb.', 1) AS data_cn'.($i+1);
                }else{
                    $channel[] = 'round('.$config_cn[1][$i].$numb.'/1000, 1) AS data_cn'.($i+1);
                }

            } elseif ($config_cn[3][$i] == 6 || $config_cn[3][$i] == 7) {
                $channel[] = 'round('.$config_cn[1][$i].$numb.'/54, 1) AS data_cn'.($i+1);
            } else {
                $channel[] = 'round('.$config_cn[1][$i].$numb.', 1) AS data_cn'.($i+1);
            }
        }
        // $config_cn
        // $channel[] = "SUBSTRING(mn_timestamp,1,10) AS nDate";
        // $channel[] = "SUBSTRING(mn_timestamp,-8, 5) AS nTime";
        // $channel[] = "mn_user";
        // if($config_cn['cn_status_1'] == 1){$channel[] = "mn_load_1 AS dripper_1";}
        $channel1 = implode(', ',$channel);
        $house_master2 = substr($house_master, 0,5);
        // $start_day2 = date("Y/m/d H:i:s",strtotime($start_day));
        // $stop_day2 = date("Y/m/d H:i:s",strtotime($stop_day));
        // exit();
        $sel_all_every = $_POST["sel_all_every"];
        $sql = "SELECT $channel1 FROM tbn_data_tu WHERE data_sn = '$house_master2' AND data_timestamp BETWEEN '$start_day' AND '$stop_day' AND mod(minute(`data_timestamp`),'$sel_all_every') = 0 ORDER BY data_timestamp ";
        $stmt = $dbcon->query($sql);
        $data0 = array();
        $i=1;
        while ($row = $stmt->fetch()) {
            // $data0[] = $row;
            $data0['timestamp'][] = $row['nDate'];
            if($count_columns >= 1){
                $data0['data_cn1'][]  = $row['data_cn1'];
            }
            if($count_columns >= 2){
                $data0['data_cn2'][]   = $row['data_cn2'];
            }
            if($count_columns >= 3){
                $data0['data_cn3'][] = $row['data_cn3'];
            }
            if($count_columns >= 4){
                $data0['data_cn4'][]   = $row['data_cn4'];
            }
            if($count_columns >= 5){
                $data0['data_cn5'][]    = $row['data_cn5'];
            }
            if($count_columns >= 6){
                $data0['data_cn6'][]  = $row['data_cn6'];
            }
            if($count_columns >= 7){
                $data0['data_cn7'][]   = $row['data_cn7'];
            }
           $i++;
        }
    } // DATE_FORMAT(NOW(),'%Y-%m-%d %H-%i-%s')
    // echo $sql;
    // echo $count_columns;
    // exit();
       echo json_encode(
           $data0
         //   [
         //       [
         //       "Tiger Nixon",
         //       "System Architect",
         //       "Edinburgh",
         //       "5421",
         //       "2011/04/25",
         //       "$320,800"
         //     ],
         //     [
         //       "Garrett Winters",
         //       "Accountant",
         //       "Tokyo",
         //       "8422",
         //       "2011/07/25",
         //       "$170,750"
         //     ],
         // ]
     );
