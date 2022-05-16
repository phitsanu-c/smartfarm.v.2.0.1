<?php
    require "../connectdb.php";

    $house_master = $_POST["house_master"];
    $load_select = $_POST["load_select"];
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
    $value = '';

    $post_data["load_sn"] = $house_master;
    $post_data["losd_user"] = $_SESSION["account_user"];


    $sql = "INSERT INTO $tb_name (`load_sn`, `load_user`,
                    `load_st_1`, `load_st_2`, `load_st_3`, `load_st_4`, `load_st_5`, `load_st_6`,
                    `load_s_1`, `load_s_2`, `load_s_3`, `load_s_4`, `load_s_5`, `load_s_6`,
                    `load_e_1`, `load_e_2`, `load_e_3`, `load_e_4`, `load_e_5`, `load_e_6`)
            VALUES (:load_sn, :losd_user,
                    :sw_1, :sw_2, :sw_3, :sw_4, :sw_5, :sw_6,
                    :s_1, :s_2, :s_3, :s_4, :s_5, :s_6,
                    :e_1, :e_2, :e_3, :e_4, :e_5, :e_6 )";
    if ($dbcon->prepare($sql)->execute($post_data) === TRUE) {
        for($i=1; $i<=6; $i++){
            if($_POST["sw_".$i] == 1){
                $data['S_'.$i] = $_POST["s_".$i];
                $data['E_'.$i] = $_POST["e_".$i];
            }else{
                $data['S_'.$i] = "99:99";
                $data['E_'.$i] = "99:99";
            }
        }
        if($load_select <= 4){
            $load_data_mqtt = ['dripper_'.$load_select => $data];
        }elseif($load_select > 4 && $load_select <= 8){
            $load_data_mqtt = ['fan_'.$load_select => $data];
        }elseif($load_select > 8 && $load_select <= 10){
            $load_data_mqtt = ['foggy_'.$load_select => $data];
        }elseif($load_select == 11){
            $load_data_mqtt = ['sprinker' => $data];
        }elseif($load_select == 12){
            $load_data_mqtt = ['roof' => $data];
        }
        echo json_encode(['status' => "Insert_Success", 'data' => $load_data_mqtt ], JSON_UNESCAPED_UNICODE );
    }else{
        echo json_encode(['status' => "Insert_Error ".$tb_name, 'data' => '' ], JSON_UNESCAPED_UNICODE );
    }
