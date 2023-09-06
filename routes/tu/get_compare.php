<?php
    require "connect_mqtt_uptime.php";

    $house_master = $_POST["house_master"];
    $config_cn = $_POST["config_cn"];
    // echo $config_cn["cn_status_1"];
    // if($_POST['unit_light'] == 'true'){
    //     echo "klux";
    // }else {
    //     echo "mol";
    // }
    // echo $_POST['unit_light'];
    // exit();

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
    $data_channel = [];
    $channel[] = "SUBSTRING(data_timestamp,1,16) AS nDate";
    // $channel[] = "SUBSTRING(data_timestamp,1,10) AS nDate";
    // $channel[] = "SUBSTRING(data_timestamp,-8, 5) AS nTime";
    $count_columns = count($config_cn[2]);
    for($i=0; $i < $count_columns; $i++){
        if ($config_cn[3][$i] == 4 || $config_cn[3][$i] == 5) {
            // if($house_master == 'KMUMT001'){
            //     $channel[] = 'round('.$config_cn[1][$i].', 1) AS data_cn'.($i+1);
            // }else{
            //     $channel[] = 'round('.$config_cn[1][$i].'/1000, 1) AS data_cn'.($i+1);
            // }
            if($_POST['unit_light'] == 'true'){
                $channel[] = 'round('.$config_cn[1][$i].'/1000, 1) AS data_cn'.($i+1);
            }else {
                $channel[] = 'round('.$config_cn[1][$i].'/54, 1) AS data_cn'.($i+1);
            }

        } elseif ($config_cn[3][$i] == 6 || $config_cn[3][$i] == 7) {
            // $channel[] = 'round('.$config_cn[1][$i].'/54, 1) AS data_cn'.($i+1);
            if($_POST['unit_light'] == 'true'){
                $channel[] = 'round('.$config_cn[1][$i].'/1000, 1) AS data_cn'.($i+1);
            }else {
                $channel[] = 'round('.$config_cn[1][$i].'/54, 1) AS data_cn'.($i+1);
            }
        } else {
            $channel[] = 'round('.$config_cn[1][$i].', 1) AS data_cn'.($i+1);
        }
    }
    // echo json_encode($channel);
    // exit();
    // $config_cn
    // $channel[] = "SUBSTRING(mn_timestamp,1,10) AS nDate";
    // $channel[] = "SUBSTRING(mn_timestamp,-8, 5) AS nTime";
    // $channel[] = "mn_user";
    // if($config_cn['cn_status_1'] == 1){$channel[] = "mn_load_1 AS dripper_1";}
    $channel1 = implode(', ',$channel);
    $house_master2 = substr($house_master, 0,5);
    // $start_day2 = date("Y/m/d H:i:s",strtotime($start_day));
    // $stop_day2 = date("Y/m/d H:i:s",strtotime($stop_day));
    // echo $channel1;
    // exit();
    $sel_all_every = $_POST["sel_all_every"];
    if($_POST['eq'] == 0){
        $tb_name = 'tbn_data_tu';
    }else {
        $tb_name = 'tbn_data_tu_eq';
    }
    $sql = "SELECT $channel1 FROM $tb_name WHERE data_sn = '$house_master2' AND data_timestamp BETWEEN '$start_day' AND '$stop_day' AND mod(minute(`data_timestamp`),'$sel_all_every') = 0 ORDER BY data_timestamp ";
    $stmt = $dbcon->query($sql);
    $data0 = array();
    $i=1;
    // echo $sql;
    // exit();
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

        if($count_columns >= 8){
            $data0['data_cn8'][]   = $row['data_cn8'];
        }
       $i++;
    }
    // DATE_FORMAT(NOW(),'%Y-%m-%d %H-%i-%s')
    // echo $sql;
    // echo $channel1;
    // exit();
   echo json_encode($data0);
