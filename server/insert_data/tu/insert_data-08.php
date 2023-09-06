<?php
  require "../connectdb.php";
    // $json1 = json_decode($_POST['data_array']);
    //$json2 = $json1->data_update->data;
    //$json = $json2[0];
    //$S_number = $json->serial_id; 
    // echo $json1;
    // print_r($_POST);
    // exit();
// if(isset($_POST['data_array'])) {
    $json1 = json_decode($_POST['data_1']);
    // print_r($json1);
    // exit();

    // $json2 = json_decode($_POST['data_2']);
    // $json3 = json_decode($_POST['data_3']);
    // $json4 = json_decode($_POST['data_4']);
    // $json5 = json_decode($_POST['data_5']);
    // $json6 = json_decode($_POST['data_6']);
    // $json7 = json_decode($_POST['data_7']);
    // $S_number = $json->serial_id;
    // echo $S_number;
    // $json = $_POST['data_array'];
    // echo $json->date_time1;
    // if(!isset($_POST['sn'])){$data['sn']='';}else{$data['sn']=$_POST['sn'];}
    // if(!isset($json1->date_time1)){$data['t1']='';}else{$data['t1']=$json1->date_time1;}
    // if(!isset($json2->date_time2)){$data['t2']='';}else{$data['t2']=$json2->date_time2;}
    // if(!isset($json3->date_time3)){$data['t3']='';}else{$data['t3']=$json3->date_time3;}
    // if(!isset($json4->date_time4)){$data['t4']='';}else{$data['t4']=$json4->date_time4;}
    // if(!isset($json5->date_time5)){$data['t5']='';}else{$data['t5']=$json5->date_time5;}
    // if(!isset($json6->date_time6)){$data['t6']='';}else{$data['t6']=$json6->date_time6;}
    // if(!isset($json7->date_time7)){$data['t7']='';}else{$data['t7']=$json7->date_time7;}

    // if(!isset($json1->temp_out1)){$data['to1']=0;}else{$data['to1']=$json1->temp_out1;}
    // if(!isset($json2->temp_out2)){$data['to2']=0;}else{$data['to2']=$json2->temp_out2;}
    // if(!isset($json3->temp_out3)){$data['to3']=0;}else{$data['to3']=$json3->temp_out3;}
    // if(!isset($json4->temp_out4)){$data['to4']=0;}else{$data['to4']=$json4->temp_out4;}
    // if(!isset($json5->temp_out5)){$data['to5']=0;}else{$data['to5']=$json5->temp_out5;}
    // if(!isset($json6->temp_out6)){$data['to6']=0;}else{$data['to6']=$json6->temp_out6;}
    // if(!isset($json7->temp_out7)){$data['to7']=0;}else{$data['to7']=$json7->temp_out7;}

    // if(!isset($json1->hum_out1)){$data['ho1']=0;}else{$data['ho1']=$json1->hum_out1;}
    // if(!isset($json2->hum_out2)){$data['ho2']=0;}else{$data['ho2']=$json2->hum_out2;}
    // if(!isset($json3->hum_out3)){$data['ho3']=0;}else{$data['ho3']=$json3->hum_out3;}
    // if(!isset($json4->hum_out4)){$data['ho4']=0;}else{$data['ho4']=$json4->hum_out4;}
    // if(!isset($json5->hum_out5)){$data['ho5']=0;}else{$data['ho5']=$json5->hum_out5;}
    // if(!isset($json6->hum_out6)){$data['ho6']=0;}else{$data['ho6']=$json6->hum_out6;}
    // if(!isset($json7->hum_out7)){$data['ho7']=0;}else{$data['ho7']=$json7->hum_out7;}

    // if(!isset($json1->light_out1)){$data['lo1']=0;}else{$data['lo1']=$json1->light_out1;}
    // if(!isset($json2->light_out2)){$data['lo2']=0;}else{$data['lo2']=$json2->light_out2;}
    // if(!isset($json3->light_out3)){$data['lo3']=0;}else{$data['lo3']=$json3->light_out3;}
    // if(!isset($json4->light_out4)){$data['lo4']=0;}else{$data['lo4']=$json4->light_out4;}
    // if(!isset($json5->light_out5)){$data['lo5']=0;}else{$data['lo5']=$json5->light_out5;}
    // if(!isset($json6->light_out6)){$data['lo6']=0;}else{$data['lo6']=$json6->light_out6;}
    // if(!isset($json7->light_out7)){$data['lo7']=0;}else{$data['lo7']=$json7->light_out7;}

    // if(!isset($json1->temp_in1)){$data['ti1']=0;}else{$data['ti1']=$json1->temp_in1;}
    // if(!isset($json2->temp_in2)){$data['ti2']=0;}else{$data['ti2']=$json2->temp_in2;}
    // if(!isset($json3->temp_in3)){$data['ti3']=0;}else{$data['ti3']=$json3->temp_in3;}
    // if(!isset($json4->temp_in4)){$data['ti4']=0;}else{$data['ti4']=$json4->temp_in4;}
    // if(!isset($json5->temp_in5)){$data['ti5']=0;}else{$data['ti5']=$json5->temp_in5;}
    // if(!isset($json6->temp_in6)){$data['ti6']=0;}else{$data['ti6']=$json6->temp_in6;}
    // if(!isset($json7->temp_in7)){$data['ti7']=0;}else{$data['ti7']=$json7->temp_in7;}

    // if(!isset($json1->hum_in1)){$data['hi1']=0;}else{$data['hi1']=$json1->hum_in1;}
    // if(!isset($json2->hum_in2)){$data['hi2']=0;}else{$data['hi2']=$json2->hum_in2;}
    // if(!isset($json3->hum_in3)){$data['hi3']=0;}else{$data['hi3']=$json3->hum_in3;}
    // if(!isset($json4->hum_in4)){$data['hi4']=0;}else{$data['hi4']=$json4->hum_in4;}
    // if(!isset($json5->hum_in5)){$data['hi5']=0;}else{$data['hi5']=$json5->hum_in5;}
    // if(!isset($json6->hum_in6)){$data['hi6']=0;}else{$data['hi6']=$json6->hum_in6;}
    // if(!isset($json7->hum_in7)){$data['hi7']=0;}else{$data['hi7']=$json7->hum_in7;}

    // if(!isset($json1->light_in1)){$data['li1']=0;}else{$data['li1']=$json1->light_in1;}
    // if(!isset($json2->light_in2)){$data['li2']=0;}else{$data['li2']=$json2->light_in2;}
    // if(!isset($json3->light_in3)){$data['li3']=0;}else{$data['li3']=$json3->light_in3;}
    // if(!isset($json4->light_in4)){$data['li4']=0;}else{$data['li4']=$json4->light_in4;}
    // if(!isset($json5->light_in5)){$data['li5']=0;}else{$data['li5']=$json5->light_in5;}
    // if(!isset($json6->light_in6)){$data['li6']=0;}else{$data['li6']=$json6->light_in6;}
    // if(!isset($json7->light_in7)){$data['li7']=0;}else{$data['li7']=$json7->light_in7;}

    // if(!isset($json1->soil_in1)){$data['si1']=0;}else{$data['si1']=$json1->soil_in1;}
    // if(!isset($json2->soil_in2)){$data['si2']=0;}else{$data['si2']=$json2->soil_in2;}
    // if(!isset($json3->soil_in3)){$data['si3']=0;}else{$data['si3']=$json3->soil_in3;}
    // if(!isset($json4->soil_in4)){$data['si4']=0;}else{$data['si4']=$json4->soil_in4;}
    // if(!isset($json5->soil_in5)){$data['si5']=0;}else{$data['si5']=$json5->soil_in5;}
    // if(!isset($json6->soil_in6)){$data['si6']=0;}else{$data['si6']=$json6->soil_in6;}
    // if(!isset($json7->soil_in7)){$data['si7']=0;}else{$data['si7']=$json7->soil_in7;}

    // if(!isset($json1->res_1)){$data['res_1']=0;}else{$data['res_1']=$json1->res_1;}
    // if(!isset($json2->res_2)){$data['res_2']=0;}else{$data['res_2']=$json2->res_2;}
    // if(!isset($json3->res_3)){$data['res_3']=0;}else{$data['res_3']=$json3->res_3;}
    // if(!isset($json4->res_4)){$data['res_4']=0;}else{$data['res_4']=$json4->res_4;}
    // if(!isset($json5->res_5)){$data['res_5']=0;}else{$data['res_5']=$json5->res_5;}
    // if(!isset($json6->res_6)){$data['res_6']=0;}else{$data['res_6']=$json6->res_6;}
    // if(!isset($json7->res_7)){$data['res_7']=0;}else{$data['res_7']=$json7->res_7;}
    $data = [
        'sn' => $json1->serial_id,
        't1' => $json1->date.' '.$json1->time,
        'to1' => $json1->data->temp_out,
        'ho1' => $json1->data->hum_out,
        'lo1' => $json1->data->light_out,
        'ti1' => $json1->data->temp_in,
        'hi1' => $json1->data->hum_in,
        'li1' => $json1->data->light_in,
        'si1' => $json1->data->soil_in
    ];
    // $data['dtimestamp'] = date("Y-m-d").' '.date("H:i:s");
    // echo json_encode($data);
    // exit();
    $sql = "INSERT INTO `tbn_data_08`(`data_timestamp`, `data_sn`, 
            `data_time_out`, `data_hum_out`, `data_light_out`, 
            `data_temp_in`, `data_hum_in`, `data_light_in`, `data_soil_in`) VALUES(
            :t1,:sn,
            :to1, :ho1, :lo1, :ti1, :hi1, :li1, :si1
            )";
    if ($dbcon->prepare($sql)->execute($data) === TRUE) {
        echo json_encode(['status' => "OK",'data' => "Insert_Success" ], JSON_UNESCAPED_UNICODE );
    }else{
        echo json_encode(['status' => 'Error','data' => "Insert_Error"] , JSON_UNESCAPED_UNICODE );
    } 
// }else{
//     echo json_encode("No_Data");
// }