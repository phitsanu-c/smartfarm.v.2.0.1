<?php
    require "../connectdb.php";


    $house_master = $_POST["house_master"];
    $numb = intval(substr($house_master, 5,10));
    // echo json_encode($house_master);
    // exit();
    // $channel = $_POST["channel"];
    $row_cont_log = $dbcon->query("SELECT * FROM tbn_control_log WHERE cn_sn = '$house_master' ORDER BY `cn_id` DESC LIMIT 1")->fetch();
    $control_log = [
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

    $row_mn_log = $dbcon->query("SELECT * FROM `tbn_control_mn_log` WHERE mn_sn = '$house_master' ORDER BY `mn_id` DESC LIMIT 1")->fetch();
    $control_mn_log = [
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
        "shading"   => $row_mn_log['mn_load_12']
    ];

    $cont_auto = [];
    for($i = 1; $i<=12; $i++){
        $tb = 'tbn_control_au'.$i;
        $row_ac = $dbcon->query("SELECT * FROM $tb WHERE load_sn = '$house_master'  ORDER BY `load_id` DESC LIMIT 1")->fetch();
        // $data['load_'.$i] = $row_ac;
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

        if($row_ac['load_st_1'] == 1){
            $array[] = 'S_1='.$row_ac['load_s_1'];
            $array[] = 'E_1='.$row_ac['load_e_1'];
        }else {
            $array[] = 'S_1=99:99';
            $array[] = 'E_1=99:99';
        }
        if($row_ac['load_st_2'] == 1){
            $array[] = 'S_2='.$row_ac['load_s_2'];
            $array[] = 'E_2='.$row_ac['load_e_2'];
        }else {
            $array[] = 'S_2=99:99';
            $array[] = 'E_2=99:99';
        }
        if($row_ac['load_st_3'] == 1){
            $array[] = 'S_3='.$row_ac['load_s_3'];
            $array[] = 'E_3='.$row_ac['load_e_3'];
        }else {
            $array[] = 'S_3=99:99';
            $array[] = 'E_3=99:99';
        }
        if($row_ac['load_st_4'] == 1){
            $array[] = 'S_4='.$row_ac['load_s_4'];
            $array[] = 'E_4='.$row_ac['load_e_4'];
        }else {
            $array[] = 'S_4=99:99';
            $array[] = 'E_4=99:99';
        }
        if($row_ac['load_st_5'] == 1){
            $array[] = 'S_5='.$row_ac['load_s_5'];
            $array[] = 'E_5='.$row_ac['load_e_5'];
        }else {
            $array[] = 'S_5=99:99';
            $array[] = 'E_5=99:99';
        }
        if($row_ac['load_st_6'] == 1){
            $array[] = 'S_6='.$row_ac['load_s_6'];
            $array[] = 'E_6='.$row_ac['load_e_6'];
        }else {
            $array[] = 'S_6=99:99';
            $array[] = 'E_6=99:99';
        }
        // if($row_ac['load_st_1'] == 1){
        //     $s_1 = $row_ac['load_s_1'];
        //     $e_1 = $row_ac['load_e_1'];
        // }else{
        //     $s_1 = '99:99';
        //     $e_1 = '99:99';
        // }
        // if($row_ac['load_st_2'] == 1){
        //     $s_2 = $row_ac['load_s_2'];
        //     $e_2 = $row_ac['load_e_2'];
        // }else{
        //     $s_2 = '99:99';
        //     $e_2 = '99:99';
        // }
        // if($row_ac['load_st_3'] == 1){
        //     $s_3 = $row_ac['load_s_3'];
        //     $e_3 = $row_ac['load_e_3'];
        // }else{
        //     $s_3 = '99:99';
        //     $e_3 = '99:99';
        // }
        // if($row_ac['load_st_4'] == 1){
        //     $s_4 = $row_ac['load_s_4'];
        //     $e_4 = $row_ac['load_e_4'];
        // }else{
        //     $s_4 = '99:99';
        //     $e_4 = '99:99';
        // }
        // if($row_ac['load_st_5'] == 1){
        //     $s_5 = $row_ac['load_s_5'];
        //     $e_5 = $row_ac['load_e_5'];
        // }else{
        //     $s_5 = '99:99';
        //     $e_5 = '99:99';
        // }
        // if($row_ac['load_st_6'] == 1){
        //     $s_6 = $row_ac['load_s_6'];
        //     $e_6 = $row_ac['load_e_6'];
        // }else{
        //     $s_6 = '99:99';
        //     $e_6 = '99:99';
        // }
        // if($i <= 4){
        //     $cont_auto['dripper_'.$i] = [
        //         'S_1' => $s_1,
        //         'S_2' => $s_2,
        //         'S_3' => $s_3,
        //         'S_4' => $s_4,
        //         'S_5' => $s_5,
        //         'S_6' => $s_6,
        //         'E_1' => $e_1,
        //         'E_2' => $e_2,
        //         'E_3' => $e_3,
        //         'E_4' => $e_4,
        //         'E_5' => $e_5,
        //         'E_6' => $e_6
        //     ];
        // }else if($i > 4 && $i <= 8){
        //     $cont_auto[' fan'.($i-7)] = [
        //         'S_1' => $s_1,
        //         'S_2' => $s_2,
        //         'S_3' => $s_3,
        //         'S_4' => $s_4,
        //         'S_5' => $s_5,
        //         'S_6' => $s_6,
        //         'E_1' => $e_1,
        //         'E_2' => $e_2,
        //         'E_3' => $e_3,
        //         'E_4' => $e_4,
        //         'E_5' => $e_5,
        //         'E_6' => $e_6
        //     ];
        // }else if($i == 9 || $i == 10){
        //     $cont_auto['foggy_'.($i-4)] = [
        //         'S_1' => $s_1,
        //         'S_2' => $s_2,
        //         'S_3' => $s_3,
        //         'S_4' => $s_4,
        //         'S_5' => $s_5,
        //         'S_6' => $s_6,
        //         'E_1' => $e_1,
        //         'E_2' => $e_2,
        //         'E_3' => $e_3,
        //         'E_4' => $e_4,
        //         'E_5' => $e_5,
        //         'E_6' => $e_6
        //     ];
        // }else if($i == 11){
        //     $cont_auto['spray'] = [
        //         'S_1' => $s_1,
        //         'S_2' => $s_2,
        //         'S_3' => $s_3,
        //         'S_4' => $s_4,
        //         'S_5' => $s_5,
        //         'S_6' => $s_6,
        //         'E_1' => $e_1,
        //         'E_2' => $e_2,
        //         'E_3' => $e_3,
        //         'E_4' => $e_4,
        //         'E_5' => $e_5,
        //         'E_6' => $e_6
        //     ];
        // }else if($i == 12){
        //     $cont_auto['shading'] = [
        //         'S_1' => $s_1,
        //         'S_2' => $s_2,
        //         'S_3' => $s_3,
        //         'S_4' => $s_4,
        //         'S_5' => $s_5,
        //         'S_6' => $s_6,
        //         'E_1' => $e_1,
        //         'E_2' => $e_2,
        //         'E_3' => $e_3,
        //         'E_4' => $e_4,
        //         'E_5' => $e_5,
        //         'E_6' => $e_6
        //     ];
        // }
        // array_push($data, $load);
    }

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
    $row_2 = $dbcon->query("SELECT * FROM tbn_status_cn WHERE cn_status_sn = '$house_master'")->fetch();

    if($row_2['cn_status_1'] == 1){
        $c_drip[] = 1;
        if($row_cont_log['cn_load_1'] == "ON"){
            $drip[] = 1;
        }else {
            $drip[] = 0;
        }
    }else { $c_drip[] = 0; $drip[] = 0; }
    if($row_2['cn_status_2'] == 1){
        $c_drip[] = 1;
        if($row_cont_log['cn_load_2'] == "ON"){
            $drip[] = 1;
        }else {
            $drip[] = 0;
        }
    }else { $c_drip[] = 0; $drip[] = 0; }
    if($row_2['cn_status_3'] == 1){
        $c_drip[] = 1;
        if($row_cont_log['cn_load_3'] == "ON"){
            $drip[] = 1;
        }else {
            $drip[] = 0;
        }
    }else { $c_drip[] = 0; $drip[] = 0; }
    if($row_2['cn_status_4'] == 1){
        $c_drip[] = 1;
        if($row_cont_log['cn_load_4'] == "ON"){
            $drip[] = 1;
        }else {
            $drip[] = 0;
        }
    }else { $c_drip[] = 0; $drip[] = 0; }
    if(count(array_keys($c_drip, 1)) == count(array_keys($drip, 1))){$st_drip = 'ON';}else {$st_drip = 'OFF';}
    if($row_2['cn_status_5'] == 1){
        $c_fan[] = 1;
        if($row_cont_log['cn_load_5'] == "ON"){
            $fan[] = 1;
        }else {
            $fan[] = 0;
        }
    }else { $c_fan[] = 0; $fan[] = 0; }
    if($row_2['cn_status_6'] == 1){
        $c_fan[] = 1;
        if($row_cont_log['cn_load_6'] == "ON"){
            $fan[] = 1;
        }else {
            $fan[] = 0;
        }
    }else { $c_fan[] = 0; $fan[] = 0; }
    if($row_2['cn_status_7'] == 1){
        $c_fan[] = 1;
        if($row_cont_log['cn_load_7'] == "ON"){
            $fan[] = 1;
        }else {
            $fan[] = 0;
        }
    }else { $c_fan[] = 0; $fan[] = 0; }
    if($row_2['cn_status_8'] == 1){
        $c_fan[] = 1;
        if($row_cont_log['cn_load_8'] == "ON"){
            $fan[] = 1;
        }else {
            $fan[] = 0;
        }
    }else { $c_fan[] = 0; $fan[] = 0; }
    if(count(array_keys($c_fan, 1)) == count(array_keys($fan, 1))){$st_fan = 'ON';}else {$st_fan = 'OFF';}
    if($row_2['cn_status_9'] == 1){
        $c_foggy[] = 1;
        if($row_cont_log['cn_load_9'] == "ON"){
            $foggy[] = 1;
        }else {
            $foggy[] = 0;
        }
    }else { $c_foggy[] = 0; $foggy[] = 0; }
    if($row_2['cn_status_10'] == 1){
        $c_foggy[] = 1;
        if($row_cont_log['cn_load_10'] == "ON"){
            $foggy[] = 1;
        }else {
            $foggy[] = 0;
        }
    }else { $c_foggy[] = 0; $foggy[] = 0; }
    if(count(array_keys($c_foggy, 1)) == count(array_keys($foggy, 1))){$st_foggy = 'ON';}else {$st_foggy = 'OFF';}
    $loads = [
        "mode"      => $row_cont_log['cn_mode'],
        "dripper" => $st_drip,
        "fan"     => $st_fan,
        "foggy"   => $st_foggy,
        "spray"     => $row_cont_log['cn_load_11'],
        "shading"   => $row_cont_log['cn_load_12'],
        "user_control" => $row_cont_log['cn_user']
    ];
    $row_eq = $dbcon->query("SELECT * FROM tbn_equation WHERE equation_sn = '$house_master' ORDER BY equation_timestamp DESC LIMIT 1")->fetch();
    echo json_encode([
        'house_master'  => $house_master,
        'master_number' => $numb,
        'cont_log'   => $control_log,
        'cont_manual'=> $control_mn_log,
        'cont_auto ' => $array,
        'count_load' => $loads,
        'equation'   => $row_eq
    ]);
