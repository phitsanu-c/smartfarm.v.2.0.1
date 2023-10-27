<?php
    require "../connectdb.php";
    $json1 = json_decode($_POST['data_1']);
    if(!isset($_POST['sn'])){$data['sn']='';}else{$data['sn']=$_POST['sn'];}
    if(!isset($json1->date_time1)){$data['t1']='';}else{$data['t1']=$json1->date_time1;}

    $data['dtimestamp'] = date("Y-m-d").' '.date("H:i:s");
    $sql = "INSERT INTO `tbn_data`(`data_timestamp`, `data_sn`,
            `data_temp_out`, `data_hum_out`, `data_light_out`,
            `data_temp_in`, `data_hum_in`, `data_light_in`, `data_soil_in`, `data_re`) VALUES
            (:tsp, :sn, :t_o, :h_o, :l_o, :t_i, :h_i, :l_i, :s_i, :re )";
    if ($dbcon->prepare($sql)->execute($data) === TRUE) {
        echo json_encode(['status' => "OK",'data' => "Insert_Success" ], JSON_UNESCAPED_UNICODE );
    }else{
        echo json_encode(['status' => 'Error','data' => "Insert_Error"] , JSON_UNESCAPED_UNICODE );
    }
?>
