<?php
    require "../../routes/connectdb.php";
    // $json1 = json_decode($_POST['data_array']);
    //$json2 = $json1->data_update->data;
    //$json = $json2[0];
    //$S_number = $json->serial_id;
    // echo $json1;
    // print_r($_POST);
    // exit();
// if(isset($_POST['data_array'])) {
    $json1 = json_decode($_POST['data_1']);
    $json2 = json_decode($_POST['data_2']);
    $json3 = json_decode($_POST['data_3']);
    $json4 = json_decode($_POST['data_4']);
    $json5 = json_decode($_POST['data_5']);
    $json6 = json_decode($_POST['data_6']);
    $json7 = json_decode($_POST['data_7']);
    // $S_number = $json->serial_id;
    // echo $S_number;
    // $json = $_POST['data_array'];
    // echo $json->date_time1;
    if(!isset($_POST['sn'])){$data['sn']='';}else{$data['sn']=$_POST['sn'];}
    if(!isset($json1->date_time1)){$data['t1']='';}else{$data['t1']=$json1->date_time1;}
    if(!isset($json2->date_time2)){$data['t2']='';}else{$data['t2']=$json2->date_time2;}
    if(!isset($json3->date_time3)){$data['t3']='';}else{$data['t3']=$json3->date_time3;}
    if(!isset($json4->date_time4)){$data['t4']='';}else{$data['t4']=$json4->date_time4;}
    if(!isset($json5->date_time5)){$data['t5']='';}else{$data['t5']=$json5->date_time5;}
    if(!isset($json6->date_time6)){$data['t6']='';}else{$data['t6']=$json6->date_time6;}
    if(!isset($json7->date_time7)){$data['t7']='';}else{$data['t7']=$json7->date_time7;}

    if(!isset($json1->temp_out1)){$data['to1']=0;}else{$data['to1']=$json1->temp_out1;}
    if(!isset($json2->temp_out2)){$data['to2']=0;}else{$data['to2']=$json2->temp_out2;}
    if(!isset($json3->temp_out3)){$data['to3']=0;}else{$data['to3']=$json3->temp_out3;}
    if(!isset($json4->temp_out4)){$data['to4']=0;}else{$data['to4']=$json4->temp_out4;}
    if(!isset($json5->temp_out5)){$data['to5']=0;}else{$data['to5']=$json5->temp_out5;}
    if(!isset($json6->temp_out6)){$data['to6']=0;}else{$data['to6']=$json6->temp_out6;}
    if(!isset($json7->temp_out7)){$data['to7']=0;}else{$data['to7']=$json7->temp_out7;}

    if(!isset($json1->hum_out1)){$data['ho1']=0;}else{$data['ho1']=$json1->hum_out1;}
    if(!isset($json2->hum_out2)){$data['ho2']=0;}else{$data['ho2']=$json2->hum_out2;}
    if(!isset($json3->hum_out3)){$data['ho3']=0;}else{$data['ho3']=$json3->hum_out3;}
    if(!isset($json4->hum_out4)){$data['ho4']=0;}else{$data['ho4']=$json4->hum_out4;}
    if(!isset($json5->hum_out5)){$data['ho5']=0;}else{$data['ho5']=$json5->hum_out5;}
    if(!isset($json6->hum_out6)){$data['ho6']=0;}else{$data['ho6']=$json6->hum_out6;}
    if(!isset($json7->hum_out7)){$data['ho7']=0;}else{$data['ho7']=$json7->hum_out7;}

    if(!isset($json1->light_out1)){$data['lo1']=0;}else{$data['lo1']=$json1->light_out1;}
    if(!isset($json2->light_out2)){$data['lo2']=0;}else{$data['lo2']=$json2->light_out2;}
    if(!isset($json3->light_out3)){$data['lo3']=0;}else{$data['lo3']=$json3->light_out3;}
    if(!isset($json4->light_out4)){$data['lo4']=0;}else{$data['lo4']=$json4->light_out4;}
    if(!isset($json5->light_out5)){$data['lo5']=0;}else{$data['lo5']=$json5->light_out5;}
    if(!isset($json6->light_out6)){$data['lo6']=0;}else{$data['lo6']=$json6->light_out6;}
    if(!isset($json7->light_out7)){$data['lo7']=0;}else{$data['lo7']=$json7->light_out7;}

    if(!isset($json1->temp_in1)){$data['ti1']=0;}else{$data['ti1']=$json1->temp_in1;}
    if(!isset($json2->temp_in2)){$data['ti2']=0;}else{$data['ti2']=$json2->temp_in2;}
    if(!isset($json3->temp_in3)){$data['ti3']=0;}else{$data['ti3']=$json3->temp_in3;}
    if(!isset($json4->temp_in4)){$data['ti4']=0;}else{$data['ti4']=$json4->temp_in4;}
    if(!isset($json5->temp_in5)){$data['ti5']=0;}else{$data['ti5']=$json5->temp_in5;}
    if(!isset($json6->temp_in6)){$data['ti6']=0;}else{$data['ti6']=$json6->temp_in6;}
    if(!isset($json7->temp_in7)){$data['ti7']=0;}else{$data['ti7']=$json7->temp_in7;}

    if(!isset($json1->hum_in1)){$data['hi1']=0;}else{$data['hi1']=$json1->hum_in1;}
    if(!isset($json2->hum_in2)){$data['hi2']=0;}else{$data['hi2']=$json2->hum_in2;}
    if(!isset($json3->hum_in3)){$data['hi3']=0;}else{$data['hi3']=$json3->hum_in3;}
    if(!isset($json4->hum_in4)){$data['hi4']=0;}else{$data['hi4']=$json4->hum_in4;}
    if(!isset($json5->hum_in5)){$data['hi5']=0;}else{$data['hi5']=$json5->hum_in5;}
    if(!isset($json6->hum_in6)){$data['hi6']=0;}else{$data['hi6']=$json6->hum_in6;}
    if(!isset($json7->hum_in7)){$data['hi7']=0;}else{$data['hi7']=$json7->hum_in7;}

    if(!isset($json1->light_in1)){$data['li1']=0;}else{$data['li1']=$json1->light_in1;}
    if(!isset($json2->light_in2)){$data['li2']=0;}else{$data['li2']=$json2->light_in2;}
    if(!isset($json3->light_in3)){$data['li3']=0;}else{$data['li3']=$json3->light_in3;}
    if(!isset($json4->light_in4)){$data['li4']=0;}else{$data['li4']=$json4->light_in4;}
    if(!isset($json5->light_in5)){$data['li5']=0;}else{$data['li5']=$json5->light_in5;}
    if(!isset($json6->light_in6)){$data['li6']=0;}else{$data['li6']=$json6->light_in6;}
    if(!isset($json7->light_in7)){$data['li7']=0;}else{$data['li7']=$json7->light_in7;}

    if(!isset($json1->soil_in1)){$data['si1']=0;}else{$data['si1']=$json1->soil_in1;}
    if(!isset($json2->soil_in2)){$data['si2']=0;}else{$data['si2']=$json2->soil_in2;}
    if(!isset($json3->soil_in3)){$data['si3']=0;}else{$data['si3']=$json3->soil_in3;}
    if(!isset($json4->soil_in4)){$data['si4']=0;}else{$data['si4']=$json4->soil_in4;}
    if(!isset($json5->soil_in5)){$data['si5']=0;}else{$data['si5']=$json5->soil_in5;}
    if(!isset($json6->soil_in6)){$data['si6']=0;}else{$data['si6']=$json6->soil_in6;}
    if(!isset($json7->soil_in7)){$data['si7']=0;}else{$data['si7']=$json7->soil_in7;}

    if(!isset($json1->res_1)){$data['res_1']=0;}else{$data['res_1']=$json1->res_1;}
    if(!isset($json2->res_2)){$data['res_2']=0;}else{$data['res_2']=$json2->res_2;}
    if(!isset($json3->res_3)){$data['res_3']=0;}else{$data['res_3']=$json3->res_3;}
    if(!isset($json4->res_4)){$data['res_4']=0;}else{$data['res_4']=$json4->res_4;}
    if(!isset($json5->res_5)){$data['res_5']=0;}else{$data['res_5']=$json5->res_5;}
    if(!isset($json6->res_6)){$data['res_6']=0;}else{$data['res_6']=$json6->res_6;}
    if(!isset($json7->res_7)){$data['res_7']=0;}else{$data['res_7']=$json7->res_7;}
    // $data = [
    //     'sn' = >'TUSMT',
    //     't1' => $json->date_time1,
    //     'to1' => $json->temp_out1,
    //     'ho1' => $json->hum_out1,
    //     'lo1' => $json->light_out1,
    //     'ti1' => $json->temp_in1,
    //     'hi1' => $json->hum_in1,
    //     'li1' => $json->light_in1,
    //     'si1' => $json->soil_in1,
    // ];
    // echo json_encode($data);
    $data['dtimestamp'] = date("Y-m-d").' '.date("H:i:s");
    $sql = "INSERT INTO `tbn_data_tu_eq`(`data_timestamp`, `data_sn`,
            `data_timestamp_1`, `data_temp_out_1`, `data_hum_out_1`, `data_light_out_1`, `data_temp_in_1`, `data_hum_in_1`, `data_light_in_1`, `data_soil_in_1`, `data_re_1`,
            `data_timestamp_2`, `data_temp_out_2`, `data_hum_out_2`, `data_light_out_2`, `data_temp_in_2`, `data_hum_in_2`, `data_light_in_2`, `data_soil_in_2`, `data_re_2`,
            `data_timestamp_3`, `data_temp_out_3`, `data_hum_out_3`, `data_light_out_3`, `data_temp_in_3`, `data_hum_in_3`, `data_light_in_3`, `data_soil_in_3`, `data_re_3`,
            `data_timestamp_4`, `data_temp_out_4`, `data_hum_out_4`, `data_light_out_4`, `data_temp_in_4`, `data_hum_in_4`, `data_light_in_4`, `data_soil_in_4`, `data_re_4`,
            `data_timestamp_5`, `data_temp_out_5`, `data_hum_out_5`, `data_light_out_5`, `data_temp_in_5`, `data_hum_in_5`, `data_light_in_5`, `data_soil_in_5`, `data_re_5`,
            `data_timestamp_6`, `data_temp_out_6`, `data_hum_out_6`, `data_light_out_6`, `data_temp_in_6`, `data_hum_in_6`, `data_light_in_6`, `data_soil_in_6`, `data_re_6`,
            `data_timestamp_7`, `data_temp_out_7`, `data_hum_out_7`, `data_light_out_7`, `data_temp_in_7`, `data_hum_in_7`, `data_light_in_7`, `data_soil_in_7`, `data_re_7`) VALUES(:dtimestamp, :sn,
            :t1, :to1, :ho1, :lo1, :ti1, :hi1, :li1, :si1, :res_1,
            :t2, :to2, :ho2, :lo2, :ti2, :hi2, :li2, :si2, :res_2,
            :t3, :to3, :ho3, :lo3, :ti3, :hi3, :li3, :si3, :res_3,
            :t4, :to4, :ho4, :lo4, :ti4, :hi4, :li4, :si4, :res_4,
            :t5, :to5, :ho5, :lo5, :ti5, :hi5, :li5, :si5, :res_5,
            :t6, :to6, :ho6, :lo6, :ti6, :hi6, :li6, :si6, :res_6,
            :t7, :to7, :ho7, :lo7, :ti7, :hi7, :li7, :si7, :res_7
            )";
    if ($dbcon->prepare($sql)->execute($data) === TRUE) {
        echo json_encode(['status' => "OK",'data' => "Insert_Success" ], JSON_UNESCAPED_UNICODE );
    }else{
        echo json_encode(['status' => 'Error','data' => "Insert_Error"] , JSON_UNESCAPED_UNICODE );
    }
