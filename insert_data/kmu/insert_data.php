<?php
  require "../connectdb2.php";
    //$json1 = json_decode($_POST['data_array2']);
    //$json2 = $json1->data_update->data;
    //$json = $json2[0];
    //$S_number = $json->serial_id; 
    //echo $json1;
    //echo $_POST['data_array2'];
    //exit();
if ( isset($_POST["data_array2"]) ){
    $json1 = json_decode($_POST['data_array2']);
    $json2 = $json1->data_update->data;
    $json = $json2[0];
    $S_number = $json->serial_id; 
    //  echo $S_number;
    // echo json_encode($S_number);
    //  exit();
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
            'Tbox'  => $dataST_TempMS,
            'c'     => $_POST['count']
        ];
        //  echo json_encode($data);
        //  exit();
        
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
                `dataST_timpMS`, `data_re`) VALUES (
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
                :Tbox, :c )";
            if ($dbcon->prepare($sql)->execute($data) === TRUE) {
                $last_id = $dbcon->lastInsertId();
                // if($_POST["count_set"] > 0){
                    
                // }else{
                    echo json_encode(['status' => "OK",'data' => "Insert_Success",'time_new'=>$json->date_time,"SN" => $json->serial_id ] , JSON_UNESCAPED_UNICODE );
                // }
            }else{
                echo json_encode(['status' => 'Error','data' => "Insert_Error - ".$json->serial_id ], JSON_UNESCAPED_UNICODE );
            } 
        }catch(Exception $ex){
            echo $ex->getMessage();
        }
    }
}
if(isset($_POST['data_array'])) {
    $json = json_decode($_POST['data_array']);
    // $S_number = $json->serial_id;
    // echo $S_number;
    // exit();
    
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
        'Tbox'  => $dataST_TempMS,
        'c'     => $_POST['count']
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
            `dataST_timpMS`, `data_re`) VALUES (
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
            :Tbox, :c )";
        if ($dbcon->prepare($sql)->execute($data) === TRUE) {
            // $last_id = $dbcon->lastInsertId();
            echo json_encode(['status' => "OK",'data' => "Insert_Success",'time_new'=>$json->date_time,"SN" => $json->serial_id ] , JSON_UNESCAPED_UNICODE );
        }else{
            echo json_encode(['status' => 'Error','data' => "Insert_Error - ".$json->serial_id ] , JSON_UNESCAPED_UNICODE );
        } 
    }catch(Exception $ex){
        echo $ex->getMessage();
    }
}
else{
    echo json_encode("No_Data");
}