<?php
    require "../connectdb.php";
    $json = json_decode($_POST['output']);
    // echo json_encode($json);
    // echo $json['serial_id'];
    // exit();

    $data = [
        'sn' => $json->serial_id,
        'mode' => $json->mode,
        'user' => $json->user_control,
        'l_1' => $json->dripper_1,
        'l_2' => $json->dripper_2,
        'l_3' => $json->dripper_3,
        'l_4' => $json->dripper_4,
        'l_5' => $json->fan_1,
        'l_6' => $json->fan_2,
        'l_7' => $json->fan_3,
        'l_8' => $json->fan_4,
        'l_9' => $json->foggy_1,
        'l_10' => $json->foggy_2,
        'l_11' => $json->spray,
        'l_12' => $json->shading
    ];
    // echo json_encode($data);
    // exit();
    $sql = "INSERT INTO `tbn_control_log`(`cn_sn`, `cn_mode`, `cn_user`,
          `cn_load_1`, `cn_load_2`, `cn_load_3`, `cn_load_4`, `cn_load_5`, `cn_load_6`,
          `cn_load_7`, `cn_load_8`, `cn_load_9`, `cn_load_10`, `cn_load_11`, `cn_load_12`) VALUES (:sn, :mode, :user,
            :l_1, :l_2, :l_3, :l_4, :l_5, :l_6,
            :l_7, :l_8, :l_9, :l_10, :l_11, :l_12)";
    if ($dbcon->prepare($sql)->execute($data) === TRUE) {
        echo json_encode(['status' => "OK",'data' => "Insert_Success" ], JSON_UNESCAPED_UNICODE );
    }else{
        echo json_encode(['status' => 'Error','data' => "Insert_Error"] , JSON_UNESCAPED_UNICODE );
    }