exit();

    if(!isset( $json->data->dataST_1_1 )){ $dataST_1_1 = 0; }else{ $dataST_1_1 = $json->data->dataST_1_1; }
    if(!isset( $json->data->dataST_1_2 )){ $dataST_1_2 = 0; }else{ $dataST_1_2 = $json->data->dataST_1_2; }
    if(!isset( $json->data->dataST_1_3 )){ $dataST_1_3 = 0; }else{ $dataST_1_3 = $json->data->dataST_1_3; }
    if(!isset( $json->data->dataST_1_4 )){ $dataST_1_4 = 0; }else{ $dataST_1_4 = $json->data->dataST_1_4; }
    if(!isset( $json->data->dataST_1_5 )){ $dataST_1_5 = 0; }else{ $dataST_1_5 = $json->data->dataST_1_5; }
    if(!isset( $json->data->dataST_2_1 )){ $dataST_2_1 = 0; }else{ $dataST_2_1 = $json->data->dataST_2_1; }
    if(!isset( $json->data->dataST_2_2 )){ $dataST_2_2 = 0; }else{ $dataST_2_2 = $json->data->dataST_2_2; }
    if(!isset( $json->data->dataST_2_3 )){ $dataST_2_3 = 0; }else{ $dataST_2_3 = $json->data->dataST_2_3; }
    if(!isset( $json->data->dataST_2_4 )){ $dataST_2_4 = 0; }else{ $dataST_2_4 = $json->data->dataST_2_4; }
    if(!isset( $json->data->dataST_2_5 )){ $dataST_2_5 = 0; }else{ $dataST_2_5 = $json->data->dataST_2_5; }
    if(!isset( $json->data->dataST_3_1 )){ $dataST_3_1 = 0; }else{ $dataST_3_1 = $json->data->dataST_3_1; }
    if(!isset( $json->data->dataST_3_2 )){ $dataST_3_2 = 0; }else{ $dataST_3_2 = $json->data->dataST_3_2; }
    if(!isset( $json->data->dataST_3_3 )){ $dataST_3_3 = 0; }else{ $dataST_3_3 = $json->data->dataST_3_3; }
    if(!isset( $json->data->dataST_3_4 )){ $dataST_3_4 = 0; }else{ $dataST_3_4 = $json->data->dataST_3_4; }
    if(!isset( $json->data->dataST_3_5 )){ $dataST_3_5 = 0; }else{ $dataST_3_5 = $json->data->dataST_3_5; }
    if(!isset( $json->data->dataST_4_1 )){ $dataST_4_1 = 0; }else{ $dataST_4_1 = $json->data->dataST_4_1; }
    if(!isset( $json->data->dataST_4_2 )){ $dataST_4_2 = 0; }else{ $dataST_4_2 = $json->data->dataST_4_2; }
    if(!isset( $json->data->dataST_4_3 )){ $dataST_4_3 = 0; }else{ $dataST_4_3 = $json->data->dataST_4_3; }
    if(!isset( $json->data->dataST_4_4 )){ $dataST_4_4 = 0; }else{ $dataST_4_4 = $json->data->dataST_4_4; }
    if(!isset( $json->data->dataST_4_5 )){ $dataST_4_5 = 0; }else{ $dataST_4_5 = $json->data->dataST_4_5; }
    if(!isset( $json->data->dataST_5_1 )){ $dataST_5_1 = 0; }else{ $dataST_5_1 = $json->data->dataST_5_1; }
    if(!isset( $json->data->dataST_5_2 )){ $dataST_5_2 = 0; }else{ $dataST_5_2 = $json->data->dataST_5_2; }
    if(!isset( $json->data->dataST_5_3 )){ $dataST_5_3 = 0; }else{ $dataST_5_3 = $json->data->dataST_5_3; }
    if(!isset( $json->data->dataST_5_4 )){ $dataST_5_4 = 0; }else{ $dataST_5_4 = $json->data->dataST_5_4; }
    if(!isset( $json->data->dataST_5_5 )){ $dataST_5_5 = 0; }else{ $dataST_5_5 = $json->data->dataST_5_5; }
    if(!isset( $json->data->dataST_6_1 )){ $dataST_6_1 = 0; }else{ $dataST_6_1 = $json->data->dataST_6_1; }
    if(!isset( $json->data->dataST_6_2 )){ $dataST_6_2 = 0; }else{ $dataST_6_2 = $json->data->dataST_6_2; }
    if(!isset( $json->data->dataST_6_3 )){ $dataST_6_3 = 0; }else{ $dataST_6_3 = $json->data->dataST_6_3; }
    if(!isset( $json->data->dataST_6_4 )){ $dataST_6_4 = 0; }else{ $dataST_6_4 = $json->data->dataST_6_4; }
    if(!isset( $json->data->dataST_6_5 )){ $dataST_6_5 = 0; }else{ $dataST_6_5 = $json->data->dataST_6_5; }
    if(!isset( $json->data->dataST_7_1 )){ $dataST_7_1 = 0; }else{ $dataST_7_1 = $json->data->dataST_7_1; }
    if(!isset( $json->data->dataST_7_2 )){ $dataST_7_2 = 0; }else{ $dataST_7_2 = $json->data->dataST_7_2; }
    if(!isset( $json->data->dataST_7_3 )){ $dataST_7_3 = 0; }else{ $dataST_7_3 = $json->data->dataST_7_3; }
    if(!isset( $json->data->dataST_7_4 )){ $dataST_7_4 = 0; }else{ $dataST_7_4 = $json->data->dataST_7_4; }
    if(!isset( $json->data->dataST_7_5 )){ $dataST_7_5 = 0; }else{ $dataST_7_5 = $json->data->dataST_7_5; }
    if(!isset( $json->data->dataST_8_1 )){ $dataST_8_1 = 0; }else{ $dataST_8_1 = $json->data->dataST_8_1; }
    if(!isset( $json->data->dataST_8_2 )){ $dataST_8_2 = 0; }else{ $dataST_8_2 = $json->data->dataST_8_2; }
    if(!isset( $json->data->dataST_8_3 )){ $dataST_8_3 = 0; }else{ $dataST_8_3 = $json->data->dataST_8_3; }
    if(!isset( $json->data->dataST_8_4 )){ $dataST_8_4 = 0; }else{ $dataST_8_4 = $json->data->dataST_8_4; }
    if(!isset( $json->data->dataST_8_5 )){ $dataST_8_5 = 0; }else{ $dataST_8_5 = $json->data->dataST_8_5; }
    if(!isset( $json->data->dataST_9_1 )){ $dataST_9_1 = 0; }else{ $dataST_9_1 = $json->data->dataST_9_1; }
    if(!isset( $json->data->dataST_9_2 )){ $dataST_9_2 = 0; }else{ $dataST_9_2 = $json->data->dataST_9_2; }
    if(!isset( $json->data->dataST_9_3 )){ $dataST_9_3 = 0; }else{ $dataST_9_3 = $json->data->dataST_9_3; }
    if(!isset( $json->data->dataST_9_4 )){ $dataST_9_4 = 0; }else{ $dataST_9_4 = $json->data->dataST_9_4; }
    if(!isset( $json->data->dataST_9_5 )){ $dataST_9_5 = 0; }else{ $dataST_9_5 = $json->data->dataST_9_5; }
    if(!isset( $json->data->dataST_10_1 )){ $dataST_10_1 = 0; }else{ $dataST_10_1 = $json->data->dataST_10_1; }
    if(!isset( $json->data->dataST_10_2 )){ $dataST_10_2 = 0; }else{ $dataST_10_2 = $json->data->dataST_10_2; }
    if(!isset( $json->data->dataST_10_3 )){ $dataST_10_3 = 0; }else{ $dataST_10_3 = $json->data->dataST_10_3; }
    if(!isset( $json->data->dataST_10_4 )){ $dataST_10_4 = 0; }else{ $dataST_10_4 = $json->data->dataST_10_4; }
    if(!isset( $json->data->dataST_10_5 )){ $dataST_10_5 = 0; }else{ $dataST_10_5 = $json->data->dataST_10_5; }
    if(!isset( $json->data->dataST_11_1 )){ $dataST_11_1 = 0; }else{ $dataST_11_1 = $json->data->dataST_11_1; }
    if(!isset( $json->data->dataST_11_2 )){ $dataST_11_2 = 0; }else{ $dataST_11_2 = $json->data->dataST_11_2; }
    if(!isset( $json->data->dataST_11_3 )){ $dataST_11_3 = 0; }else{ $dataST_11_3 = $json->data->dataST_11_3; }
    if(!isset( $json->data->dataST_11_4 )){ $dataST_11_4 = 0; }else{ $dataST_11_4 = $json->data->dataST_11_4; }
    if(!isset( $json->data->dataST_11_5 )){ $dataST_11_5 = 0; }else{ $dataST_11_5 = $json->data->dataST_11_5; }
    if(!isset( $json->data->dataST_12_1 )){ $dataST_12_1 = 0; }else{ $dataST_12_1 = $json->data->dataST_12_1; }
    if(!isset( $json->data->dataST_12_2 )){ $dataST_12_2 = 0; }else{ $dataST_12_2 = $json->data->dataST_12_2; }
    if(!isset( $json->data->dataST_12_3 )){ $dataST_12_3 = 0; }else{ $dataST_12_3 = $json->data->dataST_12_3; }
    if(!isset( $json->data->dataST_12_4 )){ $dataST_12_4 = 0; }else{ $dataST_12_4 = $json->data->dataST_12_4; }
    if(!isset( $json->data->dataST_12_5 )){ $dataST_12_5 = 0; }else{ $dataST_12_5 = $json->data->dataST_12_5; }
    if(!isset( $json->data->dataST_13_1 )){ $dataST_13_1 = 0; }else{ $dataST_13_1 = $json->data->dataST_13_1; }
    if(!isset( $json->data->dataST_13_2 )){ $dataST_13_2 = 0; }else{ $dataST_13_2 = $json->data->dataST_13_2; }
    if(!isset( $json->data->dataST_13_3 )){ $dataST_13_3 = 0; }else{ $dataST_13_3 = $json->data->dataST_13_3; }
    if(!isset( $json->data->dataST_13_4 )){ $dataST_13_4 = 0; }else{ $dataST_13_4 = $json->data->dataST_13_4; }
    if(!isset( $json->data->dataST_13_5 )){ $dataST_13_5 = 0; }else{ $dataST_13_5 = $json->data->dataST_13_5; }
    if(!isset( $json->data->dataST_14_1 )){ $dataST_14_1 = 0; }else{ $dataST_14_1 = $json->data->dataST_14_1; }
    if(!isset( $json->data->dataST_14_2 )){ $dataST_14_2 = 0; }else{ $dataST_14_2 = $json->data->dataST_14_2; }
    if(!isset( $json->data->dataST_14_3 )){ $dataST_14_3 = 0; }else{ $dataST_14_3 = $json->data->dataST_14_3; }
    if(!isset( $json->data->dataST_14_4 )){ $dataST_14_4 = 0; }else{ $dataST_14_4 = $json->data->dataST_14_4; }
    if(!isset( $json->data->dataST_14_5 )){ $dataST_14_5 = 0; }else{ $dataST_14_5 = $json->data->dataST_14_5; }
    if(!isset( $json->data->dataST_15_1 )){ $dataST_15_1 = 0; }else{ $dataST_15_1 = $json->data->dataST_15_1; }
    if(!isset( $json->data->dataST_15_2 )){ $dataST_15_2 = 0; }else{ $dataST_15_2 = $json->data->dataST_15_2; }
    if(!isset( $json->data->dataST_15_3 )){ $dataST_15_3 = 0; }else{ $dataST_15_3 = $json->data->dataST_15_3; }
    if(!isset( $json->data->dataST_15_4 )){ $dataST_15_4 = 0; }else{ $dataST_15_4 = $json->data->dataST_15_4; }
    if(!isset( $json->data->dataST_15_5 )){ $dataST_15_5 = 0; }else{ $dataST_15_5 = $json->data->dataST_15_5; }
    if(!isset( $json->data->dataST_TempMS )){ $dataST_TempMS = 0; }else{ $dataST_TempMS = $json->data->dataST_TempMS; }

    $data = [
        'p1' => $json->date_time, //"2019/06/08 - ".$today_time,//$day_date." - ".$today_time,  //
        'p2' => $json->serial_id, //"000000005bd58d33",//
        'p3' => $json->date,
        'p4' => $json->time,
        // 'p5' => 0,//$house_siteID,
        // 'p6' => 0,//$house_id,
        'd1_1' => $dataST_1_1,
        'd1_2' => $dataST_1_2,
        'd1_3' => $dataST_1_3,
        'd1_4' => $dataST_1_4,
        'd1_5' => $dataST_1_5,
        'd2_1' => $dataST_2_1,
        'd2_2' => $dataST_2_2,
        'd2_3' => $dataST_2_3,
        'd2_4' => $dataST_2_4,
        'd2_5' => $dataST_2_5,
        'd3_1' => $dataST_3_1,
        'd3_2' => $dataST_3_2,
        'd3_3' => $dataST_3_3,
        'd3_4' => $dataST_3_4,
        'd3_5' => $dataST_3_5,
        'd4_1' => $dataST_4_1,
        'd4_2' => $dataST_4_2,
        'd4_3' => $dataST_4_3,
        'd4_4' => $dataST_4_4,
        'd4_5' => $dataST_4_5,
        'd5_1' => $dataST_5_1,
        'd5_2' => $dataST_5_2,
        'd5_3' => $dataST_5_3,
        'd5_4' => $dataST_5_4,
        'd5_5' => $dataST_5_5,
        'd6_1' => $dataST_6_1,
        'd6_2' => $dataST_6_2,
        'd6_3' => $dataST_6_3,
        'd6_4' => $dataST_6_4,
        'd6_5' => $dataST_6_5,
        'd7_1' => $dataST_7_1,
        'd7_2' => $dataST_7_2,
        'd7_3' => $dataST_7_3,
        'd7_4' => $dataST_7_4,
        'd7_5' => $dataST_7_5,
        'd8_1' => $dataST_8_1,
        'd8_2' => $dataST_8_2,
        'd8_3' => $dataST_8_3,
        'd8_4' => $dataST_8_4,
        'd8_5' => $dataST_8_5,
        'd9_1' => $dataST_9_1,
        'd9_2' => $dataST_9_2,
        'd9_3' => $dataST_9_3,
        'd9_4' => $dataST_9_4,
        'd9_5' => $dataST_9_5,
        'd10_1' => $dataST_10_1,
        'd10_2' => $dataST_10_2,
        'd10_3' => $dataST_10_3,
        'd10_4' => $dataST_10_4,
        'd10_5' => $dataST_10_5,
        'd11_1' => $dataST_11_1,
        'd11_2' => $dataST_11_2,
        'd11_3' => $dataST_11_3,
        'd11_4' => $dataST_11_4,
        'd11_5' => $dataST_11_5,
        'd12_1' => $dataST_12_1,
        'd12_2' => $dataST_12_2,
        'd12_3' => $dataST_12_3,
        'd12_4' => $dataST_12_4,
        'd12_5' => $dataST_12_5,
        'd13_1' => $dataST_13_1,
        'd13_2' => $dataST_13_2,
        'd13_3' => $dataST_13_3,
        'd13_4' => $dataST_13_4,
        'd13_5' => $dataST_13_5,
        'd14_1' => $dataST_14_1,
        'd14_2' => $dataST_14_2,
        'd14_3' => $dataST_14_3,
        'd14_4' => $dataST_14_4,
        'd14_5' => $dataST_14_5,
        'd15_1' => $dataST_15_1,
        'd15_2' => $dataST_15_2,
        'd15_3' => $dataST_15_3,
        'd15_4' => $dataST_15_4,
        'd15_5' => $dataST_15_5,
        'Tbox'  => $dataST_TempMS
    ];
    // echo json_encode($data);
    // exit();

    try{
        $sql = "INSERT INTO tb_data_sensor (
            `data_timestamp`, `data_sn`, `data_date`, `data_time`,
            `dataST_1_1`, `dataST_1_2`, `dataST_1_3`, `dataST_1_4`, `dataST_1_5`,
            `dataST_2_1`, `dataST_2_2`, `dataST_2_3`, `dataST_2_4`, `dataST_2_5`,
            `dataST_3_1`, `dataST_3_2`, `dataST_3_3`, `dataST_3_4`, `dataST_3_5`,
            `dataST_4_1`, `dataST_4_2`, `dataST_4_3`, `dataST_4_4`, `dataST_4_5`,
            `dataST_5_1`, `dataST_5_2`, `dataST_5_3`, `dataST_5_4`, `dataST_5_5`,
            `dataST_6_1`, `dataST_6_2`, `dataST_6_3`, `dataST_6_4`, `dataST_6_5`,
            `dataST_7_1`, `dataST_7_2`, `dataST_7_3`, `dataST_7_4`, `dataST_7_5`,
            `dataST_8_1`, `dataST_8_2`, `dataST_8_3`, `dataST_8_4`, `dataST_8_5`,
            `dataST_9_1`, `dataST_9_2`, `dataST_9_3`, `dataST_9_4`, `dataST_9_5`,
            `dataST_10_1`, `dataST_10_2`, `dataST_10_3`, `dataST_10_4`, `dataST_10_5`,
            `dataST_11_1`, `dataST_11_2`, `dataST_11_3`, `dataST_11_4`, `dataST_11_5`,
            `dataST_12_1`, `dataST_12_2`, `dataST_12_3`, `dataST_12_4`, `dataST_12_5`,
            `dataST_13_1`, `dataST_13_2`, `dataST_13_3`, `dataST_13_4`, `dataST_13_5`,
            `dataST_14_1`, `dataST_14_2`, `dataST_14_3`, `dataST_14_4`, `dataST_14_5`,
            `dataST_15_1`, `dataST_15_2`, `dataST_15_3`, `dataST_15_4`, `dataST_15_5`,
            `dataST_timpMS`) VALUES (
            :p1, :p2, :p3, :p4,
            :d1_1,  :d1_2,  :d1_3,  :d1_4,  :d1_5,
            :d2_1,  :d2_2,  :d2_3,  :d2_4,  :d2_5,
            :d3_1,  :d3_2,  :d3_3,  :d3_4,  :d3_5,
            :d4_1,  :d4_2,  :d4_3,  :d4_4,  :d4_5,
            :d5_1,  :d5_2,  :d5_3,  :d5_4,  :d5_5,
            :d6_1,  :d6_2,  :d6_3,  :d6_4,  :d6_5,
            :d7_1,  :d7_2,  :d7_3,  :d7_4,  :d7_5,
            :d8_1,  :d8_2,  :d8_3,  :d8_4,  :d8_5,
            :d9_1,  :d9_2,  :d9_3,  :d9_4,  :d9_5,
            :d10_1, :d10_2, :d10_3, :d10_4, :d10_5,
            :d11_1, :d11_2, :d11_3, :d11_4, :d11_5,
            :d12_1, :d12_2, :d12_3, :d12_4, :d12_5,
            :d13_1, :d13_2, :d13_3, :d13_4, :d13_5,
            :d14_1, :d14_2, :d14_3, :d14_4, :d14_5,
            :d15_1, :d15_2, :d15_3, :d15_4, :d15_5,
            :Tbox )";
        if ($dbcon->prepare($sql)->execute($data) === TRUE) {
            $last_id = $dbcon->lastInsertId();
            if($_POST["count_set"] > 0){
                try{
                    $sql = "INSERT INTO tb_report_sensor (
                        `data_timestamp`, `data_sn`, `data_date`, `data_time`,
                        `dataST_1_1`, `dataST_1_2`, `dataST_1_3`, `dataST_1_4`, `dataST_1_5`,
                        `dataST_2_1`, `dataST_2_2`, `dataST_2_3`, `dataST_2_4`, `dataST_2_5`,
                        `dataST_3_1`, `dataST_3_2`, `dataST_3_3`, `dataST_3_4`, `dataST_3_5`,
                        `dataST_4_1`, `dataST_4_2`, `dataST_4_3`, `dataST_4_4`, `dataST_4_5`,
                        `dataST_5_1`, `dataST_5_2`, `dataST_5_3`, `dataST_5_4`, `dataST_5_5`,
                        `dataST_6_1`, `dataST_6_2`, `dataST_6_3`, `dataST_6_4`, `dataST_6_5`,
                        `dataST_7_1`, `dataST_7_2`, `dataST_7_3`, `dataST_7_4`, `dataST_7_5`,
                        `dataST_8_1`, `dataST_8_2`, `dataST_8_3`, `dataST_8_4`, `dataST_8_5`,
                        `dataST_9_1`, `dataST_9_2`, `dataST_9_3`, `dataST_9_4`, `dataST_9_5`,
                        `dataST_10_1`, `dataST_10_2`, `dataST_10_3`, `dataST_10_4`, `dataST_10_5`,
                        `dataST_11_1`, `dataST_11_2`, `dataST_11_3`, `dataST_11_4`, `dataST_11_5`,
                        `dataST_12_1`, `dataST_12_2`, `dataST_12_3`, `dataST_12_4`, `dataST_12_5`,
                        `dataST_13_1`, `dataST_13_2`, `dataST_13_3`, `dataST_13_4`, `dataST_13_5`,
                        `dataST_14_1`, `dataST_14_2`, `dataST_14_3`, `dataST_14_4`, `dataST_14_5`,
                        `dataST_15_1`, `dataST_15_2`, `dataST_15_3`, `dataST_15_4`, `dataST_15_5`,
                        `dataST_timpMS`) VALUES (
                        :p1, :p2, :p3, :p4,
                        :d1_1,  :d1_2,  :d1_3,  :d1_4,  :d1_5,
                        :d2_1,  :d2_2,  :d2_3,  :d2_4,  :d2_5,
                        :d3_1,  :d3_2,  :d3_3,  :d3_4,  :d3_5,
                        :d4_1,  :d4_2,  :d4_3,  :d4_4,  :d4_5,
                        :d5_1,  :d5_2,  :d5_3,  :d5_4,  :d5_5,
                        :d6_1,  :d6_2,  :d6_3,  :d6_4,  :d6_5,
                        :d7_1,  :d7_2,  :d7_3,  :d7_4,  :d7_5,
                        :d8_1,  :d8_2,  :d8_3,  :d8_4,  :d8_5,
                        :d9_1,  :d9_2,  :d9_3,  :d9_4,  :d9_5,
                        :d10_1, :d10_2, :d10_3, :d10_4, :d10_5,
                        :d11_1, :d11_2, :d11_3, :d11_4, :d11_5,
                        :d12_1, :d12_2, :d12_3, :d12_4, :d12_5,
                        :d13_1, :d13_2, :d13_3, :d13_4, :d13_5,
                        :d14_1, :d14_2, :d14_3, :d14_4, :d14_5,
                        :d15_1, :d15_2, :d15_3, :d15_4, :d15_5,
                        :Tbox )";
                    if ($dbcon->prepare($sql)->execute($data) === TRUE) {
                        echo json_encode(['status' => "OK",'data' => "Insert_Success",'time_new'=>$json->date_time,"SN" => $json->serial_id ] , JSON_UNESCAPED_UNICODE );
                    }else{
                        echo json_encode(['status' => 'Error','data' => "Insert_Error - ".$json->serial_id ] , JSON_UNESCAPED_UNICODE );
                    }
                }catch(Exception $ex){
                    echo $ex->getMessage();
                }
            }else{
                echo json_encode(['status' => "OK",'data' => "Insert_Success",'time_new'=>$json->date_time,"SN" => $json->serial_id ] , JSON_UNESCAPED_UNICODE );
            }
        }else{
            echo json_encode(['status' => 'Error','data' => "Insert_Error - ".$json->serial_id ] , JSON_UNESCAPED_UNICODE );
        }
    }catch(Exception $ex){
        echo $ex->getMessage();
    }
