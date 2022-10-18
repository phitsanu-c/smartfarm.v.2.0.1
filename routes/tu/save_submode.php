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

        if($mode == 'submode' || $mode == 'subtimer'){
            $decode = json_decode(substr($mqtt->subscribeAndWaitForMessage($house_master.'/control/set_config', 1), 2), true);
            // $data_smode = $decode['sub_mode'];
            if($mode == 'submode'){
                $decode['sub_mode']['sub_mode'] = $mess;
                $decode['sub_mode']['user_control'] = $_SESSION["account_user"];
            }
            elseif ($mode == 'subtimer') {
                $decode['sub_mode']['sub_mode_'.$channel] = $mess;
                $decode['sub_mode']['user_control'] = $_SESSION["account_user"];
            }
            // echo json_encode($decode['sub_mode']);
            $dbcon->prepare("INSERT INTO `tbn_control_config`(`cc_sn`, `cc_user`, `cc_submode`, `cc_submode_1`, `cc_submode_2`, `cc_submode_3`, `cc_submode_4`, `cc_submode_9`, `cc_submode_10`, `cc_submode_11`) VALUES (:sn, :user_control, :sub_mode, :sub_mode_1, :sub_mode_2, :sub_mode_3, :sub_mode_4, :sub_mode_9, :sub_mode_10, :sub_mode_11)")->execute($decode['sub_mode']);
            // $mqtt->loop(true);
            $mqtt->publish($house_master.'/control/set_config', json_encode($decode), 1);
        }
        elseif ($mode == 'mode') {
            $mqtt->publish($house_master.'/control/loads/user_control', $_SESSION["account_user"], 1);
            $mqtt->publish($house_master.'/control/loads/mode', $mess, 1);
        }
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
            if($channel == 12){
                $decode2['load_'.$channel] = [
                    'load_st_1' => floor($mess['load_st_1']),
                    'load_st_2' => floor($mess['load_st_2']),
                    'load_st_3' => floor($mess['load_st_3']),
                    'load_st_4' => floor($mess['load_st_4']),
                    'load_st_5' => floor($mess['load_st_5']),
                    'load_st_6' => floor($mess['load_st_6']),
                    's_1' => $mess['load_s_1'],
                    's_2' => $mess['load_s_2'],
                    's_3' => $mess['load_s_3'],
                    's_4' => $mess['load_s_4'],
                    's_5' => $mess['load_s_5'],
                    's_6' => $mess['load_s_6'],
                    'e_1' => $mess['load_e_1'],
                    'e_2' => $mess['load_e_2'],
                    'e_3' => $mess['load_e_3'],
                    'e_4' => $mess['load_e_4'],
                    'e_5' => $mess['load_e_5'],
                    'e_6' => $mess['load_e_6']
                ];
            }else {
                $decode2['load_'.$channel] = [
                    's_1' => $mess['load_s_1'],
                    's_2' => $mess['load_s_2'],
                    's_3' => $mess['load_s_3'],
                    's_4' => $mess['load_s_4'],
                    's_5' => $mess['load_s_5'],
                    's_6' => $mess['load_s_6'],
                    'e_1' => $mess['load_e_1'],
                    'e_2' => $mess['load_e_2'],
                    'e_3' => $mess['load_e_3'],
                    'e_4' => $mess['load_e_4'],
                    'e_5' => $mess['load_e_5'],
                    'e_6' => $mess['load_e_6']
                ];
            }
            $mqtt->publish($house_master.'/control/loads/user_control', $_SESSION["account_user"], 1);
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

            $mqtt->publish( $house_master.'/control/config/time_auto', json_encode($decode2), 1);
            echo json_encode(['status' => "Insert_Success", 'config_data' => $decode, 'config_time' => $decode2]);
        }
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
            $mqtt->publish( $house_master.'/control/set_config', json_encode($decode), 1);
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
            echo json_encode(['status' => "Insert_Success", 'config_data' => $decode, 'config_time' => $decode2]);
        }
        $mqtt->publish("web_system", json_encode($decodedJson), 1);
        // echo json_encode($data_smode);
        $mqtt->close();
    }
