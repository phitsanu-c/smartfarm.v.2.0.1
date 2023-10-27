<?php
    require "../connectdb.php";

    $house_master = $_POST["house_master"];
    // $numb = intval(substr($house_master, 5,10));
    // echo json_encode($house_master);
    // print_r($_POST);
    // // echo $house_master;
    // exit();
    $row_cont_log = $dbcon->query("SELECT * FROM tbn_control_log WHERE cn_sn = '$house_master' ORDER BY `cn_id` DESC LIMIT 1")->fetch();
    $control_response = [
        "serial_id" => $house_master,
        "mode"      => $row_cont_log['cn_mode'],
        "dripper_1" => $row_cont_log['cn_load_1'],
        "dripper_2" => $row_cont_log['cn_load_2'],
        "dripper_3" => $row_cont_log['cn_load_3'],
        "dripper_4" => $row_cont_log['cn_load_4'],
        "fan_1"     => $row_cont_log['cn_load_5'],
        "fan_2"     => $row_cont_log['cn_load_6'],
        "fan_3"     => $row_cont_log['cn_load_7'],
        "fan_4"     => $row_cont_log['cn_load_8'],
        "foggy_1"   => $row_cont_log['cn_load_9'],
        "foggy_2"   => $row_cont_log['cn_load_10'],
        "spray"     => $row_cont_log['cn_load_11'],
        "shading"   => $row_cont_log['cn_load_12'],
        "user_control" => $row_cont_log['cn_user']
    ];
    // echo json_encode($control_response);
    // exit();

    require '../../phpMQTT.php';
    $host = '203.154.83.117';     // change if necessary
    $port = 4563;                     // change if necessary
    $username = '';                   // set your username
    $password = '';                   // set your password

    if(isset($_POST['syst'])){
        $mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());
        if ($mqtt->connect(true,NULL,$username,$password)) {
            $mqtt->publish($house_master.'/control/loads/mode', $control_response['mode'], 1);
            echo json_encode([
                'house_master'          => $house_master,
                'control_response'      => $control_response,
                'time' => date("Y-M-d H:i:s")
            ]);
        }
        $mqtt->close();
    }else{
        $mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());
        if ($mqtt->connect(true,NULL,$username,$password)) {

            $mqtt->publish($house_master.'/control/response', json_encode($control_response), 1);
            // ท่อ Control_Auto
            $mqtt->publish($house_master.'/control/loads_auto/dripper_1', $control_response['dripper_1'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/dripper_2', $control_response['dripper_2'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/dripper_3', $control_response['dripper_3'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/dripper_4', $control_response['dripper_4'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/fan_1',     $control_response['fan_1'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/fan_2',     $control_response['fan_2'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/fan_3',     $control_response['fan_3'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/fan_4',     $control_response['fan_4'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/foggy_1',   $control_response['foggy_1'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/foggy_2',   $control_response['foggy_2'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/spray',     $control_response['spray'], 1);
            $mqtt->publish($house_master.'/control/loads_auto/shading',   $control_response['shading'], 1);


            $row_lock = $dbcon->query("SELECT * FROM tbn_panel_lock WHERE panel_lock_sn = '$house_master' ORDER BY panel_lock_ts DESC LIMIT 1")->fetch();
            $mqtt->publish($house_master.'/control/loads/spanel',   $row_lock['panel_lock_status'], 1);
            // Exit ท่อ Control_Auto
            // exit();

            // ท่อ set_config
            $row_s = $dbcon->query("SELECT * FROM `tbn_control_config` WHERE cc_sn = '$house_master' ORDER BY `cc_timestamp` DESC LIMIT 1")->fetch();
            $sub_mode = [
                'sn'         => $row_s['cc_sn'],
                'sub_mode'   => $row_s['cc_submode'],
                'sub_mode_1' => $row_s['cc_submode_1'],
                'sub_mode_2' => $row_s['cc_submode_2'],
                'sub_mode_3' => $row_s['cc_submode_3'],
                'sub_mode_4' => $row_s['cc_submode_4'],
                'sub_mode_9' => $row_s['cc_submode_9'],
                'sub_mode_10' => $row_s['cc_submode_10'],
                'sub_mode_11' => $row_s['cc_submode_11'],
                'user_control' => $row_s['cc_user']
            ];
            $row_mn_log = $dbcon->query("SELECT * FROM `tbn_control_mn_log` WHERE mn_sn = '$house_master' ORDER BY `mn_id` DESC LIMIT 1")->fetch();
            $config_manual = [
                "serial_id" => $house_master,
                "dripper_1" => $row_mn_log['mn_load_1'],
                "dripper_2" => $row_mn_log['mn_load_2'],
                "dripper_3" => $row_mn_log['mn_load_3'],
                "dripper_4" => $row_mn_log['mn_load_4'],
                "fan_1"     => $row_mn_log['mn_load_5'],
                "fan_2"     => $row_mn_log['mn_load_6'],
                "fan_3"     => $row_mn_log['mn_load_7'],
                "fan_4"     => $row_mn_log['mn_load_8'],
                "foggy_1"   => $row_mn_log['mn_load_9'],
                "foggy_2"   => $row_mn_log['mn_load_10'],
                "spray"     => $row_mn_log['mn_load_11'],
                "shading"   => $row_mn_log['mn_load_12'],
                "control_user"   => $row_mn_log['mn_user'],
            ];
            $coc[] = '[config]';
            $coc[] = 'serial_id='.$house_master;
            $coc[] = 'dripper_1='.$row_mn_log['mn_load_1'];
            $coc[] = 'dripper_2='.$row_mn_log['mn_load_2'];
            $coc[] = 'dripper_3='.$row_mn_log['mn_load_3'];
            $coc[] = 'dripper_4='.$row_mn_log['mn_load_4'];
            $coc[] = 'fan_1='.$row_mn_log['mn_load_5'];
            $coc[] = 'fan_2='.$row_mn_log['mn_load_6'];
            $coc[] = 'fan_3='.$row_mn_log['mn_load_7'];
            $coc[] = 'fan_4='.$row_mn_log['mn_load_8'];
            $coc[] = 'foggy_1='.$row_mn_log['mn_load_9'];
            $coc[] = 'foggy_2='.$row_mn_log['mn_load_10'];
            $mqtt->publish($house_master.'/control/config/manual', implode('
',$coc), 1);

            // config_timeSet - config_timeLoop
            function add_auto($i, $num, $cycle, $channel_p, $mess, $decode2){
                for ($v = 1; $v <= $cycle; $v++) {
                    if($num == 0){
                        if($v == 1){
                            $decode2['load_'.$i]['s_'.$v] = date("H:i:s", strtotime($mess['load_s_'.floor($channel_p)] ));
                            $decode2['load_'.$i]['e_'.$v] = date("H:i:s", strtotime($decode2['load_'.$i]['s_'.$v].+$mess['load_on_'.floor($channel_p)].'seconds'));
                        }else {
                            $decode2['load_'.$i]['s_'.$v] = date("H:i:s", strtotime($decode2['load_'.$i]['e_'.floor($v-1)].+$mess['load_off_'.floor($channel_p)].'seconds'));//;
                            $decode2['load_'.$i]['e_'.$v] = date("H:i:s", strtotime($decode2['load_'.$i]['s_'.$v].+$mess['load_on_'.floor($channel_p)].'seconds'));
                        }
                    }else { //$num != 0
                        if($v == 1){
                            $decode2['load_'.$i]['s_'.($v+$num)] = date("H:i:s", strtotime($mess['load_s_'.floor($channel_p)]));
                            $decode2['load_'.$i]['e_'.($v+$num)] = date("H:i:s", strtotime($decode2['load_'.$i]['s_'.($v+$num)].+$mess['load_on_'.floor($channel_p)].'seconds'));
                        }else {
                            $decode2['load_'.$i]['s_'.($v+$num)] = date("H:i:s", strtotime($decode2['load_'.$i]['e_'.floor(($v+$num)-1)].+$mess['load_off_'.floor($channel_p)].'seconds'));//;
                            $decode2['load_'.$i]['e_'.($v+$num)] = date("H:i:s", strtotime($decode2['load_'.$i]['s_'.($v+$num)].+$mess['load_on_'.floor($channel_p)].'seconds'));
                        }
                    }
                }
                return $decode2;
            }
            for($i = 1; $i<=12; $i++){
                $tb = 'tbn_control_au'.$i;
                $row_ac = $dbcon->query("SELECT * FROM $tb WHERE load_sn = '$house_master'  ORDER BY `load_id` DESC LIMIT 1")->fetch();
                for($y = 1; $y<=6; $y++){
                    if(count(explode(":", $row_ac['load_s_'.$y])) == 2){ $load_new['s_'.$y] = $row_ac['load_s_'.$y].':00'; }else { $load_new['s_'.$y] = $row_ac['load_s_'.$y]; }
                    if(count(explode(":", $row_ac['load_e_'.$y])) == 2){ $load_new['e_'.$y] = $row_ac['load_e_'.$y].':00'; }else { $load_new['e_'.$y] = $row_ac['load_e_'.$y]; }
                }
                $config_timeSet['load_'.$i] = [
                    'load_st_1' => $row_ac['load_st_1'],
                    'load_st_2' => $row_ac['load_st_2'],
                    'load_st_3' => $row_ac['load_st_3'],
                    'load_st_4' => $row_ac['load_st_4'],
                    'load_st_5' => $row_ac['load_st_5'],
                    'load_st_6' => $row_ac['load_st_6'],
                    'load_s_1' => $row_ac['load_s_1'],
                    'load_s_2' => $row_ac['load_s_2'],
                    'load_s_3' => $row_ac['load_s_3'],
                    'load_s_4' => $row_ac['load_s_4'],
                    'load_s_5' => $row_ac['load_s_5'],
                    'load_s_6' => $row_ac['load_s_6'],
                    'load_e_1' => $row_ac['load_e_1'],
                    'load_e_2' => $row_ac['load_e_2'],
                    'load_e_3' => $row_ac['load_e_3'],
                    'load_e_4' => $row_ac['load_e_4'],
                    'load_e_5' => $row_ac['load_e_5'],
                    'load_e_6' => $row_ac['load_e_6'],
                    'user_control' => $row_ac['load_user']
                ];
                if($i < 5 || ($i > 8 && $i < 12)){
                    // $config_timeLoop[] = $i;
                    $tb2 = 'tbn_control_ausub_'.$i;
                    $row_tloop = $dbcon->query("SELECT * FROM $tb2 WHERE load_sn = '$house_master'  ORDER BY `load_id` DESC LIMIT 1")->fetch();
                    $config_timeLoop['load_'.$i] = [
                        'load_st_1' => $row_tloop['load_st_1'],
                        'load_st_2' => $row_tloop['load_st_2'],
                        'load_st_3' => $row_tloop['load_st_3'],
                        'load_st_4' => $row_tloop['load_st_4'],
                        'load_st_5' => $row_tloop['load_st_5'],
                        'load_st_6' => $row_tloop['load_st_6'],
                        'load_s_1' => $row_tloop['load_s_1'],
                        'load_s_2' => $row_tloop['load_s_2'],
                        'load_s_3' => $row_tloop['load_s_3'],
                        'load_s_4' => $row_tloop['load_s_4'],
                        'load_s_5' => $row_tloop['load_s_5'],
                        'load_s_6' => $row_tloop['load_s_6'],
                        'load_cycle_1' => $row_tloop['load_cycle_1'],
                        'load_cycle_2' => $row_tloop['load_cycle_2'],
                        'load_cycle_3' => $row_tloop['load_cycle_3'],
                        'load_cycle_4' => $row_tloop['load_cycle_4'],
                        'load_cycle_5' => $row_tloop['load_cycle_5'],
                        'load_cycle_6' => $row_tloop['load_cycle_6'],
                        'load_on_1' => $row_tloop['load_on_1'],
                        'load_on_2' => $row_tloop['load_on_2'],
                        'load_on_3' => $row_tloop['load_on_3'],
                        'load_on_4' => $row_tloop['load_on_4'],
                        'load_on_5' => $row_tloop['load_on_5'],
                        'load_on_6' => $row_tloop['load_on_6'],
                        'load_off_1' => $row_tloop['load_off_1'],
                        'load_off_2' => $row_tloop['load_off_2'],
                        'load_off_3' => $row_tloop['load_off_3'],
                        'load_off_4' => $row_tloop['load_off_4'],
                        'load_off_5' => $row_tloop['load_off_5'],
                        'load_off_6' => $row_tloop['load_off_6'],
                        'user_control' => $row_tloop['load_user']
                    ];
                }

                // =====================
                if($i < 5 || ($i > 8 && $i < 12)){
                    if($sub_mode['sub_mode_'.$i] == 'Time_set'){
                        $time_auto['load_'.$i] = [
                            // 'load_st_1' => $row_ac['load_st_1'],
                            // 'load_st_2' => $row_ac['load_st_2'],
                            // 'load_st_3' => $row_ac['load_st_3'],
                            // 'load_st_4' => $row_ac['load_st_4'],
                            // 'load_st_5' => $row_ac['load_st_5'],
                            // 'load_st_6' => $row_ac['load_st_6'],
                            's_1' => $load_new['s_1'],
                            's_2' => $load_new['s_2'],
                            's_3' => $load_new['s_3'],
                            's_4' => $load_new['s_4'],
                            's_5' => $load_new['s_5'],
                            's_6' => $load_new['s_6'],
                            'e_1' => $load_new['e_1'],
                            'e_2' => $load_new['e_2'],
                            'e_3' => $load_new['e_3'],
                            'e_4' => $load_new['e_4'],
                            'e_5' => $load_new['e_5'],
                            'e_6' => $load_new['e_6']
                        ];
                    }
                    else if($sub_mode['sub_mode_'.$i] == 'Time_loop'){
                        // if($row_tloop['load_st_1'] == 1){
                        //     for ($v = 1; $v <= $row_tloop['load_cycle_1']; $v++) {
                        //         if($v == 1){
                        //             $time_auto['load_'.$i]['s_'.$v] = date("H:i:s", strtotime($config_timeLoop['load_'.$i]['load_s_1']));
                        //             $time_auto['load_'.$i]['e_'.$v] = date("H:i:s", strtotime($time_auto['load_'.$i]['s_'.$v].+$config_timeLoop['load_'.$i]['load_on_1'].'seconds'));
                        //             // $lastime[$v] = date("H:i:s", strtotime($time_auto['load_'.$i]['s_'.$v].+$config_timeLoop['load_'.$i]['load_on_1'].'seconds'));
                        //         }else {
                        //             $time_auto['load_'.$i]['s_'.$v] = date("H:i:s", strtotime($time_auto['load_'.$i]['e_'.floor($v-1)].+$config_timeLoop['load_'.$i]['load_off_1'].'seconds'));
                        //             $time_auto['load_'.$i]['e_'.$v] = date("H:i:s", strtotime($time_auto['load_'.$i]['s_'.$v].+$config_timeLoop['load_'.$i]['load_on_1'].'seconds'));
                        //         }
                        //     }
                        // }
                        // if($row_tloop['load_st_2'] == 1){
                        //     if($row_tloop['load_st_1'] == 1){$num = $row_tloop['load_cycle_1']; }else {$num = 0;}
                        //     for ($v = 1; $v <= $row_tloop['load_cycle_2']; $v++) {
                        //         if($num == 0){
                        //             // if($v == 1){
                        //             //     $time_auto['load_'.$i]['s_'.($v+$num)] = date("H:i:s", strtotime($time_auto['load_'.$i]['e_'.$num].+$config_timeLoop['load_'.$i]['load_off_1'].'seconds'));
                        //             //     $time_auto['load_'.$i]['e_'.($v+$num)] = date("H:i:s", strtotime($time_auto['load_'.$i]['s_'.($v+$num)].+$config_timeLoop['load_'.$i]['load_on_2'].'seconds'));
                        //             // }else {
                        //             //     $time_auto['load_'.$i]['s_'.($v+$num)] = date("H:i:s", strtotime($time_auto['load_'.$i]['e_'.floor(($v+$num)-1)].+$config_timeLoop['load_'.$i]['load_off_2'].'seconds'));
                        //             //     $time_auto['load_'.$i]['e_'.($v+$num)] = date("H:i:s", strtotime($time_auto['load_'.$i]['s_'.floor($v+$num)].+$config_timeLoop['load_'.$i]['load_on_2'].'seconds'));
                        //             // }
                        //             if($v == 1){
                        //                 $time_auto['load_'.$i]['s_'.$v] = date("H:i:s", strtotime($config_timeLoop['load_'.$i]['load_s_2']));
                        //                 $time_auto['load_'.$i]['e_'.$v] = date("H:i:s", strtotime($time_auto['load_'.$i]['s_'.$v].+$config_timeLoop['load_'.$i]['load_on_2'].'seconds'));
                        //             }else {
                        //                 $time_auto['load_'.$i]['s_'.$v] = date("H:i:s", strtotime($time_auto['load_'.$i]['e_'.floor($v-1)].+$config_timeLoop['load_'.$i]['load_off_2'].'seconds'));//;
                        //                 $time_auto['load_'.$i]['e_'.$v] = date("H:i:s", strtotime($time_auto['load_'.$i]['s_'.$v].+$config_timeLoop['load_'.$i]['load_on_2'].'seconds'));
                        //             }
                        //         }
                        //         else {
                        //             if($v == 1){
                        //                 $time_auto['load_'.$i]['s_'.($v+$num)] = date("H:i:s", strtotime($config_timeLoop['load_'.$i]['load_s_2']));
                        //                 $time_auto['load_'.$i]['e_'.($v+$num)] = date("H:i:s", strtotime($time_auto['load_'.$i]['s_'.($v+$num)].+$config_timeLoop['load_'.$i]['load_on_2'].'seconds'));
                        //             }else {
                        //                 $time_auto['load_'.$i]['s_'.($v+$num)] = date("H:i:s", strtotime($time_auto['load_'.$i]['e_'.floor(($v+$num)-1)].+$config_timeLoop['load_'.$i]['load_off_2'].'seconds'));//;
                        //                 $time_auto['load_'.$i]['e_'.($v+$num)] = date("H:i:s", strtotime($time_auto['load_'.$i]['s_'.($v+$num)].+$config_timeLoop['load_'.$i]['load_on_2'].'seconds'));
                        //             }
                        //         }
                        //     }
                        // }
                        // if($row_tloop['load_st_3'] == 1){
                        //     if($row_tloop['load_st_1'] == 0 && $row_tloop['load_st_2'] == 0){
                        //         $num = 0;
                        //     }else if($row_tloop['load_st_1'] == 0 && $row_tloop['load_st_2'] == 1){
                        //         $num = $row_tloop['load_cycle_2'];
                        //     }
                        //     else if($row_tloop['load_st_1'] == 1 && $row_tloop['load_st_2'] == 0){
                        //         $num = $row_tloop['load_cycle_1'];
                        //     }
                        //     else { // c1=1,c2=1
                        //         $num = floor($row_tloop['load_cycle_1']) + floor($row_tloop['load_cycle_2']);
                        //     }
                        //     for ($v = 1; $v <= $row_tloop['load_cycle_3']; $v++) {
                        //         if($num == 0){
                        //             if($v == 1){
                        //                 $time_auto['load_'.$i]['s_'.$v] = date("H:i:s", strtotime($config_timeLoop['load_'.$i]['load_s_3']));
                        //                 $time_auto['load_'.$i]['e_'.$v] = date("H:i:s", strtotime($time_auto['load_'.$i]['s_'.$v].+$config_timeLoop['load_'.$i]['load_on_3'].'seconds'));
                        //             }else {
                        //                 $time_auto['load_'.$i]['s_'.$v] = date("H:i:s", strtotime($time_auto['load_'.$i]['e_'.floor($v-1)].+$config_timeLoop['load_'.$i]['load_off_3'].'seconds'));//;
                        //                 $time_auto['load_'.$i]['e_'.$v] = date("H:i:s", strtotime($time_auto['load_'.$i]['s_'.$v].+$config_timeLoop['load_'.$i]['load_on_3'].'seconds'));
                        //             }
                        //         }else { //$num != 0
                        //             if($v == 1){
                        //                 $time_auto['load_'.$i]['s_'.($v+$num)] = date("H:i:s", strtotime($config_timeLoop['load_'.$i]['load_s_3']));
                        //                 $time_auto['load_'.$i]['e_'.($v+$num)] = date("H:i:s", strtotime($time_auto['load_'.$i]['s_'.($v+$num)].+$config_timeLoop['load_'.$i]['load_on_3'].'seconds'));
                        //             }else {
                        //                 $time_auto['load_'.$i]['s_'.($v+$num)] = date("H:i:s", strtotime($time_auto['load_'.$i]['e_'.floor(($v+$num)-1)].+$config_timeLoop['load_'.$i]['load_off_3'].'seconds'));//;
                        //                 $time_auto['load_'.$i]['e_'.($v+$num)] = date("H:i:s", strtotime($time_auto['load_'.$i]['s_'.($v+$num)].+$config_timeLoop['load_'.$i]['load_on_3'].'seconds'));
                        //             }
                        //         }
                        //     }
                        // }
                        // if($row_tloop['load_st_4'] == 1){
                        //           if($row_tloop['load_st_1'] == 0 && $row_tloop['load_st_2'] == 0 && $row_tloop['load_st_3'] == 0){
                        //         $num = 0;
                        //     }else if($row_tloop['load_st_1'] == 0 && $row_tloop['load_st_2'] == 0 && $row_tloop['load_st_3'] == 1){
                        //         $num = $row_tloop['load_cycle_3'];
                        //     }else if($row_tloop['load_st_1'] == 0 && $row_tloop['load_st_2'] == 1 && $row_tloop['load_st_3'] == 0){
                        //         $num = $row_tloop['load_cycle_2'];
                        //     }else if($row_tloop['load_st_1'] == 0 && $row_tloop['load_st_2'] == 1 && $row_tloop['load_st_3'] == 1){
                        //         $num = floor($row_tloop['load_cycle_2']) + floor($row_tloop['load_cycle_3']);
                        //     }else if($row_tloop['load_st_1'] == 1 && $row_tloop['load_st_2'] == 0 && $row_tloop['load_st_3'] == 0){
                        //         $num = $row_tloop['load_cycle_1'];
                        //     }else if($row_tloop['load_st_1'] == 1 && $row_tloop['load_st_2'] == 0 && $row_tloop['load_st_3'] == 1){
                        //         $num = floor($row_tloop['load_cycle_1']) + floor($row_tloop['load_cycle_3']);
                        //     }else if($row_tloop['load_st_1'] == 1 && $row_tloop['load_st_2'] == 1 && $row_tloop['load_st_3'] == 0){
                        //         $num = floor($row_tloop['load_cycle_1']) + floor($row_tloop['load_cycle_2']);
                        //     }
                        //     else { // c1=1,c2=1,c3=1
                        //         $num = floor($row_tloop['load_cycle_1']) + floor($row_tloop['load_cycle_2']) + floor($row_tloop['load_cycle_3']);
                        //     }
                        //     for ($v = 1; $v <= $row_tloop['load_cycle_3']; $v++) {
                        //         if($num == 0){
                        //             if($v == 1){
                        //                 $time_auto['load_'.$i]['s_'.$v] = date("H:i:s", strtotime($config_timeLoop['load_'.$i]['load_s_3']));
                        //                 $time_auto['load_'.$i]['e_'.$v] = date("H:i:s", strtotime($time_auto['load_'.$i]['s_'.$v].+$config_timeLoop['load_'.$i]['load_on_3'].'seconds'));
                        //             }else {
                        //                 $time_auto['load_'.$i]['s_'.$v] = date("H:i:s", strtotime($time_auto['load_'.$i]['e_'.floor($v-1)].+$config_timeLoop['load_'.$i]['load_off_3'].'seconds'));//;
                        //                 $time_auto['load_'.$i]['e_'.$v] = date("H:i:s", strtotime($time_auto['load_'.$i]['s_'.$v].+$config_timeLoop['load_'.$i]['load_on_3'].'seconds'));
                        //             }
                        //         }else { //$num != 0
                        //             if($v == 1){
                        //                 $time_auto['load_'.$i]['s_'.($v+$num)] = date("H:i:s", strtotime($config_timeLoop['load_'.$i]['load_s_3']));
                        //                 $time_auto['load_'.$i]['e_'.($v+$num)] = date("H:i:s", strtotime($time_auto['load_'.$i]['s_'.($v+$num)].+$config_timeLoop['load_'.$i]['load_on_3'].'seconds'));
                        //             }else {
                        //                 $time_auto['load_'.$i]['s_'.($v+$num)] = date("H:i:s", strtotime($time_auto['load_'.$i]['e_'.floor(($v+$num)-1)].+$config_timeLoop['load_'.$i]['load_off_3'].'seconds'));//;
                        //                 $time_auto['load_'.$i]['e_'.($v+$num)] = date("H:i:s", strtotime($time_auto['load_'.$i]['s_'.($v+$num)].+$config_timeLoop['load_'.$i]['load_on_3'].'seconds'));
                        //             }
                        //         }
                        //     }
                        // }

                        // $time_auto['load_'.$i]['load_st_1'] = $row_tloop['load_st_1'];
                        // $time_auto['load_'.$i]['load_st_2'] = $row_tloop['load_st_2'];
                        // $time_auto['load_'.$i]['load_st_3'] = $row_tloop['load_st_3'];
                        // $time_auto['load_'.$i]['load_st_4'] = $row_tloop['load_st_4'];
                        // $time_auto['load_'.$i]['load_st_5'] = $row_tloop['load_st_5'];
                        // $time_auto['load_'.$i]['load_st_6'] = $row_tloop['load_st_6'];
                        // ชชชชชชชชชชชชชชชชชช
                        $time_auto['load_'.$i] = [];
                        // if($i == 1){
                        //
                        // }
                        if($row_tloop['load_st_1'] == 1){
                            $time_auto = add_auto($i, 0, $config_timeLoop['load_'.$i]['load_cycle_1'], 1, $config_timeLoop['load_'.$i], $time_auto);
                            // $time_auto = add_auto($i, 0, $row_tloop['load_cycle_1'], 1, $config_timeLoop, $time_auto);
                        }
                        if($row_tloop['load_st_2'] == 1){
                            if($row_tloop['load_st_1'] == 1){$num2 = $row_tloop['load_cycle_1']; }else {$num2 = 0;}
                            $time_auto = add_auto($i, $num2, $config_timeLoop['load_'.$i]['load_cycle_2'], 2, $config_timeLoop['load_'.$i], $time_auto);
                            // $time_auto[] = add_auto($i, $num2, $row_tloop['load_cycle_2'], 2, $config_timeLoop, $time_auto);
                        }
                        if($row_tloop['load_st_3'] == 1){
                            if($row_tloop['load_st_1'] == 1){$num3[] = $row_tloop['load_cycle_1']; }else {$num3[] = 0;}
                            if($row_tloop['load_st_2'] == 1){$num3[] = $row_tloop['load_cycle_2']; }else {$num3[] = 0;}
                            $time_auto = add_auto($i, array_sum($num3), $config_timeLoop['load_'.$i]['load_cycle_3'], 3, $config_timeLoop['load_'.$i], $time_auto);
                            // $time_auto[] = add_auto($i, array_sum($num3), $row_tloop['load_cycle_3'], 3, $config_timeLoop, $time_auto);
                        }
                        if($row_tloop['load_st_4'] == 1){
                            if($row_tloop['load_st_1'] == 1){$num4[] = $row_tloop['load_cycle_1']; }else {$num4[] = 0;}
                            if($row_tloop['load_st_2'] == 1){$num4[] = $row_tloop['load_cycle_2']; }else {$num4[] = 0;}
                            if($row_tloop['load_st_3'] == 1){$num4[] = $row_tloop['load_cycle_3']; }else {$num4[] = 0;}
                            $time_auto = add_auto($i, array_sum($num4), $config_timeLoop['load_'.$i]['load_cycle_4'], 4, $config_timeLoop['load_'.$i], $time_auto);
                            // $time_auto[] = add_auto($i, array_sum($num4), $row_tloop['load_cycle_4'], 4, $config_timeLoop, $time_auto);
                        }
                        if($row_tloop['load_st_5'] == 1){
                            if($row_tloop['load_st_1'] == 1){$num5[] = $row_tloop['load_cycle_1']; }else {$num5[] = 0;}
                            if($row_tloop['load_st_2'] == 1){$num5[] = $row_tloop['load_cycle_2']; }else {$num5[] = 0;}
                            if($row_tloop['load_st_3'] == 1){$num5[] = $row_tloop['load_cycle_3']; }else {$num5[] = 0;}
                            if($row_tloop['load_st_4'] == 1){$num5[] = $row_tloop['load_cycle_4']; }else {$num5[] = 0;}
                            $time_auto = add_auto($i, array_sum($num5), $config_timeLoop['load_'.$i]['load_cycle_5'], 5, $config_timeLoop['load_'.$i], $time_auto);
                            // $time_auto[] = add_auto($i, array_sum($num5), $row_tloop['load_cycle_5'], 5, $config_timeLoop, $time_auto);
                        }
                        if($row_tloop['load_st_6'] == 1){
                            if($row_tloop['load_st_1'] == 1){$num6[] = $row_tloop['load_cycle_1']; }else {$num6[] = 0;}
                            if($row_tloop['load_st_2'] == 1){$num6[] = $row_tloop['load_cycle_2']; }else {$num6[] = 0;}
                            if($row_tloop['load_st_3'] == 1){$num6[] = $row_tloop['load_cycle_3']; }else {$num6[] = 0;}
                            if($row_tloop['load_st_4'] == 1){$num6[] = $row_tloop['load_cycle_4']; }else {$num6[] = 0;}
                            if($row_tloop['load_st_5'] == 1){$num6[] = $row_tloop['load_cycle_5']; }else {$num6[] = 0;}
                            $time_auto = add_auto($i, array_sum($num6), $config_timeLoop['load_'.$i]['load_cycle_6'], 6, $config_timeLoop['load_'.$i], $time_auto);
                            // $time_auto[] = add_auto($i, array_sum($num6), $row_tloop['load_cycle_6'], 6, $config_timeLoop, $time_auto);
                        }
                    }
                }
                else { // i=5,6,7,8,12
                    // if($i == 12){
                    //     $time_auto['load_'.$i] = [
                    //         'load_st_1' => $row_ac['load_st_1'],
                    //         'load_st_2' => $row_ac['load_st_2'],
                    //         'load_st_3' => $row_ac['load_st_3'],
                    //         'load_st_4' => $row_ac['load_st_4'],
                    //         'load_st_5' => $row_ac['load_st_5'],
                    //         'load_st_6' => $row_ac['load_st_6'],
                    //         's_1' => $load_new['s_1'],
                    //         's_2' => $load_new['s_2'],
                    //         's_3' => $load_new['s_3'],
                    //         's_4' => $load_new['s_4'],
                    //         's_5' => $load_new['s_5'],
                    //         's_6' => $load_new['s_6'],
                    //         'e_1' => $load_new['e_1'],
                    //         'e_2' => $load_new['e_2'],
                    //         'e_3' => $load_new['e_3'],
                    //         'e_4' => $load_new['e_4'],
                    //         'e_5' => $load_new['e_5'],
                    //         'e_6' => $load_new['e_6']
                    //     ];
                    // }else {
                        $time_auto['load_'.$i] = [
                            // 'load_st_1' => $row_ac['load_st_1'],
                            // 'load_st_2' => $row_ac['load_st_2'],
                            // 'load_st_3' => $row_ac['load_st_3'],
                            // 'load_st_4' => $row_ac['load_st_4'],
                            // 'load_st_5' => $row_ac['load_st_5'],
                            // 'load_st_6' => $row_ac['load_st_6'],
                            's_1' => $load_new['s_1'],
                            's_2' => $load_new['s_2'],
                            's_3' => $load_new['s_3'],
                            's_4' => $load_new['s_4'],
                            's_5' => $load_new['s_5'],
                            's_6' => $load_new['s_6'],
                            'e_1' => $load_new['e_1'],
                            'e_2' => $load_new['e_2'],
                            'e_3' => $load_new['e_3'],
                            'e_4' => $load_new['e_4'],
                            'e_5' => $load_new['e_5'],
                            'e_6' => $load_new['e_6']
                        ];
                    // }
                }
                // =====================
                // if($i <= 4){
                //     $config_timeSet[] = '[dripper_'.$i.']';
                // }elseif ($i > 4 && $i <= 8) {
                //     $config_timeSet[] = '[fan_'.($i-4).']';
                // }elseif ($i > 8 && $i <= 10) {
                //     $config_timeSet[] = '[foggy_'.($i-8).']';
                // }elseif ($i == 11) {
                //     $config_timeSet[] = '[spray]';
                // }elseif ($i == 12) {
                //     $config_timeSet[] = '[shading]';
                // }
                //
                // if($row_ac['load_st_1'] == 1){
                //     $config_timeSet[] = 'S_1='.$row_ac['load_s_1'];
                //     $config_timeSet[] = 'E_1='.$row_ac['load_e_1'];
                // }else {
                //     $config_timeSet[] = 'S_1=99:99';
                //     $config_timeSet[] = 'E_1=99:99';
                // }
                // if($row_ac['load_st_2'] == 1){
                //     $config_timeSet[] = 'S_2='.$row_ac['load_s_2'];
                //     $config_timeSet[] = 'E_2='.$row_ac['load_e_2'];
                // }else {
                //     $config_timeSet[] = 'S_2=99:99';
                //     $config_timeSet[] = 'E_2=99:99';
                // }
                // if($row_ac['load_st_3'] == 1){
                //     $config_timeSet[] = 'S_3='.$row_ac['load_s_3'];
                //     $config_timeSet[] = 'E_3='.$row_ac['load_e_3'];
                // }else {
                //     $config_timeSet[] = 'S_3=99:99';
                //     $config_timeSet[] = 'E_3=99:99';
                // }
                // if($row_ac['load_st_4'] == 1){
                //     $config_timeSet[] = 'S_4='.$row_ac['load_s_4'];
                //     $config_timeSet[] = 'E_4='.$row_ac['load_e_4'];
                // }else {
                //     $config_timeSet[] = 'S_4=99:99';
                //     $config_timeSet[] = 'E_4=99:99';
                // }
                // if($row_ac['load_st_5'] == 1){
                //     $config_timeSet[] = 'S_5='.$row_ac['load_s_5'];
                //     $config_timeSet[] = 'E_5='.$row_ac['load_e_5'];
                // }else {
                //     $config_timeSet[] = 'S_5=99:99';
                //     $config_timeSet[] = 'E_5=99:99';
                // }
                // if($row_ac['load_st_6'] == 1){
                //     $config_timeSet[] = 'S_6='.$row_ac['load_s_6'];
                //     $config_timeSet[] = 'E_6='.$row_ac['load_e_6'];
                // }else {
                //     $config_timeSet[] = 'S_6=99:99';
                //     $config_timeSet[] = 'E_6=99:99';
                // }
            }
            // Exit config_timeSet - config_timeLoop

            $row_2 = $dbcon->query("SELECT * FROM tbn_status_cn WHERE cn_status_sn = '$house_master'")->fetch();
            $row_track = $dbcon->query("SELECT * FROM `tbn_control_sensor_tracking` WHERE auto_sensor_sn = '$house_master' ORDER BY `auto_sensor_timestamp` DESC LIMIT 1")->fetch();

            $track_sn['status_1']  = $row_track['auto_sensor_status_1'];
            $track_sn['status_2']  = $row_track['auto_sensor_status_2'];
            $track_sn['status_3']  = $row_track['auto_sensor_status_3'];
            $track_sn['status_4']  = $row_track['auto_sensor_status_4'];
            $track_sn['temp_min']  = $row_track['auto_sensor_temp_min'];
            $track_sn['temp_max']  = $row_track['auto_sensor_temp_max'];
            $track_sn['hum_min']   = $row_track['auto_sensor_hum_min'];
            $track_sn['hum_max']   = $row_track['auto_sensor_hum_max'];
            $track_sn['hum_max2']  = $row_track['auto_sensor_hum_2'];
            $track_sn['light_min'] = $row_track['auto_sensor_light_min'];
            $track_sn['light_max'] = $row_track['auto_sensor_light_max'];
            $track_sn['soil_min']  = $row_track['auto_sensor_soil_min'];
            $track_sn['soil_max'] = $row_track['auto_sensor_soil_max'];
            if($row_2['cn_status_1'] == 1){ $track_sn['dripper_1'] = $row_track['auto_sensor_d_1']; }else { $track_sn['dripper_1'] = 'OFF'; }
            if($row_2['cn_status_2'] == '1'){ $track_sn['dripper_2'] = $row_track['auto_sensor_d_2']; }else { $track_sn['dripper_2'] = 'OFF'; }
            if($row_2['cn_status_3'] == '1'){ $track_sn['dripper_3'] = $row_track['auto_sensor_d_3']; }else { $track_sn['dripper_3'] = 'OFF'; }
            if($row_2['cn_status_4'] == '1'){ $track_sn['dripper_4'] = $row_track['auto_sensor_d_4']; }else { $track_sn['dripper_4'] = 'OFF'; }
            if($row_2['cn_status_5'] == '1'){ $track_sn['fan_1']     = $row_track['auto_sensor_fn_1']; }else { $track_sn['fan_1'] = 'OFF'; }
            if($row_2['cn_status_6'] == '1'){ $track_sn['fan_2']     = $row_track['auto_sensor_fn_2']; }else { $track_sn['fan_2'] = 'OFF'; }
            if($row_2['cn_status_7'] == '1'){ $track_sn['fan_3']     = $row_track['auto_sensor_fn_3']; }else { $track_sn['fan_3'] = 'OFF'; }
            if($row_2['cn_status_8'] == '1'){ $track_sn['fan_4']     = $row_track['auto_sensor_fn_4']; }else { $track_sn['fan_4'] = 'OFF'; }
            if($row_2['cn_status_9'] == '1'){ $track_sn['foggy_1']   = $row_track['auto_sensor_fg_1']; }else { $track_sn['foggy_1'] = 'OFF'; }
            if($row_2['cn_status_10'] == '1'){ $track_sn['foggy_2']  = $row_track['auto_sensor_fg_2']; }else { $track_sn['foggy_2'] = 'OFF'; }
            if($row_2['cn_status_11'] == '1'){ $track_sn['spray']    = $row_track['auto_sensor_sp']; }else { $track_sn['spray'] = 'OFF'; }
            if($row_2['cn_status_12'] == '1'){ $track_sn['shading']  = $row_track['auto_sensor_sh']; }else { $track_sn['shading'] = 'OFF'; }
            $track_sn['user_control'] = $row_track['auto_sensor_user'];
            $track_sn['light_in_mode'] = $dbcon->query("SELECT sn_sensor_6 FROM tbn_status_sn WHERE sn_status_sn = '$house_master' ORDER BY `sn_status_id` DESC LIMIT 1")->fetch()[0];

            $h_mast = $dbcon->query("SELECT house_eq, house_control_V FROM tbn_house WHERE house_master = '$house_master' ORDER BY `house_id` DESC LIMIT 1")->fetch();
            $mqtt->publish($house_master.'/control/set_config', json_encode([
                "mode"           =>  $control_response['mode'],
                "sub_mode"       =>  $sub_mode,
                "config_manual"  =>  $config_manual,
                "config_timeSet" =>  $config_timeSet,
                "config_timeLoop"=>  $config_timeLoop,
                "config_tracking"=>  $track_sn,
                "eq"             =>  $h_mast[0],
                "control_V"      =>  $h_mast[1]
            ]), 1);
            $mqtt->publish($house_master.'/control/config/time_auto', json_encode($time_auto), 1);
            // Exit ท่อ set_config

            // $row_6 = $dbcon->query("SELECT * FROM tb_set_maxmin WHERE set_maxmin_sn = '$house_master'")->fetch();
            // $set_maxmin = [
            //     'Tmin' => $row_6["set_Tmin"],
            //     'Tmax' => $row_6["set_Tmax"],
            //     'Hmin' => $row_6["set_Hmin"],
            //     'Hmax' => $row_6["set_Hmax"],
            //     'Lmin' => $row_6["set_Lmin"],
            //     'Lmax' => $row_6["set_Lmax"],
            //     'Smin' => $row_6["set_Smin"],
            //     'Smax' => $row_6["set_Smax"]
            // ];

        }
        $mqtt2 = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());
        if ($mqtt2->connect(true,NULL,$username,$password)) {
            // ท่อ Load Status_Manual ------------------------------------
            if($row_2['cn_status_1'] == '1'){
                $c_drip[] = 1;
                if($row_cont_log['cn_load_1'] == "ON"){
                    $drip[] = 1;
                }else {
                    $drip[] = 0;
                }
            }else { $c_drip[] = 0; $drip[] = 0; }
            if($row_2['cn_status_2'] == '1'){
                $c_drip[] = 1;
                if($row_cont_log['cn_load_2'] == "ON"){
                    $drip[] = 1;
                }else {
                    $drip[] = 0;
                }
            }else { $c_drip[] = 0; $drip[] = 0; }
            if($row_2['cn_status_3'] == '1'){
                $c_drip[] = 1;
                if($row_cont_log['cn_load_3'] == "ON"){
                    $drip[] = 1;
                }else {
                    $drip[] = 0;
                }
            }else { $c_drip[] = 0; $drip[] = 0; }
            if($row_2['cn_status_4'] == '1'){
                $c_drip[] = 1;
                if($row_cont_log['cn_load_4'] == "ON"){
                    $drip[] = 1;
                }else {
                    $drip[] = 0;
                }
            }else { $c_drip[] = 0; $drip[] = 0; }
            if(count(array_keys($c_drip, 1)) == 0 ){
                $st_drip = 'OFF';
            }else{
                if(count(array_keys($c_drip, 1)) == count(array_keys($drip, 1))){ $st_drip = 'ON'; }else { $st_drip = 'OFF'; }
            }
            if($row_2['cn_status_5'] == '1'){
                $c_fan[] = 1;
                if($row_cont_log['cn_load_5'] == "ON"){
                    $fan[] = 1;
                }else {
                    $fan[] = 0;
                }
            }else { $c_fan[] = 0; $fan[] = 0; }
            if($row_2['cn_status_6'] == '1'){
                $c_fan[] = 1;
                if($row_cont_log['cn_load_6'] == "ON"){
                    $fan[] = 1;
                }else {
                    $fan[] = 0;
                }
            }else { $c_fan[] = 0; $fan[] = 0; }
            if($row_2['cn_status_7'] == '1'){
                $c_fan[] = 1;
                if($row_cont_log['cn_load_7'] == "ON"){
                    $fan[] = 1;
                }else {
                    $fan[] = 0;
                }
            }else { $c_fan[] = 0; $fan[] = 0; }
            if($row_2['cn_status_8'] == '1'){
                $c_fan[] = 1;
                if($row_cont_log['cn_load_8'] == "ON"){
                    $fan[] = 1;
                }else {
                    $fan[] = 0;
                }
            }else { $c_fan[] = 0; $fan[] = 0; }
            if(count(array_keys($c_fan, 1)) == 0){
                $st_fan = 'OFF';
            }else{
                if(count(array_keys($c_fan, 1)) == count(array_keys($fan, 1))){$st_fan = 'ON';}else {$st_fan = 'OFF';}
            }
            if($row_2['cn_status_9'] == '1'){
                $c_foggy[] = 1;
                if($row_cont_log['cn_load_9'] == "ON"){
                    $foggy[] = 1;
                }else {
                    $foggy[] = 0;
                }
            }else { $c_foggy[] = 0; $foggy[] = 0; }
            if($row_2['cn_status_10'] == '1'){
                $c_foggy[] = 1;
                if($row_cont_log['cn_load_10'] == "ON"){
                    $foggy[] = 1;
                }else {
                    $foggy[] = 0;
                }
            }else { $c_foggy[] = 0; $foggy[] = 0; }
            if(count(array_keys($c_foggy, 1)) == 0){
                $st_foggy = 'OFF';
            }else{
                if(count(array_keys($c_foggy, 1)) == count(array_keys($foggy, 1))){$st_foggy = 'ON';}else {$st_foggy = 'OFF';}
            }
            // $loads = [
            //     // "mode"    => $row_cont_log['cn_mode'],
            //     "dripper" => $st_drip,
            //     "fan"     => $st_fan,
            //     "foggy"   => $st_foggy,
            //     "spray"     => $row_cont_log['cn_load_11'],
            //     "shading"   => $row_cont_log['cn_load_12'],
            //     // "user_control" => $row_cont_log['cn_user']
            // ];
            $mqtt2->publish($house_master.'/control/loads/mode',         $control_response['mode'], 1);
            $mqtt2->publish($house_master.'/control/loads/dripper',      $st_drip, 1);
            $mqtt2->publish($house_master.'/control/loads/fan',          $st_fan, 1);
            $mqtt2->publish($house_master.'/control/loads/foggy',        $st_foggy, 1);
            $mqtt2->publish($house_master.'/control/loads/spray',        $control_response['spray'], 1);
            $mqtt2->publish($house_master.'/control/loads/shading',      $control_response['shading'], 1);
            $mqtt2->publish($house_master.'/control/loads/user_control', $control_response['user_control'], 1);
            // exit ท่อ Load Status_Manual ------------------------------------

            // ท่อ สมการ
            $row_eq = $dbcon->query("SELECT * FROM tbn_equation WHERE equation_sn = '$house_master' ORDER BY equation_timestamp DESC LIMIT 1")->fetch();
            $data_eq = [
                "sn"   => $row_eq['equation_sn'],
                "e_1"  => $row_eq['equation_ch_1'],
                "e_2"  => $row_eq['equation_ch_2'],
                "e_3"  => $row_eq['equation_ch_3'],
                "e_4"  => $row_eq['equation_ch_4'],
                "e_5"  => $row_eq['equation_ch_5'],
                "e_6"  => $row_eq['equation_ch_6'],
                "e_7"  => $row_eq['equation_ch_7'],
                "user" => $row_eq['equation_user']
            ];
            $mqtt2->publish($house_master.'/data_sensor/equation', json_encode($data_eq), 1);
            $mqtt2->publish('web_system', '0', 1);
            
            // Exit ท่อ สมการ
            // echo json_encode($data_eq);
            // exit();
            // ==============================


            echo json_encode([
                'house_master'          => $house_master,
                // 'master_number'      => $numb,
                'control_response'      => $control_response,
                // 'sting_manual'          => $coc,
                // 'config_sub_mode'    => $sub_mode,
                // 'config_manual'      => $config_manual,
                // 'config_timeSet'     => $config_timeSet,
                // 'config_timeLoop'    => $config_timeLoop,
                // 'status_load_manual' => $loads,
                // 'equation'           => $data_eq,
                // 'config_tracking'    => ''
                // 'syst' => $ss
            ]);
        }
        $mqtt->close();
    }

// {"sub_mode":{"sub_mode":"Timer","sub_mode_1":"Time_loop","sub_mode_2":"Time_set","sub_mode_3":"Time_set","sub_mode_4":"Time_set","sub_mode_9":"Time_set","sub_mode_10":"Time_set","sub_mode_11":"Time_set","user_control":"superAdmin","sub_mode_":"Tracking"},"config_manual":{"dripper_1":"ON","dripper_2":"ON","dripper_3":"ON","dripper_4":"ON","fan_1":"OFF","fan_2":"ON","fan_3":"OFF","fan_4":"OFF","foggy_1":"OFF","foggy_2":"ON"},"config_timeSet":{"load_1":{"load_st_1":1,"load_st_2":0,"load_st_3":0,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"19:26","load_s_2":"","load_s_3":"","load_s_4":"","load_s_5":"","load_s_6":"","load_e_1":"19:28","load_e_2":"","load_e_3":"","load_e_4":"","load_e_5":"","load_e_6":""},"load_2":{"load_st_1":0,"load_st_2":0,"load_st_3":0,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"","load_s_2":"","load_s_3":"","load_s_4":"","load_s_5":"","load_s_6":"","load_e_1":"","load_e_2":"","load_e_3":"","load_e_4":"","load_e_5":"","load_e_6":""},"load_3":{"load_st_1":0,"load_st_2":0,"load_st_3":0,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"","load_s_2":"","load_s_3":"","load_s_4":"","load_s_5":"","load_s_6":"","load_e_1":"","load_e_2":"","load_e_3":"","load_e_4":"","load_e_5":"","load_e_6":""},"load_4":{"load_st_1":0,"load_st_2":0,"load_st_3":0,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"","load_s_2":"","load_s_3":"","load_s_4":"","load_s_5":"","load_s_6":"","load_e_1":"","load_e_2":"","load_e_3":"","load_e_4":"","load_e_5":"","load_e_6":""},"load_5":{"load_st_1":0,"load_st_2":0,"load_st_3":0,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"","load_s_2":"","load_s_3":"","load_s_4":"","load_s_5":"","load_s_6":"","load_e_1":"","load_e_2":"","load_e_3":"","load_e_4":"","load_e_5":"","load_e_6":""},"load_6":{"load_st_1":0,"load_st_2":0,"load_st_3":0,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"","load_s_2":"","load_s_3":"","load_s_4":"","load_s_5":"","load_s_6":"","load_e_1":"","load_e_2":"","load_e_3":"","load_e_4":"","load_e_5":"","load_e_6":""},"load_7":{"load_st_1":0,"load_st_2":0,"load_st_3":0,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"","load_s_2":"","load_s_3":"","load_s_4":"","load_s_5":"","load_s_6":"","load_e_1":"","load_e_2":"","load_e_3":"","load_e_4":"","load_e_5":"","load_e_6":""},"load_8":{"load_st_1":0,"load_st_2":0,"load_st_3":0,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"","load_s_2":"","load_s_3":"","load_s_4":"","load_s_5":"","load_s_6":"","load_e_1":"","load_e_2":"","load_e_3":"","load_e_4":"","load_e_5":"","load_e_6":""},"load_9":{"load_st_1":0,"load_st_2":0,"load_st_3":0,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"","load_s_2":"","load_s_3":"","load_s_4":"","load_s_5":"","load_s_6":"","load_e_1":"","load_e_2":"","load_e_3":"","load_e_4":"","load_e_5":"","load_e_6":""},"load_10":{"load_st_1":0,"load_st_2":0,"load_st_3":0,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"","load_s_2":"","load_s_3":"","load_s_4":"","load_s_5":"","load_s_6":"","load_e_1":"","load_e_2":"","load_e_3":"","load_e_4":"","load_e_5":"","load_e_6":""},"load_11":{"load_st_1":1,"load_st_2":0,"load_st_3":1,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"10:48","load_s_2":"","load_s_3":"10:51","load_s_4":"","load_s_5":"","load_s_6":"","load_e_1":"10:50","load_e_2":"","load_e_3":"10:52","load_e_4":"","load_e_5":"","load_e_6":""},"load_12":{"load_st_1":0,"load_st_2":0,"load_st_3":0,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"","load_s_2":"","load_s_3":"","load_s_4":"","load_s_5":"","load_s_6":"","load_e_1":"","load_e_2":"","load_e_3":"","load_e_4":"","load_e_5":"","load_e_6":""}},"config_timeLoop":{"load_1":{"load_st_1":0,"load_st_2":0,"load_st_3":0,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"","load_s_2":"","load_s_3":"","load_s_4":"","load_s_5":"","load_s_6":"","load_cycle_1":0,"load_cycle_2":0,"load_cycle_3":0,"load_cycle_4":0,"load_cycle_5":0,"load_cycle_6":0,"load_on_1":"","load_on_2":"","load_on_3":"","load_on_4":"","load_on_5":"","load_on_6":"","load_off_1":"","load_off_2":"","load_off_3":"","load_off_4":"","load_off_5":"","load_off_6":""},"load_2":{"load_st_1":0,"load_st_2":0,"load_st_3":0,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"","load_s_2":"","load_s_3":"","load_s_4":"","load_s_5":"","load_s_6":"","load_cycle_1":0,"load_cycle_2":0,"load_cycle_3":0,"load_cycle_4":0,"load_cycle_5":0,"load_cycle_6":0,"load_on_1":"","load_on_2":"","load_on_3":"","load_on_4":"","load_on_5":"","load_on_6":"","load_off_1":"","load_off_2":"","load_off_3":"","load_off_4":"","load_off_5":"","load_off_6":""},"load_3":{"load_st_1":0,"load_st_2":0,"load_st_3":0,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"","load_s_2":"","load_s_3":"","load_s_4":"","load_s_5":"","load_s_6":"","load_cycle_1":0,"load_cycle_2":0,"load_cycle_3":0,"load_cycle_4":0,"load_cycle_5":0,"load_cycle_6":0,"load_on_1":"","load_on_2":"","load_on_3":"","load_on_4":"","load_on_5":"","load_on_6":"","load_off_1":"","load_off_2":"","load_off_3":"","load_off_4":"","load_off_5":"","load_off_6":""},"load_4":{"load_st_1":0,"load_st_2":0,"load_st_3":0,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"","load_s_2":"","load_s_3":"","load_s_4":"","load_s_5":"","load_s_6":"","load_cycle_1":0,"load_cycle_2":0,"load_cycle_3":0,"load_cycle_4":0,"load_cycle_5":0,"load_cycle_6":0,"load_on_1":"","load_on_2":"","load_on_3":"","load_on_4":"","load_on_5":"","load_on_6":"","load_off_1":"","load_off_2":"","load_off_3":"","load_off_4":"","load_off_5":"","load_off_6":""},"load_9":{"load_st_1":0,"load_st_2":0,"load_st_3":0,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"","load_s_2":"","load_s_3":"","load_s_4":"","load_s_5":"","load_s_6":"","load_cycle_1":0,"load_cycle_2":0,"load_cycle_3":0,"load_cycle_4":0,"load_cycle_5":0,"load_cycle_6":0,"load_on_1":"","load_on_2":"","load_on_3":"","load_on_4":"","load_on_5":"","load_on_6":"","load_off_1":"","load_off_2":"","load_off_3":"","load_off_4":"","load_off_5":"","load_off_6":""},"load_10":{"load_st_1":0,"load_st_2":0,"load_st_3":0,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"","load_s_2":"","load_s_3":"","load_s_4":"","load_s_5":"","load_s_6":"","load_cycle_1":0,"load_cycle_2":0,"load_cycle_3":0,"load_cycle_4":0,"load_cycle_5":0,"load_cycle_6":0,"load_on_1":"","load_on_2":"","load_on_3":"","load_on_4":"","load_on_5":"","load_on_6":"","load_off_1":"","load_off_2":"","load_off_3":"","load_off_4":"","load_off_5":"","load_off_6":""},"load_11":{"load_st_1":0,"load_st_2":0,"load_st_3":0,"load_st_4":0,"load_st_5":0,"load_st_6":0,"load_s_1":"","load_s_2":"","load_s_3":"","load_s_4":"","load_s_5":"","load_s_6":"","load_cycle_1":0,"load_cycle_2":0,"load_cycle_3":0,"load_cycle_4":0,"load_cycle_5":0,"load_cycle_6":0,"load_on_1":"","load_on_2":"","load_on_3":"","load_on_4":"","load_on_5":"","load_on_6":"","load_off_1":"","load_off_2":"","load_off_3":"","load_off_4":"","load_off_5":"","load_off_6":""}}}
// TUSMT008/control/config/mode_auto
    
