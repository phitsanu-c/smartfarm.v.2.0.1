<?php
    require "../connectdb.php";
    require 'phpMQTT.php';
    $host = '203.150.37.144';     // change if necessary
    $port = 1883;                     // change if necessary
    $username = '';                   // set your username
    $password = '';                   // set your password
    // $topic = "web_system";
    $mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());

    $house_master = $_POST["house_master"];
    $mess = $_POST["mess"];
    $channel = $_POST['channel'];
    $mode = $_POST['mode'];
    // echo $house_master.' '.$channel.' '.$mode.' '.$mess;
    // exit();
    //
    if ($mqtt->connect(true,NULL,$username,$password)) {
        $data_mq = $mqtt->subscribeAndWaitForMessage("web_system", 1);
        $decodedJson = json_decode(substr($data_mq, 2), true);
        $new_dt = ['account_id' => $_SESSION['account_id'], 'name' => $_SESSION["account_user"], 'dt' => date("Y-m-d H:i:s", strtotime('3 hour')), 'siteID' => $_SESSION["sn"]['siteID'], 'count_site' => $_SESSION['sn']['count_site']]; // '-6 hour'));
        $decodedJson[$_SESSION['account_id']] = $new_dt;
        // echo json_encode($decodedJson);

        // เปลี่ยนซัพโหมด
        if($mode == 'submode' || $mode == 'subtimer'){
            $decode = json_decode(substr($mqtt->subscribeAndWaitForMessage($house_master.'/control/set_config', 1), 2), true);
            // $data_smode = $decode['sub_mode'];
            if($mode == 'submode'){
                // เปลี่ยนโหมด ตามเซนเซอร์ หรือ timer
                $decode['sub_mode']['sub_mode'] = $mess;
                $decode['sub_mode']['user_control'] = $_SESSION["account_user"];
            }
            elseif ($mode == 'subtimer') {
                $decode2 = json_decode(substr($mqtt->subscribeAndWaitForMessage($house_master.'/control/config/time_auto', 1), 2), true);
                // เปลี่ยนโหมด timer หรือ time_loop
                $decode['sub_mode']['sub_mode_'.$channel] = $mess;
                $decode['sub_mode']['user_control'] = $_SESSION["account_user"];
                // echo $mess;
                if($mess == 'Time_set'){ // Time_set
                    $decode2['load_'.$channel] = [
                        's_1' => $decode['config_timeSet']['load_'.$channel]['load_s_1'],
                        's_2' => $decode['config_timeSet']['load_'.$channel]['load_s_2'],
                        's_3' => $decode['config_timeSet']['load_'.$channel]['load_s_3'],
                        's_4' => $decode['config_timeSet']['load_'.$channel]['load_s_4'],
                        's_5' => $decode['config_timeSet']['load_'.$channel]['load_s_5'],
                        's_6' => $decode['config_timeSet']['load_'.$channel]['load_s_6'],
                        'e_1' => $decode['config_timeSet']['load_'.$channel]['load_e_1'],
                        'e_2' => $decode['config_timeSet']['load_'.$channel]['load_e_2'],
                        'e_3' => $decode['config_timeSet']['load_'.$channel]['load_e_3'],
                        'e_4' => $decode['config_timeSet']['load_'.$channel]['load_e_4'],
                        'e_5' => $decode['config_timeSet']['load_'.$channel]['load_e_5'],
                        'e_6' => $decode['config_timeSet']['load_'.$channel]['load_e_6']
                    ];
                }else { // Time_loop
                    $decode2['load_'.$channel] = [];
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
                    if($decode['config_timeLoop']['load_'.$channel]['load_st_1'] == 1){
                        $decode2 = add_auto($channel, 0, $decode['config_timeLoop']['load_'.$channel]['load_cycle_1'], 1, $decode['config_timeLoop']['load_'.$channel], $decode2);
                    }
                    if($decode['config_timeLoop']['load_'.$channel]['load_st_2'] == 1){
                        if($decode['config_timeLoop']['load_'.$channel]['load_st_1'] == 1){$num2 = $decode['config_timeLoop']['load_'.$channel]['load_cycle_1']; }else {$num2 = 0;}
                        $decode2 = add_auto($channel, $num2, $decode['config_timeLoop']['load_'.$channel]['load_cycle_2'], 2, $decode['config_timeLoop']['load_'.$channel], $decode2);
                    }
                    if($decode['config_timeLoop']['load_'.$channel]['load_st_3'] == 1){
                        if($decode['config_timeLoop']['load_'.$channel]['load_st_1'] == 1){$num3[] = $decode['config_timeLoop']['load_'.$channel]['load_cycle_1']; }else {$num3[] = 0;}
                        if($decode['config_timeLoop']['load_'.$channel]['load_st_2'] == 1){$num3[] = $decode['config_timeLoop']['load_'.$channel]['load_cycle_2']; }else {$num3[] = 0;}
                        $decode2 = add_auto($channel, array_sum($num3), $decode['config_timeLoop']['load_'.$channel]['load_cycle_3'], 3, $decode['config_timeLoop']['load_'.$channel], $decode2);
                    }
                    if($decode['config_timeLoop']['load_'.$channel]['load_st_4'] == 1){
                        if($decode['config_timeLoop']['load_'.$channel]['load_st_1'] == 1){$num4[] = $decode['config_timeLoop']['load_'.$channel]['load_cycle_1']; }else {$num4[] = 0;}
                        if($decode['config_timeLoop']['load_'.$channel]['load_st_2'] == 1){$num4[] = $decode['config_timeLoop']['load_'.$channel]['load_cycle_2']; }else {$num4[] = 0;}
                        if($decode['config_timeLoop']['load_'.$channel]['load_st_3'] == 1){$num4[] = $decode['config_timeLoop']['load_'.$channel]['load_cycle_3']; }else {$num4[] = 0;}
                        $decode2 = add_auto($channel, array_sum($num4), $decode['config_timeLoop']['load_'.$channel]['load_cycle_4'], 4, $decode['config_timeLoop']['load_'.$channel], $decode2);
                    }
                    if($decode['config_timeLoop']['load_'.$channel]['load_st_5'] == 1){
                        if($decode['config_timeLoop']['load_'.$channel]['load_st_1'] == 1){$num5[] = $decode['config_timeLoop']['load_'.$channel]['load_cycle_1']; }else {$num5[] = 0;}
                        if($decode['config_timeLoop']['load_'.$channel]['load_st_2'] == 1){$num5[] = $decode['config_timeLoop']['load_'.$channel]['load_cycle_2']; }else {$num5[] = 0;}
                        if($decode['config_timeLoop']['load_'.$channel]['load_st_3'] == 1){$num5[] = $decode['config_timeLoop']['load_'.$channel]['load_cycle_3']; }else {$num5[] = 0;}
                        if($decode['config_timeLoop']['load_'.$channel]['load_st_4'] == 1){$num5[] = $decode['config_timeLoop']['load_'.$channel]['load_cycle_4']; }else {$num5[] = 0;}
                        $decode2 = add_auto($channel, array_sum($num5), $decode['config_timeLoop']['load_'.$channel]['load_cycle_5'], 5, $decode['config_timeLoop']['load_'.$channel], $decode2);
                    }
                    if($decode['config_timeLoop']['load_'.$channel]['load_st_6'] == 1){
                        if($decode['config_timeLoop']['load_'.$channel]['load_st_1'] == 1){$num6[] = $decode['config_timeLoop']['load_'.$channel]['load_cycle_1']; }else {$num6[] = 0;}
                        if($decode['config_timeLoop']['load_'.$channel]['load_st_2'] == 1){$num6[] = $decode['config_timeLoop']['load_'.$channel]['load_cycle_2']; }else {$num6[] = 0;}
                        if($decode['config_timeLoop']['load_'.$channel]['load_st_3'] == 1){$num6[] = $decode['config_timeLoop']['load_'.$channel]['load_cycle_3']; }else {$num6[] = 0;}
                        if($decode['config_timeLoop']['load_'.$channel]['load_st_4'] == 1){$num6[] = $decode['config_timeLoop']['load_'.$channel]['load_cycle_4']; }else {$num6[] = 0;}
                        if($decode['config_timeLoop']['load_'.$channel]['load_st_5'] == 1){$num6[] = $decode['config_timeLoop']['load_'.$channel]['load_cycle_5']; }else {$num6[] = 0;}
                        $decode2 = add_auto($channel, array_sum($num6), $decode['config_timeLoop']['load_'.$channel]['load_cycle_6'], 6, $decode['config_timeLoop']['load_'.$channel], $decode2);
                    }
                }
                // echo json_encode($decode2);
                $mqtt->publish( $house_master.'/control/config/time_auto', json_encode($decode2), 1);
            }
            $mqtt->publish($house_master.'/control/set_config', json_encode($decode), 1);
            $dbcon->prepare("INSERT INTO `tbn_control_config`(`cc_sn`, `cc_user`, `cc_submode`, `cc_submode_1`, `cc_submode_2`, `cc_submode_3`, `cc_submode_4`, `cc_submode_9`, `cc_submode_10`, `cc_submode_11`) VALUES (:sn, :user_control, :sub_mode, :sub_mode_1, :sub_mode_2, :sub_mode_3, :sub_mode_4, :sub_mode_9, :sub_mode_10, :sub_mode_11)")->execute($decode['sub_mode']);
            echo json_encode(['status' => "Insert_Success", 'data' => $mess ], JSON_UNESCAPED_UNICODE );
        }
        // เปลี่ยนโหมด
        elseif ($mode == 'mode') {
            // echo $mess;
            $mqtt->publish($house_master.'/control/loads/user_control', $_SESSION["account_user"], 1);
            $mqtt->publish($house_master.'/control/loads/mode', $mess, 1);
            // $decode = json_decode(substr($mqtt->subscribeAndWaitForMessage($house_master.'/control/set_config', 1), 2), true);
            // $decode['mode'] = $mess;
            // $mqtt->publish( $house_master.'/control/set_config', json_encode($decode), 1);
            echo json_encode(['status' => "Insert_Success", 'data' => $mess ], JSON_UNESCAPED_UNICODE );
        }
        // ตั้งค่า time ปกติ
        elseif ($mode == 'config_timeSet') {
            $decode = json_decode(substr($mqtt->subscribeAndWaitForMessage($house_master.'/control/set_config', 1), 2), true);
            $decode2 = json_decode(substr($mqtt->subscribeAndWaitForMessage($house_master.'/control/config/time_auto', 1), 2), true);
            $decode['config_timeSet']['load_'.$channel] = [
                'load_st_1' => floor($mess['load_st_1']),
                'load_st_2' => floor($mess['load_st_2']),
                'load_st_3' => floor($mess['load_st_3']),
                'load_st_4' => floor($mess['load_st_4']),
                'load_st_5' => floor($mess['load_st_5']),
                'load_st_6' => floor($mess['load_st_6']),
                'load_s_1' => $mess['load_s_1'],
                'load_s_2' => $mess['load_s_2'],
                'load_s_3' => $mess['load_s_3'],
                'load_s_4' => $mess['load_s_4'],
                'load_s_5' => $mess['load_s_5'],
                'load_s_6' => $mess['load_s_6'],
                'load_e_1' => $mess['load_e_1'],
                'load_e_2' => $mess['load_e_2'],
                'load_e_3' => $mess['load_e_3'],
                'load_e_4' => $mess['load_e_4'],
                'load_e_5' => $mess['load_e_5'],
                'load_e_6' => $mess['load_e_6'],
                'user_control' => $_SESSION["account_user"]
            ];
            // if($channel == 12){
            //     $decode2['load_'.$channel] = [
            //         'load_st_1' => floor($mess['load_st_1']),
            //         'load_st_2' => floor($mess['load_st_2']),
            //         'load_st_3' => floor($mess['load_st_3']),
            //         'load_st_4' => floor($mess['load_st_4']),
            //         'load_st_5' => floor($mess['load_st_5']),
            //         'load_st_6' => floor($mess['load_st_6']),
            //         's_1' => $mess['load_s_1'],
            //         's_2' => $mess['load_s_2'],
            //         's_3' => $mess['load_s_3'],
            //         's_4' => $mess['load_s_4'],
            //         's_5' => $mess['load_s_5'],
            //         's_6' => $mess['load_s_6'],
            //         'e_1' => $mess['load_e_1'],
            //         'e_2' => $mess['load_e_2'],
            //         'e_3' => $mess['load_e_3'],
            //         'e_4' => $mess['load_e_4'],
            //         'e_5' => $mess['load_e_5'],
            //         'e_6' => $mess['load_e_6']
            //     ];
            // }
            // else {
            if($mess['load_s_1'] != ''){ $decode2['load_'.$channel]['s_1'] = date( "H:i:s", strtotime($mess['load_s_1']) ); }else { $decode2['load_'.$channel]['s_1'] = $mess['load_s_1']; }
            if($mess['load_s_2'] != ''){ $decode2['load_'.$channel]['s_2'] = date( "H:i:s", strtotime($mess['load_s_2']) ); }else { $decode2['load_'.$channel]['s_2'] = $mess['load_s_2']; }
            if($mess['load_s_3'] != ''){ $decode2['load_'.$channel]['s_3'] = date( "H:i:s", strtotime($mess['load_s_3']) ); }else { $decode2['load_'.$channel]['s_3'] = $mess['load_s_3']; }
            if($mess['load_s_4'] != ''){ $decode2['load_'.$channel]['s_4'] = date( "H:i:s", strtotime($mess['load_s_4']) ); }else { $decode2['load_'.$channel]['s_4'] = $mess['load_s_4']; }
            if($mess['load_s_5'] != ''){ $decode2['load_'.$channel]['s_5'] = date( "H:i:s", strtotime($mess['load_s_5']) ); }else { $decode2['load_'.$channel]['s_5'] = $mess['load_s_5']; }
            if($mess['load_s_6'] != ''){ $decode2['load_'.$channel]['s_6'] = date( "H:i:s", strtotime($mess['load_s_6']) ); }else { $decode2['load_'.$channel]['s_6'] = $mess['load_s_6']; }
            if($mess['load_e_1'] != ''){ $decode2['load_'.$channel]['e_1'] = date( "H:i:s", strtotime($mess['load_e_1']) ); }else { $decode2['load_'.$channel]['e_1'] = $mess['load_e_1']; }
            if($mess['load_e_2'] != ''){ $decode2['load_'.$channel]['e_2'] = date( "H:i:s", strtotime($mess['load_e_2']) ); }else { $decode2['load_'.$channel]['e_2'] = $mess['load_e_2']; }
            if($mess['load_e_3'] != ''){ $decode2['load_'.$channel]['e_3'] = date( "H:i:s", strtotime($mess['load_e_3']) ); }else { $decode2['load_'.$channel]['e_3'] = $mess['load_e_3']; }
            if($mess['load_e_4'] != ''){ $decode2['load_'.$channel]['e_4'] = date( "H:i:s", strtotime($mess['load_e_4']) ); }else { $decode2['load_'.$channel]['e_4'] = $mess['load_e_4']; }
            if($mess['load_e_5'] != ''){ $decode2['load_'.$channel]['e_5'] = date( "H:i:s", strtotime($mess['load_e_5']) ); }else { $decode2['load_'.$channel]['e_5'] = $mess['load_e_5']; }
            if($mess['load_e_6'] != ''){ $decode2['load_'.$channel]['e_6'] = date( "H:i:s", strtotime($mess['load_e_6']) ); }else { $decode2['load_'.$channel]['e_6'] = $mess['load_e_6']; }
            // $decode2['load_'.$channel] = [
            //     's_1' => date( "H:i:s", strtotime($mess['load_s_1']) ),
            //     's_2' => date( "H:i:s", strtotime($mess['load_s_2']) ),
            //     's_3' => date( "H:i:s", strtotime($mess['load_s_3']) ),
            //     's_4' => date( "H:i:s", strtotime($mess['load_s_4']) ),
            //     's_5' => date( "H:i:s", strtotime($mess['load_s_5']) ),
            //     's_6' => date( "H:i:s", strtotime($mess['load_s_6']) ),
            //     'e_1' => date( "H:i:s", strtotime($mess['load_e_1']) ),
            //     'e_2' => date( "H:i:s", strtotime($mess['load_e_2']) ),
            //     'e_3' => date( "H:i:s", strtotime($mess['load_e_3']) ),
            //     'e_4' => date( "H:i:s", strtotime($mess['load_e_4']) ),
            //     'e_5' => date( "H:i:s", strtotime($mess['load_e_5']) ),
            //     'e_6' => date( "H:i:s", strtotime($mess['load_e_6']) )
            // ];
            // }
            $mqtt->publish($house_master.'/control/loads/user_control', $_SESSION["account_user"], 1);
            $mqtt->publish($house_master.'/control/config/time_auto', json_encode($decode2), 1);
            $mqtt->publish($house_master.'/control/set_config', json_encode($decode), 1);
            $decode['config_timeSet']['load_'.$channel]['sn'] = $house_master;
            $tb_name = 'tbn_control_au'.$channel;
            $dbcon->prepare("INSERT INTO $tb_name (`load_sn`, `load_user`,
                `load_st_1`, `load_st_2`, `load_st_3`, `load_st_4`, `load_st_5`, `load_st_6`,
                `load_s_1`,  `load_s_2`,  `load_s_3`,  `load_s_4`,  `load_s_5`,  `load_s_6`,
                `load_e_1`,  `load_e_2`,  `load_e_3`,  `load_e_4`,  `load_e_5`,  `load_e_6`) VALUES (:sn, :user_control,
                :load_st_1,  :load_st_2,  :load_st_3,  :load_st_4,  :load_st_5,  :load_st_6,
                :load_s_1,   :load_s_2,   :load_s_3,   :load_s_4,   :load_s_5,   :load_s_6,
                :load_e_1,   :load_e_2,   :load_e_3,   :load_e_4,   :load_e_5,   :load_e_6)")->execute($decode['config_timeSet']['load_'.$channel]);
            echo json_encode(['status' => "Insert_Success", 'config_data' => $decode, 'config_time' => $decode2]);
        }
        // คั้งค่า time_Loop
        elseif ($mode == 'config_timeLoop') {
            $decode = json_decode(substr($mqtt->subscribeAndWaitForMessage($house_master.'/control/set_config', 1), 2), true);
            $decode2 = json_decode(substr($mqtt->subscribeAndWaitForMessage($house_master.'/control/config/time_auto', 1), 2), true);
            $decode['config_timeLoop']['load_'.$channel] = [
                'load_st_1' => floor($mess['load_st_1']),
                'load_st_2' => floor($mess['load_st_2']),
                'load_st_3' => floor($mess['load_st_3']),
                'load_st_4' => floor($mess['load_st_4']),
                'load_st_5' => floor($mess['load_st_5']),
                'load_st_6' => floor($mess['load_st_6']),
                'load_s_1' => $mess['load_s_1'],
                'load_s_2' => $mess['load_s_2'],
                'load_s_3' => $mess['load_s_3'],
                'load_s_4' => $mess['load_s_4'],
                'load_s_5' => $mess['load_s_5'],
                'load_s_6' => $mess['load_s_6'],
                'load_cycle_1' => floor($mess['load_cycle_1']),
                'load_cycle_2' => floor($mess['load_cycle_2']),
                'load_cycle_3' => floor($mess['load_cycle_3']),
                'load_cycle_4' => floor($mess['load_cycle_4']),
                'load_cycle_5' => floor($mess['load_cycle_5']),
                'load_cycle_6' => floor($mess['load_cycle_6']),
                'load_on_1' => $mess['load_on_1'],
                'load_on_2' => $mess['load_on_2'],
                'load_on_3' => $mess['load_on_3'],
                'load_on_4' => $mess['load_on_4'],
                'load_on_5' => $mess['load_on_5'],
                'load_on_6' => $mess['load_on_6'],
                'load_off_1' => $mess['load_off_1'],
                'load_off_2' => $mess['load_off_2'],
                'load_off_3' => $mess['load_off_3'],
                'load_off_4' => $mess['load_off_4'],
                'load_off_5' => $mess['load_off_5'],
                'load_off_6' => $mess['load_off_6'],
                'user_control' => $_SESSION["account_user"]
            ];
            $mqtt->publish($house_master.'/control/loads/user_control', $_SESSION["account_user"], 1);
            $mqtt->publish( $house_master.'/control/set_config', json_encode($decode), 1);$decode2['load_'.$channel] = [];
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
            if($mess['load_st_1'] == 1){
                $decode2 = add_auto($channel, 0, $mess['load_cycle_1'], 1, $mess, $decode2);
            }
            if($mess['load_st_2'] == 1){
                if($mess['load_st_1'] == 1){$num2 = $mess['load_cycle_1']; }else {$num2 = 0;}
                $decode2 = add_auto($channel, $num2, $mess['load_cycle_2'], 2, $mess, $decode2);
            }
            if($mess['load_st_3'] == 1){
                if($mess['load_st_1'] == 1){$num3[] = $mess['load_cycle_1']; }else {$num3[] = 0;}
                if($mess['load_st_2'] == 1){$num3[] = $mess['load_cycle_2']; }else {$num3[] = 0;}
                $decode2 = add_auto($channel, array_sum($num3), $mess['load_cycle_3'], 3, $mess, $decode2);
            }
            if($mess['load_st_4'] == 1){
                if($mess['load_st_1'] == 1){$num4[] = $mess['load_cycle_1']; }else {$num4[] = 0;}
                if($mess['load_st_2'] == 1){$num4[] = $mess['load_cycle_2']; }else {$num4[] = 0;}
                if($mess['load_st_3'] == 1){$num4[] = $mess['load_cycle_3']; }else {$num4[] = 0;}
                $decode2 = add_auto($channel, array_sum($num4), $mess['load_cycle_4'], 4, $mess, $decode2);
            }
            if($mess['load_st_5'] == 1){
                if($mess['load_st_1'] == 1){$num5[] = $mess['load_cycle_1']; }else {$num5[] = 0;}
                if($mess['load_st_2'] == 1){$num5[] = $mess['load_cycle_2']; }else {$num5[] = 0;}
                if($mess['load_st_3'] == 1){$num5[] = $mess['load_cycle_3']; }else {$num5[] = 0;}
                if($mess['load_st_4'] == 1){$num5[] = $mess['load_cycle_4']; }else {$num5[] = 0;}
                $decode2 = add_auto($channel, array_sum($num5), $mess['load_cycle_5'], 5, $mess, $decode2);
            }
            if($mess['load_st_6'] == 1){
                if($mess['load_st_1'] == 1){$num6[] = $mess['load_cycle_1']; }else {$num6[] = 0;}
                if($mess['load_st_2'] == 1){$num6[] = $mess['load_cycle_2']; }else {$num6[] = 0;}
                if($mess['load_st_3'] == 1){$num6[] = $mess['load_cycle_3']; }else {$num6[] = 0;}
                if($mess['load_st_4'] == 1){$num6[] = $mess['load_cycle_4']; }else {$num6[] = 0;}
                if($mess['load_st_5'] == 1){$num6[] = $mess['load_cycle_5']; }else {$num6[] = 0;}
                $decode2 = add_auto($channel, array_sum($num6), $mess['load_cycle_6'], 6, $mess, $decode2);
            }
            $mqtt->publish( $house_master.'/control/config/time_auto', json_encode($decode2), 1);

            $decode['config_timeLoop']['load_'.$channel]['sn'] = $house_master;
            $tb_name = 'tbn_control_ausub_'.$channel;
            $dbcon->prepare("INSERT INTO $tb_name (`load_sn`, `load_user`,
                `load_st_1`, `load_st_2`, `load_st_3`, `load_st_4`, `load_st_5`, `load_st_6`,
                `load_s_1`, `load_s_2`, `load_s_3`, `load_s_4`, `load_s_5`, `load_s_6`,
                `load_cycle_1`, `load_cycle_2`, `load_cycle_3`, `load_cycle_4`, `load_cycle_5`, `load_cycle_6`,
                `load_on_1`, `load_on_2`, `load_on_3`, `load_on_4`, `load_on_5`, `load_on_6`,
                `load_off_1`, `load_off_2`, `load_off_3`, `load_off_4`, `load_off_5`, `load_off_6`)
                VALUES (:sn, :user_control,
                :load_st_1,     :load_st_2,     :load_st_3,     :load_st_4,     :load_st_5,     :load_st_6,
                :load_s_1,      :load_s_2,      :load_s_3,      :load_s_4,      :load_s_5,      :load_s_6,
                :load_cycle_1,  :load_cycle_2,  :load_cycle_3,  :load_cycle_4,  :load_cycle_5,  :load_cycle_6,
                :load_on_1,     :load_on_2,     :load_on_3,     :load_on_4,     :load_on_5,     :load_on_6,
                :load_off_1,    :load_off_2,    :load_off_3,    :load_off_4,    :load_off_5,    :load_off_6)")->execute($decode['config_timeLoop']['load_'.$channel]);

            // $decode2['load_'.$channel]['load_st_1'] = floor($mess['load_st_1']);
            // $decode2['load_'.$channel]['load_st_2'] = floor($mess['load_st_2']);
            // $decode2['load_'.$channel]['load_st_3'] = floor($mess['load_st_3']);
            // $decode2['load_'.$channel]['load_st_4'] = floor($mess['load_st_4']);
            // $decode2['load_'.$channel]['load_st_5'] = floor($mess['load_st_5']);
            // $decode2['load_'.$channel]['load_st_6'] = floor($mess['load_st_6']);
            echo json_encode(['status' => "Insert_Success", 'config_data' => $decode, 'config_time' => $decode2]);
        }
        // ตั้งค่า Sensor_Tracking
        elseif ($mode == 'Sensor_Tracking') {
            $decode = json_decode(substr($mqtt->subscribeAndWaitForMessage($house_master.'/control/set_config', 1), 2), true);
            $decode['config_tracking'] = [
                "status_1" => floor($mess['status_1']),
                "status_2" => floor($mess['status_2']),
                "status_3" => floor($mess['status_3']),
                "status_4" => floor($mess['status_4']),
                "temp_min"  => floor($mess['temp_min']),
                "temp_max"  => floor($mess['temp_max']),
                "hum_min"   => floor($mess['hum_min']),
                "hum_max"   => floor($mess['hum_max']),
                "hum_max2"   => floor($mess['hum_max2']),
                "light_min" => floor($mess['light_min']),
                "light_max" => floor($mess['light_max']),
                "soil_min"  => floor($mess['soil_min']),
                "soil_max"  => floor($mess['soil_max']),
                "dripper_1" => $mess['dripper_1'],
                "dripper_2" => $mess['dripper_2'],
                "dripper_3" => $mess['dripper_3'],
                "dripper_4" => $mess['dripper_4'],
                "fan_1"     => $mess['fan_1'],
                "fan_2"     => $mess['fan_2'],
                "fan_3"     => $mess['fan_3'],
                "fan_4"     => $mess['fan_4'],
                "foggy_1"   => $mess['foggy_1'],
                "foggy_2"   => $mess['foggy_2'],
                "spray"     => $mess['spray'],
                "shading"   => $mess['shading'],
                "user_control" => $_SESSION["account_user"],
                "light_in_mode" => floor($mess['light_in_mode'])
            ];
            // echo json_encode($decode['config_tracking']);
            // exit();
            $mqtt->publish( $house_master.'/control/set_config', json_encode($decode), 1);
            unset($decode['config_tracking']['light_in_mode']);
            $decode['config_tracking']['sn'] = $house_master;
            $dbcon->prepare("INSERT INTO `tbn_control_sensor_tracking`(`auto_sensor_sn`, `auto_sensor_user`,
                `auto_sensor_status_1`, `auto_sensor_status_2`, `auto_sensor_status_3`, `auto_sensor_status_4`,
                `auto_sensor_temp_min`, `auto_sensor_temp_max`,
                `auto_sensor_hum_min`, `auto_sensor_hum_max`, `auto_sensor_hum_2`,
                `auto_sensor_light_min`, `auto_sensor_light_max`,
                `auto_sensor_soil_min`, `auto_sensor_soil_max`,
                `auto_sensor_d_1`, `auto_sensor_d_2`, `auto_sensor_d_3`, `auto_sensor_d_4`,
                `auto_sensor_fn_1`, `auto_sensor_fn_2`, `auto_sensor_fn_3`, `auto_sensor_fn_4`,
                `auto_sensor_fg_1`, `auto_sensor_fg_2`, `auto_sensor_sp`, `auto_sensor_sh`)
                VALUES (:sn, :user_control,
                 :status_1, :status_2, :status_3, :status_4,
                 :temp_min, :temp_max,
                 :hum_min, :hum_max, :hum_max2,
                 :light_min, :light_max,
                 :soil_min, :soil_max,
                 :dripper_1, :dripper_2, :dripper_3, :dripper_4,
                 :fan_1, :fan_2, :fan_3, :fan_4,
                 :foggy_1, :foggy_2, :spray, :shading)
            ")->execute($decode['config_tracking']);
            echo json_encode(['status' => "Insert_Success", 'config_data' => $decode]);
        }
        // ตั้งค่า sw_manual
        elseif ($mode == 'set_manual') {
            $decode = json_decode(substr($mqtt->subscribeAndWaitForMessage($house_master.'/control/set_config', 1), 2), true);
            if($channel == 1){
                $decode['config_manual']['dripper_1'] = $mess['sw_1'];
                $decode['config_manual']['dripper_2'] = $mess['sw_2'];
                $decode['config_manual']['dripper_3'] = $mess['sw_3'];
                $decode['config_manual']['dripper_4'] = $mess['sw_4'];
            }elseif ($channel == 2) {
                $decode['config_manual']['fan_1'] = $mess['sw_1'];
                $decode['config_manual']['fan_2'] = $mess['sw_2'];
                $decode['config_manual']['fan_3'] = $mess['sw_3'];
                $decode['config_manual']['fan_4'] = $mess['sw_4'];
            }elseif ($channel == 3) {
                $decode['config_manual']['foggy_1'] = $mess['sw_1'];
                $decode['config_manual']['foggy_2'] = $mess['sw_2'];
            }
            $decode['config_manual']["control_user"] = $_SESSION["account_user"];
            $mqtt->publish( $house_master.'/control/set_config', json_encode($decode), 1);
            unset($decode['mode']);
            // echo json_encode($decode['config_manual']);
            // exit();
            $sql = "INSERT INTO `tbn_control_mn_log`(`mn_sn`, `mn_user`,
                            `mn_load_1`, `mn_load_2`, `mn_load_3`, `mn_load_4`, `mn_load_5`, `mn_load_6`,
                            `mn_load_7`, `mn_load_8`, `mn_load_9`, `mn_load_10`, `mn_load_11`, `mn_load_12`)
                    VALUES (:serial_id, :control_user,
                            :dripper_1, :dripper_2, :dripper_3, :dripper_4,
                            :fan_1, :fan_2, :fan_3, :fan_4,
                            :foggy_1, :foggy_2, :spray, :shading)";
            if ($dbcon->prepare($sql)->execute($decode['config_manual']) === TRUE) {
                $manual_set = '[config]
serial_id='.$house_master.'
dripper_1='.$decode['config_manual']['dripper_1'].'
dripper_2='.$decode['config_manual']['dripper_2'].'
dripper_3='.$decode['config_manual']['dripper_3'].'
dripper_4='.$decode['config_manual']['dripper_4'].'
fan_1='.$decode['config_manual']['fan_1'].'
fan_2='.$decode['config_manual']['fan_2'].'
fan_3='.$decode['config_manual']['fan_3'].'
fan_4='.$decode['config_manual']['fan_4'].'
foggy_1='.$decode['config_manual']['foggy_1'].'
foggy_2='.$decode['config_manual']['foggy_2'];
                $mqtt->publish( $house_master.'/control/config/manual', $manual_set, 1);
                echo json_encode(['status' => "Insert_Success", 'data' => $decode ], JSON_UNESCAPED_UNICODE );
            }else{
                echo json_encode(['status' => "Insert_Error ", 'data' => '' ], JSON_UNESCAPED_UNICODE );
            }
        }
        elseif ($mode == 'manual_load') {
            $mqtt->publish( $house_master.'/control/loads/user_control', $_SESSION["account_user"], 1);
            if ($channel == 1) {
                $mqtt->publish( $house_master.'/control/loads/dripper', $mess, 1);
                echo json_encode(['status' => "Insert_Success", 'data' => $mess ], JSON_UNESCAPED_UNICODE );
            } elseif ($channel == 2) {
                $mqtt->publish( $house_master.'/control/loads/fan', $mess, 1);
                echo json_encode(['status' => "Insert_Success", 'data' => $mess ], JSON_UNESCAPED_UNICODE );
            } elseif ($channel == 3) {
                $mqtt->publish( $house_master.'/control/loads/foggy', $mess, 1);
                echo json_encode(['status' => "Insert_Success", 'data' => $mess ], JSON_UNESCAPED_UNICODE );
            } elseif ($channel == 4) {
                $mqtt->publish( $house_master.'/control/loads/spray', $mess, 1);
                echo json_encode(['status' => "Insert_Success", 'data' => $mess ], JSON_UNESCAPED_UNICODE );
            } elseif ($channel == 5) {
                $mqtt->publish( $house_master.'/control/loads/shading', $mess, 1);
                echo json_encode(['status' => "Insert_Success", 'data' => $mess ], JSON_UNESCAPED_UNICODE );
            }
        }
        elseif ($mode == 'lock_unlock') {
            $data = [
                'sn' => $house_master,
                'status' => $mess,
                'user' => $_SESSION["account_user"]
            ];
            $sql = "INSERT INTO `tbn_panel_lock`(`panel_lock_sn`, `panel_lock_status`, `panel_lock_user`) VALUES (:sn, :status, :user)";
            if ($dbcon->prepare($sql)->execute($data) === TRUE) {
                $mqtt->publish( $house_master.'/control/loads/spanel', $mess, 1);
                echo json_encode(['status' => "Insert_Success", 'data' => $data ], JSON_UNESCAPED_UNICODE );
            }else{
                echo json_encode(['status' => "Insert_Error ", 'data' => '' ], JSON_UNESCAPED_UNICODE );
            }
        }
        $mqtt->publish("web_system", json_encode($decodedJson), 1);
        // echo json_encode($data_smode);
    }
    $mqtt->close();

    // if($load_select <= 4){
    //     $load_data_mqtt = ['dripper_'.$load_select => $data];
    // }elseif($load_select > 4 && $load_select <= 8){
    //     $load_data_mqtt = ['fan_'.$load_select => $data];
    // }elseif($load_select > 8 && $load_select <= 10){
    //     $load_data_mqtt = ['foggy_'.$load_select => $data];
    // }elseif($load_select == 11){
    //     $load_data_mqtt = ['spray' => $data];
    // }elseif($load_select == 12){
    //     $load_data_mqtt = ['shading' => $data];
    // }
