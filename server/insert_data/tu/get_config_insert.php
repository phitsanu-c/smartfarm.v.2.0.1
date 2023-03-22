<?php
    require "../connectdb.php";


    $house_master = $_POST["house_master"];
    // $numb = intval(substr($house_master, 5,10));
    // echo json_encode($house_master);
    // exit();


    $row_9 = $dbcon->query("SELECT * FROM `tbn_data_tu` ORDER BY `data_id` DESC LIMIT 1")->fetch();
    // if($row_9 == false){
    //     $data_sensor = false;
    // }else{
    //     $data_sensor = [
    //         "serial_id" => $house_master,
    //         "date" => substr($row_9['data_timestamp_'.$numb], 0, 9),
    //         "time" => substr($row_9['data_timestamp_'.$numb], 11, 18),
    //         "data" => [
    //             "temp_out" => $row_9['data_temp_out_'.$numb],
    //             "hum_out" => $row_9['data_hum_out_'.$numb],
    //             "light_out" => $row_9['data_light_out_'.$numb],
    //             "temp_in" => $row_9['data_temp_in_'.$numb],
    //             "hum_in" => $row_9['data_hum_in_'.$numb],
    //             "light_in" => $row_9['data_light_in_'.$numb],
    //             "soil_in" => $row_9['data_soil_in_'.$numb]
    //         ]
    //     ];
    // }
    $stmt_re = $dbcon->query("SELECT * FROM tbn_login_re");
    $count = $stmt_re->fetchColumn();
    if($count == false){
        $data0 = 0;
    }else {
        $data0 = [];
        while ($row = $stmt_re->fetch()) {
            if($row['re_siteID'] == ''){$siteID = '';}else {$siteID = $row['re_siteID'];}
            $data0[$row['re_userID']] = ['account_id' => $row['re_userID'], 'dt' => $row['re_datetime']];
        }
    }
    // if($data0 == null){
    //     $data01 = 0;
    // }else {
    //     $data01 = $data0;
    // }
   echo json_encode([
       'data'=>$row_9,
       'datetime_sever' => date("Y/m/d").' '.date("H:i"),
       'log_re_login' => $data0
    ]);
