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
        $start_day = date("Y/m/d H:i:s", strtotime('-7 day'));
        $stop_day = date("Y/m/d H:i:s");
    } else if ($_POST["mode"] == 'month') {
        $start_day = date("Y/m/d H:i:s", strtotime('-30 day'));
        $stop_day = date("Y/m/d H:i:s");
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
        $channel[] = "cn_mode";
        $channel[] = "cn_user";
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
        $data0 = array();
        $i=1;
        while ($row = $stmt->fetch()) {
            $data0[] = $row;
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
    } elseif ($_POST['mode_report'] == 're_cnAuto') { // re_cnManual
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
    } elseif ($_POST['mode_report'] == 're_cnManual') { // re_cnManual
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
        $data0 = array();
        $i=1;
        while ($row = $stmt->fetch()) {
            $data0[] = $row;
        }
    }elseif ($_POST['mode_report'] == 're_sensor') { // re_sensor
        $numb = intval(substr($house_master, 5,10));
        $data_channel = [];
        $channel[] = "SUBSTRING(data_timestamp,1,16) AS nDate";
        // $channel[] = "SUBSTRING(data_timestamp,1,10) AS nDate";
        // $channel[] = "SUBSTRING(data_timestamp,-8, 5) AS nTime";
        for($i=0; $i < count($config_cn[3]); $i++){
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
        // exit();
        $sql = "SELECT $channel1 FROM tbn_data_tu WHERE data_sn = '$house_master2' AND data_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY data_timestamp ";
        $stmt = $dbcon->query($sql);
        $data0 = array();
        $i=1;
        while ($row = $stmt->fetch()) {
            $data0[] = $row;
           $i++;
        }
    }
    // echo $sql;
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