// } else
if ( isset($_POST["data_array2"]) ){
    $json1 = json_decode($_POST['data_array2']);
    $json2 = $json1->data_update->data;
    $json = $json2[0];
    $S_number = $json->serial_id;
     echo $S_number;
    // echo json_encode($S_number);
     exit();
    if($S_number == "KMUMT001" || $S_number == "KMUWE001" || $S_number == "KMUWE002" || $S_number == "OVTMT001"){
        if($S_number == "KMUMT001"){
            $house_siteID = "11";
            $house_id = "11";
        }elseif($S_number == "KMUWE001"){
            $house_siteID = "12";
            $house_id = "12";
        }elseif($S_number == "KMUWE002"){
            $house_siteID = "13";
            $house_id = "13";
        }elseif($S_number == "OVTMT001"){
            $house_siteID = "4";
            $house_id = "4";
        }
        // echo "house_siteID : ".$house_siteID." and house_id : ".$house_id;
        // exit();

        if(!isset( $json->data->data_st1_1 )){ $dataST_1_1 = 0; }else{ $dataST_1_1 = $json->data->data_st1_1; }
        if(!isset( $json->data->data_st1_2 )){ $dataST_1_2 = 0; }else{ $dataST_1_2 = $json->data->data_st1_2; }
        if(!isset( $json->data->data_st1_3 )){ $dataST_1_3 = 0; }else{ $dataST_1_3 = $json->data->data_st1_3; }
        if(!isset( $json->data->data_st1_4 )){ $dataST_1_4 = 0; }else{ $dataST_1_4 = $json->data->data_st1_4; }
        if(!isset( $json->data->dataST_1_5 )){ $dataST_1_5 = 0; }else{ $dataST_1_5 = $json->data->dataST_1_5; }
        if(!isset( $json->data->data_st2_1 )){ $dataST_2_1 = 0; }else{ $dataST_2_1 = $json->data->data_st2_1; }
        if(!isset( $json->data->data_st2_2 )){ $dataST_2_2 = 0; }else{ $dataST_2_2 = $json->data->data_st2_2; }
        if(!isset( $json->data->data_st2_3 )){ $dataST_2_3 = 0; }else{ $dataST_2_3 = $json->data->data_st2_3; }
        if(!isset( $json->data->data_st2_4 )){ $dataST_2_4 = 0; }else{ $dataST_2_4 = $json->data->data_st2_4; }
        if(!isset( $json->data->dataST_2_5 )){ $dataST_2_5 = 0; }else{ $dataST_2_5 = $json->data->dataST_2_5; }
        if(!isset( $json->data->data_st3_1 )){ $dataST_3_1 = 0; }else{ $dataST_3_1 = $json->data->data_st3_1; }
        if(!isset( $json->data->data_st3_2 )){ $dataST_3_2 = 0; }else{ $dataST_3_2 = $json->data->data_st3_2; }
        if(!isset( $json->data->data_st3_3 )){ $dataST_3_3 = 0; }else{ $dataST_3_3 = $json->data->data_st3_3; }
        if(!isset( $json->data->data_st3_4 )){ $dataST_3_4 = 0; }else{ $dataST_3_4 = $json->data->data_st3_4; }
        if(!isset( $json->data->dataST_3_5 )){ $dataST_3_5 = 0; }else{ $dataST_3_5 = $json->data->dataST_3_5; }
        if(!isset( $json->data->data_st4_1 )){ $dataST_4_1 = 0; }else{ $dataST_4_1 = $json->data->data_st4_1; }
        if(!isset( $json->data->data_st4_2 )){ $dataST_4_2 = 0; }else{ $dataST_4_2 = $json->data->data_st4_2; }
        if(!isset( $json->data->data_st4_3 )){ $dataST_4_3 = 0; }else{ $dataST_4_3 = $json->data->data_st4_3; }
        if(!isset( $json->data->data_st4_4 )){ $dataST_4_4 = 0; }else{ $dataST_4_4 = $json->data->data_st4_4; }
        if(!isset( $json->data->dataST_4_5 )){ $dataST_4_5 = 0; }else{ $dataST_4_5 = $json->data->dataST_4_5; }
        if(!isset( $json->data->dataST_5_1 )){ $dataST_5_1 = 0; }else{ $dataST_5_1 = $json->data->dataST_5_1; }
        if(!isset( $json->data->dataST_5_2 )){ $dataST_5_2 = 0; }else{ $dataST_5_2 = $json->data->dataST_5_2; }
        if(!isset( $json->data->dataST_5_3 )){ $dataST_5_3 = 0; }else{ $dataST_5_3 = $json->data->dataST_5_3; }
        if(!isset( $json->data->dataST_5_4 )){ $dataST_5_4 = 0; }else{ $dataST_5_4 = $json->data->dataST_5_4; }
        if(!isset( $json->data->dataST_5_5 )){ $dataST_5_5 = 0; }else{ $dataST_5_5 = $json->data->dataST_5_5; }
        if(!isset( $json->data->dataST_6_1 )){ $dataST_6_1 = 0; }else{ $dataST_6_1 = $json->data->dataST_6_1; }
        if(!isset( $json->data->dataST_6_2 )){ $dataST_6_2 = 0; }else{ $dataST_6_2 = $json->data->dataST_6_2; }
        if(!isset( $json->data->dataST_6_3 )){ $dataST_6_3 = 0; }else{ $dataST_6_3 = $json->data->dataST_6_3; }
        if(!isset( $json->data->dataST_6_4 )){ $dataST_6_4 = 0; }else{ $dataST_6_4 = $json->data->dataST_6_4; }
        if(!isset( $json->data->dataST_6_5 )){ $dataST_6_5 = 0; }else{ $dataST_6_5 = $json->data->dataST_6_5; }
        if(!isset( $json->data->dataST_7_1 )){ $dataST_7_1 = 0; }else{ $dataST_7_1 = $json->data->dataST_7_1; }
        if(!isset( $json->data->dataST_7_2 )){ $dataST_7_2 = 0; }else{ $dataST_7_2 = $json->data->dataST_7_2; }
        if(!isset( $json->data->dataST_7_3 )){ $dataST_7_3 = 0; }else{ $dataST_7_3 = $json->data->dataST_7_3; }
        if(!isset( $json->data->dataST_7_4 )){ $dataST_7_4 = 0; }else{ $dataST_7_4 = $json->data->dataST_7_4; }
        if(!isset( $json->data->dataST_7_5 )){ $dataST_7_5 = 0; }else{ $dataST_7_5 = $json->data->dataST_7_5; }
        if(!isset( $json->data->dataST_8_1 )){ $dataST_8_1 = 0; }else{ $dataST_8_1 = $json->data->dataST_8_1; }
        if(!isset( $json->data->dataST_8_2 )){ $dataST_8_2 = 0; }else{ $dataST_8_2 = $json->data->dataST_8_2; }
        if(!isset( $json->data->dataST_8_3 )){ $dataST_8_3 = 0; }else{ $dataST_8_3 = $json->data->dataST_8_3; }
        if(!isset( $json->data->dataST_8_4 )){ $dataST_8_4 = 0; }else{ $dataST_8_4 = $json->data->dataST_8_4; }
        if(!isset( $json->data->dataST_8_5 )){ $dataST_8_5 = 0; }else{ $dataST_8_5 = $json->data->dataST_8_5; }
        if(!isset( $json->data->dataST_9_1 )){ $dataST_9_1 = 0; }else{ $dataST_9_1 = $json->data->dataST_9_1; }
        if(!isset( $json->data->dataST_9_2 )){ $dataST_9_2 = 0; }else{ $dataST_9_2 = $json->data->dataST_9_2; }
        if(!isset( $json->data->dataST_9_3 )){ $dataST_9_3 = 0; }else{ $dataST_9_3 = $json->data->dataST_9_3; }
        if(!isset( $json->data->dataST_9_4 )){ $dataST_9_4 = 0; }else{ $dataST_9_4 = $json->data->dataST_9_4; }
        if(!isset( $json->data->dataST_9_5 )){ $dataST_9_5 = 0; }else{ $dataST_9_5 = $json->data->dataST_9_5; }
        if(!isset( $json->data->dataST_10_1 )){ $dataST_10_1 = 0; }else{ $dataST_10_1 = $json->data->dataST_10_1; }
        if(!isset( $json->data->dataST_10_2 )){ $dataST_10_2 = 0; }else{ $dataST_10_2 = $json->data->dataST_10_2; }
        if(!isset( $json->data->dataST_10_3 )){ $dataST_10_3 = 0; }else{ $dataST_10_3 = $json->data->dataST_10_3; }
        if(!isset( $json->data->dataST_10_4 )){ $dataST_10_4 = 0; }else{ $dataST_10_4 = $json->data->dataST_10_4; }
        if(!isset( $json->data->dataST_10_5 )){ $dataST_10_5 = 0; }else{ $dataST_10_5 = $json->data->dataST_10_5; }
        if(!isset( $json->data->dataST_11_1 )){ $dataST_11_1 = 0; }else{ $dataST_11_1 = $json->data->dataST_11_1; }
        if(!isset( $json->data->dataST_11_2 )){ $dataST_11_2 = 0; }else{ $dataST_11_2 = $json->data->dataST_11_2; }
        if(!isset( $json->data->dataST_11_3 )){ $dataST_11_3 = 0; }else{ $dataST_11_3 = $json->data->dataST_11_3; }
        if(!isset( $json->data->dataST_11_4 )){ $dataST_11_4 = 0; }else{ $dataST_11_4 = $json->data->dataST_11_4; }
        if(!isset( $json->data->dataST_11_5 )){ $dataST_11_5 = 0; }else{ $dataST_11_5 = $json->data->dataST_11_5; }
        if(!isset( $json->data->dataST_12_1 )){ $dataST_12_1 = 0; }else{ $dataST_12_1 = $json->data->dataST_12_1; }
        if(!isset( $json->data->dataST_12_2 )){ $dataST_12_2 = 0; }else{ $dataST_12_2 = $json->data->dataST_12_2; }
        if(!isset( $json->data->dataST_12_3 )){ $dataST_12_3 = 0; }else{ $dataST_12_3 = $json->data->dataST_12_3; }
        if(!isset( $json->data->dataST_12_4 )){ $dataST_12_4 = 0; }else{ $dataST_12_4 = $json->data->dataST_12_4; }
        if(!isset( $json->data->dataST_12_5 )){ $dataST_12_5 = 0; }else{ $dataST_12_5 = $json->data->dataST_12_5; }
        if(!isset( $json->data->dataST_13_1 )){ $dataST_13_1 = 0; }else{ $dataST_13_1 = $json->data->dataST_13_1; }
        if(!isset( $json->data->dataST_13_2 )){ $dataST_13_2 = 0; }else{ $dataST_13_2 = $json->data->dataST_13_2; }
        if(!isset( $json->data->dataST_13_3 )){ $dataST_13_3 = 0; }else{ $dataST_13_3 = $json->data->dataST_13_3; }
        if(!isset( $json->data->dataST_13_4 )){ $dataST_13_4 = 0; }else{ $dataST_13_4 = $json->data->dataST_13_4; }
        if(!isset( $json->data->dataST_13_5 )){ $dataST_13_5 = 0; }else{ $dataST_13_5 = $json->data->dataST_13_5; }
        if(!isset( $json->data->dataST_14_1 )){ $dataST_14_1 = 0; }else{ $dataST_14_1 = $json->data->dataST_14_1; }
        if(!isset( $json->data->dataST_14_2 )){ $dataST_14_2 = 0; }else{ $dataST_14_2 = $json->data->dataST_14_2; }
        if(!isset( $json->data->dataST_14_3 )){ $dataST_14_3 = 0; }else{ $dataST_14_3 = $json->data->dataST_14_3; }
        if(!isset( $json->data->dataST_14_4 )){ $dataST_14_4 = 0; }else{ $dataST_14_4 = $json->data->dataST_14_4; }
        if(!isset( $json->data->dataST_14_5 )){ $dataST_14_5 = 0; }else{ $dataST_14_5 = $json->data->dataST_14_5; }
        if(!isset( $json->data->dataST_15_1 )){ $dataST_15_1 = 0; }else{ $dataST_15_1 = $json->data->dataST_15_1; }
        if(!isset( $json->data->dataST_15_2 )){ $dataST_15_2 = 0; }else{ $dataST_15_2 = $json->data->dataST_15_2; }
        if(!isset( $json->data->dataST_15_3 )){ $dataST_15_3 = 0; }else{ $dataST_15_3 = $json->data->dataST_15_3; }
        if(!isset( $json->data->dataST_15_4 )){ $dataST_15_4 = 0; }else{ $dataST_15_4 = $json->data->dataST_15_4; }
        if(!isset( $json->data->dataST_15_5 )){ $dataST_15_5 = 0; }else{ $dataST_15_5 = $json->data->dataST_15_5; }
        if(!isset( $json->data->dataST_TempMS )){ $dataST_TempMS = 0; }else{ $dataST_TempMS = $json->data->dataST_TempMS; }


        $data = [
            'p1' => $json->date_time, //"2019/06/08 - ".$today_time,//$day_date." - ".$today_time,  //
            'p2' => $json->serial_id, //"000000005bd58d33",//
            'p3' => $json->date,
            'p4' => $json->time,
            'p5' => $house_siteID,
            'p6' => $house_id,
            'd1_1' => $dataST_1_1,
            'd1_2' => $dataST_1_2,
            'd1_3' => $dataST_1_3,
            'd1_4' => $dataST_1_4,
            'd1_5' => $dataST_1_5,
            'd2_1' => $dataST_2_1,
            'd2_2' => $dataST_2_2,
            'd2_3' => $dataST_2_3,
            'd2_4' => $dataST_2_4,
            'd2_5' => $dataST_2_5,
            'd3_1' => $dataST_3_1,
            'd3_2' => $dataST_3_2,
            'd3_3' => $dataST_3_3,
            'd3_4' => $dataST_3_4,
            'd3_5' => $dataST_3_5,
            'd4_1' => $dataST_4_1,
            'd4_2' => $dataST_4_2,
            'd4_3' => $dataST_4_3,
            'd4_4' => $dataST_4_4,
            'd4_5' => $dataST_4_5,
            'd5_1' => $dataST_5_1,
            'd5_2' => $dataST_5_2,
            'd5_3' => $dataST_5_3,
            'd5_4' => $dataST_5_4,
            'd5_5' => $dataST_5_5,
            'd6_1' => $dataST_6_1,
            'd6_2' => $dataST_6_2,
            'd6_3' => $dataST_6_3,
            'd6_4' => $dataST_6_4,
            'd6_5' => $dataST_6_5,
            'd7_1' => $dataST_7_1,
            'd7_2' => $dataST_7_2,
            'd7_3' => $dataST_7_3,
            'd7_4' => $dataST_7_4,
            'd7_5' => $dataST_7_5,
            'd8_1' => $dataST_8_1,
            'd8_2' => $dataST_8_2,
            'd8_3' => $dataST_8_3,
            'd8_4' => $dataST_8_4,
            'd8_5' => $dataST_8_5,
            'd9_1' => $dataST_9_1,
            'd9_2' => $dataST_9_2,
            'd9_3' => $dataST_9_3,
            'd9_4' => $dataST_9_4,
            'd9_5' => $dataST_9_5,
            'd10_1' => $dataST_10_1,
            'd10_2' => $dataST_10_2,
            'd10_3' => $dataST_10_3,
            'd10_4' => $dataST_10_4,
            'd10_5' => $dataST_10_5,
            'd11_1' => $dataST_11_1,
            'd11_2' => $dataST_11_2,
            'd11_3' => $dataST_11_3,
            'd11_4' => $dataST_11_4,
            'd11_5' => $dataST_11_5,
            'd12_1' => $dataST_12_1,
            'd12_2' => $dataST_12_2,
            'd12_3' => $dataST_12_3,
            'd12_4' => $dataST_12_4,
            'd12_5' => $dataST_12_5,
            'd13_1' => $dataST_13_1,
            'd13_2' => $dataST_13_2,
            'd13_3' => $dataST_13_3,
            'd13_4' => $dataST_13_4,
            'd13_5' => $dataST_13_5,
            'd14_1' => $dataST_14_1,
            'd14_2' => $dataST_14_2,
            'd14_3' => $dataST_14_3,
            'd14_4' => $dataST_14_4,
            'd14_5' => $dataST_14_5,
            'd15_1' => $dataST_15_1,
            'd15_2' => $dataST_15_2,
            'd15_3' => $dataST_15_3,
            'd15_4' => $dataST_15_4,
            'd15_5' => $dataST_15_5,
            'Tbox'  => $dataST_TempMS
        ];
         echo json_encode($data);
         exit();

        try{
            $sql = "INSERT INTO tb_data_sensor (
                `data_timestamp`, `data_sn`, `data_date`, `data_time`, `data_siteID`, `data_houseID`,
                `dataST_1_1`, `dataST_1_2`, `dataST_1_3`, `dataST_1_4`, `dataST_1_5`,
                `dataST_2_1`, `dataST_2_2`, `dataST_2_3`, `dataST_2_4`, `dataST_2_5`,
                `dataST_3_1`, `dataST_3_2`, `dataST_3_3`, `dataST_3_4`, `dataST_3_5`,
                `dataST_4_1`, `dataST_4_2`, `dataST_4_3`, `dataST_4_4`, `dataST_4_5`,
                `dataST_5_1`, `dataST_5_2`, `dataST_5_3`, `dataST_5_4`, `dataST_5_5`,
                `dataST_6_1`, `dataST_6_2`, `dataST_6_3`, `dataST_6_4`, `dataST_6_5`,
                `dataST_7_1`, `dataST_7_2`, `dataST_7_3`, `dataST_7_4`, `dataST_7_5`,
                `dataST_8_1`, `dataST_8_2`, `dataST_8_3`, `dataST_8_4`, `dataST_8_5`,
                `dataST_9_1`, `dataST_9_2`, `dataST_9_3`, `dataST_9_4`, `dataST_9_5`,
                `dataST_10_1`, `dataST_10_2`, `dataST_10_3`, `dataST_10_4`, `dataST_10_5`,
                `dataST_11_1`, `dataST_11_2`, `dataST_11_3`, `dataST_11_4`, `dataST_11_5`,
                `dataST_12_1`, `dataST_12_2`, `dataST_12_3`, `dataST_12_4`, `dataST_12_5`,
                `dataST_13_1`, `dataST_13_2`, `dataST_13_3`, `dataST_13_4`, `dataST_13_5`,
                `dataST_14_1`, `dataST_14_2`, `dataST_14_3`, `dataST_14_4`, `dataST_14_5`,
                `dataST_15_1`, `dataST_15_2`, `dataST_15_3`, `dataST_15_4`, `dataST_15_5`,
                `dataST_timpMS`) VALUES (
                :p1, :p2, :p3, :p4, :p5, :p6,
                :d1_1,  :d1_2,  :d1_3,  :d1_4,  :d1_5,
                :d2_1,  :d2_2,  :d2_3,  :d2_4,  :d2_5,
                :d3_1,  :d3_2,  :d3_3,  :d3_4,  :d3_5,
                :d4_1,  :d4_2,  :d4_3,  :d4_4,  :d4_5,
                :d5_1,  :d5_2,  :d5_3,  :d5_4,  :d5_5,
                :d6_1,  :d6_2,  :d6_3,  :d6_4,  :d6_5,
                :d7_1,  :d7_2,  :d7_3,  :d7_4,  :d7_5,
                :d8_1,  :d8_2,  :d8_3,  :d8_4,  :d8_5,
                :d9_1,  :d9_2,  :d9_3,  :d9_4,  :d9_5,
                :d10_1, :d10_2, :d10_3, :d10_4, :d10_5,
                :d11_1, :d11_2, :d11_3, :d11_4, :d11_5,
                :d12_1, :d12_2, :d12_3, :d12_4, :d12_5,
                :d13_1, :d13_2, :d13_3, :d13_4, :d13_5,
                :d14_1, :d14_2, :d14_3, :d14_4, :d14_5,
                :d15_1, :d15_2, :d15_3, :d15_4, :d15_5,
                :Tbox )";
            if ($dbcon->prepare($sql)->execute($data) === TRUE) {
                $last_id = $dbcon->lastInsertId();
                if($_POST["count_set"] > 0){
                    try{
                        $sql = "INSERT INTO tb_report_sensor (
                            `data_timestamp`, `data_sn`, `data_date`, `data_time`,
                            `dataST_1_1`, `dataST_1_2`, `dataST_1_3`, `dataST_1_4`, `dataST_1_5`,
                            `dataST_2_1`, `dataST_2_2`, `dataST_2_3`, `dataST_2_4`, `dataST_2_5`,
                            `dataST_3_1`, `dataST_3_2`, `dataST_3_3`, `dataST_3_4`, `dataST_3_5`,
                            `dataST_4_1`, `dataST_4_2`, `dataST_4_3`, `dataST_4_4`, `dataST_4_5`,
                            `dataST_5_1`, `dataST_5_2`, `dataST_5_3`, `dataST_5_4`, `dataST_5_5`,
                            `dataST_6_1`, `dataST_6_2`, `dataST_6_3`, `dataST_6_4`, `dataST_6_5`,
                            `dataST_7_1`, `dataST_7_2`, `dataST_7_3`, `dataST_7_4`, `dataST_7_5`,
                            `dataST_8_1`, `dataST_8_2`, `dataST_8_3`, `dataST_8_4`, `dataST_8_5`,
                            `dataST_9_1`, `dataST_9_2`, `dataST_9_3`, `dataST_9_4`, `dataST_9_5`,
                            `dataST_10_1`, `dataST_10_2`, `dataST_10_3`, `dataST_10_4`, `dataST_10_5`,
                            `dataST_11_1`, `dataST_11_2`, `dataST_11_3`, `dataST_11_4`, `dataST_11_5`,
                            `dataST_12_1`, `dataST_12_2`, `dataST_12_3`, `dataST_12_4`, `dataST_12_5`,
                            `dataST_13_1`, `dataST_13_2`, `dataST_13_3`, `dataST_13_4`, `dataST_13_5`,
                            `dataST_14_1`, `dataST_14_2`, `dataST_14_3`, `dataST_14_4`, `dataST_14_5`,
                            `dataST_15_1`, `dataST_15_2`, `dataST_15_3`, `dataST_15_4`, `dataST_15_5`,
                            `dataST_timpMS`) VALUES (
                            :p1, :p2, :p3, :p4,
                            :d1_1,  :d1_2,  :d1_3,  :d1_4,  :d1_5,
                            :d2_1,  :d2_2,  :d2_3,  :d2_4,  :d2_5,
                            :d3_1,  :d3_2,  :d3_3,  :d3_4,  :d3_5,
                            :d4_1,  :d4_2,  :d4_3,  :d4_4,  :d4_5,
                            :d5_1,  :d5_2,  :d5_3,  :d5_4,  :d5_5,
                            :d6_1,  :d6_2,  :d6_3,  :d6_4,  :d6_5,
                            :d7_1,  :d7_2,  :d7_3,  :d7_4,  :d7_5,
                            :d8_1,  :d8_2,  :d8_3,  :d8_4,  :d8_5,
                            :d9_1,  :d9_2,  :d9_3,  :d9_4,  :d9_5,
                            :d10_1, :d10_2, :d10_3, :d10_4, :d10_5,
                            :d11_1, :d11_2, :d11_3, :d11_4, :d11_5,
                            :d12_1, :d12_2, :d12_3, :d12_4, :d12_5,
                            :d13_1, :d13_2, :d13_3, :d13_4, :d13_5,
                            :d14_1, :d14_2, :d14_3, :d14_4, :d14_5,
                            :d15_1, :d15_2, :d15_3, :d15_4, :d15_5,
                            :Tbox )";
                        if ($dbcon->prepare($sql)->execute($data) === TRUE) {
                            echo json_encode(['status' => "OK",'data' => "Insert_Success",'time_new'=>$json->date_time,"SN" => $json->serial_id ] , JSON_UNESCAPED_UNICODE );
                        }else{
                            echo json_encode(['status' => 'Error','data' => "Insert_Error - ".$json->serial_id ] , JSON_UNESCAPED_UNICODE );
                        }
                    }catch(Exception $ex){
                        echo $ex->getMessage();
                    }
                }else{
                    echo json_encode(['status' => "OK",'data' => "Insert_Success",'time_new'=>$json->date_time,"SN" => $json->serial_id ] , JSON_UNESCAPED_UNICODE );
                }
            }else{
                echo json_encode(['status' => 'Error','data' => "Insert_Error - ".$json->serial_id ], JSON_UNESCAPED_UNICODE );
            }
        }catch(Exception $ex){
            echo $ex->getMessage();
        }
    }
}else{
    echo json_encode("No_Data");
}
