<?php
    require "../connectdb.php";
    require 'phpMQTT.php';
    $host = '203.150.37.144';     // change if necessary
    $port = 1883;                     // change if necessary
    $username = '';                   // set your username
    $password = '';                   // set your password
    $topic = "web_system";
    $mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());
    //
    if ($mqtt->connect(true,NULL,$username,$password)) {
        $data_mq = $mqtt->subscribeAndWaitForMessage($topic, 1);
        $decodedJson = json_decode(substr($data_mq, 2), true);
        $new_dt = ['account_id' => $_SESSION['account_id'], 'name' => $_SESSION["account_user"], 'dt' => date("Y-m-d").' '.date("H:i:s", strtotime('3 hour')), 'siteID' => $_SESSION["sn"]['siteID'], 'count_site' => $_SESSION['sn']['count_site']]; // '-6 hour'));
        $decodedJson[$_SESSION['account_id']] = $new_dt;
        $message = json_encode($decodedJson);
        $mqtt->publish($topic,$message, 1);
        $mqtt->close();
    }

    $house_master = $_POST["house_master"];
    $load_select = $_POST["hidden_select_sw_auto"];

    $post_data = [
        "sw_1" => $_POST["sw_1"],
        "sw_2" => $_POST["sw_2"],
        "sw_3" => $_POST["sw_3"],
        "sw_4" => $_POST["sw_4"],
        "sw_5" => $_POST["sw_5"],
        "sw_6" => $_POST["sw_6"],
        "s_1"  => $_POST["s_1"],
        "s_2"  => $_POST["s_2"],
        "s_3"  => $_POST["s_3"],
        "s_4"  => $_POST["s_4"],
        "s_5"  => $_POST["s_5"],
        "s_6"  => $_POST["s_6"],
        "e_1"  => $_POST["e_1"],
        "e_2"  => $_POST["e_2"],
        "e_3"  => $_POST["e_3"],
        "e_4"  => $_POST["e_4"],
        "e_5"  => $_POST["e_5"],
        "e_6"  => $_POST["e_6"]
    ];
    // print_r($post_data);
    // exit();
    $tb_name = 'tbn_control_au'.$load_select;
    // $value = '';

    $post_data["load_sn"] = $house_master;
    $post_data["losd_user"] = $_SESSION["account_user"];

    $parseJSON = $_POST['parseJSON'];
    $parseJSON['load_'.$load_select] = [
        "load_st_1" => $_POST["sw_1"],
        "load_st_2" => $_POST["sw_2"],
        "load_st_3" => $_POST["sw_3"],
        "load_st_4" => $_POST["sw_4"],
        "load_st_5" => $_POST["sw_5"],
        "load_st_6" => $_POST["sw_6"],
        "load_s_1"  => $_POST["s_1"],
        "load_s_2"  => $_POST["s_2"],
        "load_s_3"  => $_POST["s_3"],
        "load_s_4"  => $_POST["s_4"],
        "load_s_5"  => $_POST["s_5"],
        "load_s_6"  => $_POST["s_6"],
        "load_e_1"  => $_POST["e_1"],
        "load_e_2"  => $_POST["e_2"],
        "load_e_3"  => $_POST["e_3"],
        "load_e_4"  => $_POST["e_4"],
        "load_e_5"  => $_POST["e_5"],
        "load_e_6"  => $_POST["e_6"]
    ];
    for($i = 1; $i <= count($parseJSON); $i++){
        if($i <= 4){
            $array[] = '[dripper_'.$i.']';
        }elseif ($i > 4 && $i <= 8) {
            $array[] = '[fan_'.($i-4).']';
        }elseif ($i > 8 && $i <= 10) {
            $array[] = '[foggy_'.($i-8).']';
        }elseif ($i == 11) {
            $array[] = '[spray]';
        }elseif ($i == 12) {
            $array[] = '[shading]';
        }

        if(isset($parseJSON['load_'.$i]['load_st_1'])){
            if($parseJSON['load_'.$i]['load_st_1'] == 1){
                $array[] = 'S_1='.$parseJSON['load_'.$i]['load_s_1'];
                $array[] = 'E_1='.$parseJSON['load_'.$i]['load_e_1'];
            }else {
                $array[] = 'S_1=99:99';
                $array[] = 'E_1=99:99';
            }
        }else {
            $array[] = 'S_1=99:99';
            $array[] = 'E_1=99:99';
        }
        if(isset($parseJSON['load_'.$i]['load_st_2'])){
            if($parseJSON['load_'.$i]['load_st_2'] == 1){
                $array[] = 'S_2='.$parseJSON['load_'.$i]['load_s_2'];
                $array[] = 'E_2='.$parseJSON['load_'.$i]['load_e_2'];
            }else {
                $array[] = 'S_2=99:99';
                $array[] = 'E_2=99:99';
            }
        }else {
            $array[] = 'S_2=99:99';
            $array[] = 'E_2=99:99';
        }
        if(isset($parseJSON['load_'.$i]['load_st_3'])){
            if($parseJSON['load_'.$i]['load_st_3'] == 1){
                $array[] = 'S_3='.$parseJSON['load_'.$i]['load_s_3'];
                $array[] = 'E_3='.$parseJSON['load_'.$i]['load_e_3'];
            }else {
                $array[] = 'S_3=99:99';
                $array[] = 'E_3=99:99';
            }
        }else {
            $array[] = 'S_3=99:99';
            $array[] = 'E_3=99:99';
        }
        if(isset($parseJSON['load_'.$i]['load_st_4'])){
            if($parseJSON['load_'.$i]['load_st_4'] == 1){
                $array[] = 'S_4='.$parseJSON['load_'.$i]['load_s_4'];
                $array[] = 'E_4='.$parseJSON['load_'.$i]['load_e_4'];
            }else {
                $array[] = 'S_4=99:99';
                $array[] = 'E_4=99:99';
            }
        }else {
            $array[] = 'S_4=99:99';
            $array[] = 'E_4=99:99';
        }
        if(isset($parseJSON['load_'.$i]['load_st_5'])){
            if($parseJSON['load_'.$i]['load_st_5'] == 1){
                $array[] = 'S_5='.$parseJSON['load_'.$i]['load_s_5'];
                $array[] = 'E_5='.$parseJSON['load_'.$i]['load_e_5'];
            }else {
                $array[] = 'S_5=99:99';
                $array[] = 'E_5=99:99';
            }
        }else {
            $array[] = 'S_5=99:99';
            $array[] = 'E_5=99:99';
        }
        if(isset($parseJSON['load_'.$i]['load_st_6'])){
            if($parseJSON['load_'.$i]['load_st_6'] == 1){
                $array[] = 'S_6='.$parseJSON['load_'.$i]['load_s_6'];
                $array[] = 'E_6='.$parseJSON['load_'.$i]['load_e_6'];
            }else {
                $array[] = 'S_6=99:99';
                $array[] = 'E_6=99:99';
            }
        }else {
            $array[] = 'S_6=99:99';
            $array[] = 'E_6=99:99';
        }
    }
    // $array2 = implode('\r\n',$array);
    // echo $array2;
    // echo json_encode($parseJSON);
    // exit();
    $sql = "INSERT INTO $tb_name (`load_sn`, `load_user`,
                    `load_st_1`, `load_st_2`, `load_st_3`, `load_st_4`, `load_st_5`, `load_st_6`,
                    `load_s_1`, `load_s_2`, `load_s_3`, `load_s_4`, `load_s_5`, `load_s_6`,
                    `load_e_1`, `load_e_2`, `load_e_3`, `load_e_4`, `load_e_5`, `load_e_6`)
            VALUES (:load_sn, :losd_user,
                    :sw_1, :sw_2, :sw_3, :sw_4, :sw_5, :sw_6,
                    :s_1, :s_2, :s_3, :s_4, :s_5, :s_6,
                    :e_1, :e_2, :e_3, :e_4, :e_5, :e_6 )";
    if ($dbcon->prepare($sql)->execute($post_data) === TRUE) {
        // for($i=1; $i<=6; $i++){
        //     if($_POST["sw_".$i] == 1){
        //         $data['S_'.$i] = $_POST["s_".$i];
        //         $data['E_'.$i] = $_POST["e_".$i];
        //     }else{
        //         $data['S_'.$i] = "99:99";
        //         $data['E_'.$i] = "99:99";
        //     }
        // }
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
        echo json_encode(['status' => "Insert_Success", 'data' => $array ], JSON_UNESCAPED_UNICODE );
    }else{
        echo json_encode(['status' => "Insert_Error ".$tb_name, 'data' => '' ], JSON_UNESCAPED_UNICODE );
    }
