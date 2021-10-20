<?php
    // session_start();
    
    $db["host"] = "localhost";
    $db["user"] = "root";
    $db["pass"] = "";
    $db["name"] = "new_smartfarm"; //"inet_mqtt_smart_farm"; //"smart_farm_mqtt";

    try{
        $dbcon = new PDO( "mysql:host=".$db["host"]."; dbname=".$db["name"]."", $db["user"], $db["pass"],
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" ));
    }catch(PDOException $ex){
        echo $ex->getMessage();
    }
    function MonthDays($someMonth, $someYear){
        return date("t", strtotime($someYear . "-" . $someMonth . "-01"));
    }

    $house_master = $_POST["sn"];
    if ($_POST["month"] <10) {
        $month = '0'.$_POST["month"];
    }else{
        $month = $_POST["month"];
    }
    $row_1 = $dbcon->query("SELECT * FROM tb_set_maxmin WHERE set_maxmin_sn = '$house_master'")->fetch();
    $row_2 = $dbcon->query("SELECT * FROM tb3_dashstatus WHERE dashstatus_sn = '$house_master'")->fetch();
    $row_4 = $dbcon->query("SELECT * FROM tb3_sncanel WHERE sncanel_sn = '$house_master'")->fetch();
    $row_5 = $dbcon->query("SELECT * FROM tb3_statussn WHERE statussn_sn = '$house_master'")->fetch();
    $dashStatus[1] = intval($row_2["dashstatus_1_1"]);
    $dashStatus[2] = intval($row_2["dashstatus_1_2"]);
    $dashStatus[3] = intval($row_2["dashstatus_1_3"]);
    $dashStatus[4] = intval($row_2["dashstatus_1_4"]);
    $dashStatus[5] = intval($row_2["dashstatus_2_1"]);
    $dashStatus[6] = intval($row_2["dashstatus_2_2"]);
    $dashStatus[7] = intval($row_2["dashstatus_2_3"]);
    $dashStatus[8] = intval($row_2["dashstatus_2_4"]);
    $dashStatus[9] = intval($row_2["dashstatus_3_1"]);
    $dashStatus[10] = intval($row_2["dashstatus_3_2"]);
    $dashStatus[11] = intval($row_2["dashstatus_3_3"]);
    $dashStatus[12] = intval($row_2["dashstatus_3_4"]);
    $dashStatus[13] = intval($row_2["dashstatus_4_1"]);
    $dashStatus[14] = intval($row_2["dashstatus_4_2"]);
    $dashStatus[15] = intval($row_2["dashstatus_4_3"]);
    $dashStatus[16] = intval($row_2["dashstatus_4_4"]);
    $dashStatus[17] = intval($row_2["dashstatus_5_1"]);
    $dashStatus[18] = intval($row_2["dashstatus_5_2"]);
    $dashStatus[19] = intval($row_2["dashstatus_5_3"]);
    $dashStatus[20] = intval($row_2["dashstatus_5_4"]);
    $dashStatus[21] = intval($row_2["dashstatus_6_1"]);
    $dashStatus[22] = intval($row_2["dashstatus_6_2"]);
    $dashStatus[23] = intval($row_2["dashstatus_6_3"]);
    $dashStatus[24] = intval($row_2["dashstatus_6_4"]);
    $dashStatus[25] = intval($row_2["dashstatus_7_1"]);
    $dashStatus[26] = intval($row_2["dashstatus_7_2"]);
    $dashStatus[27] = intval($row_2["dashstatus_7_3"]);
    $dashStatus[28] = intval($row_2["dashstatus_7_4"]);
    $dashStatus[29] = intval($row_2["dashstatus_8_1"]);
    $dashStatus[30] = intval($row_2["dashstatus_8_2"]);
    $dashStatus[31] = intval($row_2["dashstatus_8_3"]);
    $dashStatus[32] = intval($row_2["dashstatus_8_4"]);
    $dashStatus[33] = intval($row_2["dashstatus_9_1"]);
    $dashStatus[34] = intval($row_2["dashstatus_9_2"]);
    $dashStatus[35] = intval($row_2["dashstatus_9_3"]);
    $dashStatus[36] = intval($row_2["dashstatus_9_4"]);
    $dashStatus[37] = intval($row_2["dashstatus_10_1"]);
    $dashStatus[38] = intval($row_2["dashstatus_10_2"]);
    $dashStatus[39] = intval($row_2["dashstatus_10_3"]);
    $dashStatus[40] = intval($row_2["dashstatus_10_4"]);
    $status_t1 = array_count_values($dashStatus)['1'];

    $set_Tmin = $row_1["set_Tmin"];
    $set_Tmax = $row_1["set_Tmax"];
    $set_Hmin = $row_1["set_Hmin"];
    $set_Hmax = $row_1["set_Hmax"];
    $set_Lmin = $row_1["set_Lmin"];
    $set_Lmax = $row_1["set_Lmax"];
    $set_Smin = $row_1["set_Smin"];
    $set_Smax = $row_1["set_Smax"];
    
    if($row_5["statussn_1_1"] == 1){
        $text_1 = $row_4["sncanel_1_1"]."<=".$set_Tmin." OR ".$row_4["sncanel_1_1"].">=".$set_Tmax;
    }
    if($row_5["statussn_1_1"] == 2){
        $text_1 = $row_4["sncanel_1_1"]."<=".$set_Hmin." OR ".$row_4["sncanel_1_1"].">=".$set_Hmax;
    }
    if($row_5["statussn_1_1"] == 3){
        $text_1 = $row_4["sncanel_1_1"]."<=".$set_Lmin." OR ".$row_4["sncanel_1_1"].">=".$set_Lmax;
    }
    if($row_5["statussn_1_1"] == 4){
        $text_1 = $row_4["sncanel_1_1"]."<=".$set_Smin." OR ".$row_4["sncanel_1_1"].">=".$set_Smax;
    }
    // -----------------------
    if($row_5["statussn_1_2"] == 1){
        $text_2 = " OR ".$row_4["sncanel_1_2"]."<=".$set_Tmin." OR ".$row_4["sncanel_1_2"].">=".$set_Tmax;
    }
    if($row_5["statussn_1_2"] == 2){
        $text_2 = " OR ".$row_4["sncanel_1_2"]."<=".$set_Hmin." OR ".$row_4["sncanel_1_2"].">=".$set_Hmax;
    }
    if($row_5["statussn_1_2"] == 3){
        $text_2 = " OR ".$row_4["sncanel_1_2"]."<=".$set_Lmin." OR ".$row_4["sncanel_1_2"].">=".$set_Lmax;
    }
    if($row_5["statussn_1_2"] == 4){
        $text_2 = " OR ".$row_4["sncanel_1_2"]."<=".$set_Smin." OR ".$row_4["sncanel_1_2"].">=".$set_Smax;
    }
    // -----------------------
    if($row_5["statussn_1_3"] == 1){
        $text_3 = " OR ".$row_4["sncanel_1_3"]."<=".$set_Tmin." OR ".$row_4["sncanel_1_3"].">=".$set_Tmax;
    }
    if($row_5["statussn_1_3"] == 2){
        $text_3 = " OR ".$row_4["sncanel_1_3"]."<=".$set_Hmin." OR ".$row_4["sncanel_1_3"].">=".$set_Hmax;
    }
    if($row_5["statussn_1_3"] == 3){
        $text_3 = " OR ".$row_4["sncanel_1_3"]."<=".$set_Lmin." OR ".$row_4["sncanel_1_3"].">=".$set_Lmax;
    }
    if($row_5["statussn_1_3"] == 4){
        $text_3 = " OR ".$row_4["sncanel_1_3"]."<=".$set_Smin." OR ".$row_4["sncanel_1_3"].">=".$set_Smax;
    }
    // -----------------------
    if($row_5["statussn_1_4"] == 1){
        $text_4 = " OR ".$row_4["sncanel_1_4"]."<=".$set_Tmin." OR ".$row_4["sncanel_1_4"].">=".$set_Tmax;
    }
    if($row_5["statussn_1_4"] == 2){
        $text_4 = " OR ".$row_4["sncanel_1_4"]."<=".$set_Hmin." OR ".$row_4["sncanel_1_4"].">=".$set_Hmax;
    }
    if($row_5["statussn_1_4"] == 3){
        $text_4 = " OR ".$row_4["sncanel_1_4"]."<=".$set_Lmin." OR ".$row_4["sncanel_1_4"].">=".$set_Lmax;
    }
    if($row_5["statussn_1_4"] == 4){
        $text_4 = " OR ".$row_4["sncanel_1_4"]."<=".$set_Smin." OR ".$row_4["sncanel_1_4"].">=".$set_Smax;
    }
    // -----------------------
    if($row_5["statussn_2_1"] == 1){
        $text_5 = " OR ".$row_4["sncanel_2_1"]."<=".$set_Tmin." OR ".$row_4["sncanel_2_1"].">=".$set_Tmax;
    }
    if($row_5["statussn_2_1"] == 2){
        $text_5 = " OR ".$row_4["sncanel_2_1"]."<=".$set_Hmin." OR ".$row_4["sncanel_2_1"].">=".$set_Hmax;
    }
    if($row_5["statussn_2_1"] == 3){
        $text_5 = " OR ".$row_4["sncanel_2_1"]."<=".$set_Lmin." OR ".$row_4["sncanel_2_1"].">=".$set_Lmax;
    }
    if($row_5["statussn_2_1"] == 4){
        $text_5 = " OR ".$row_4["sncanel_2_1"]."<=".$set_Smin." OR ".$row_4["sncanel_2_1"].">=".$set_Smax;
    }
    // -----------------------
    if($row_5["statussn_2_2"] == 1){
        $text_6 = " OR ".$row_4["sncanel_2_2"]."<=".$set_Tmin." OR ".$row_4["sncanel_2_2"].">=".$set_Tmax;
    }
    if($row_5["statussn_2_2"] == 2){
        $text_6 = " OR ".$row_4["sncanel_2_2"]."<=".$set_Hmin." OR ".$row_4["sncanel_2_2"].">=".$set_Hmax;
    }
    if($row_5["statussn_2_2"] == 3){
        $text_6 = " OR ".$row_4["sncanel_2_2"]."<=".$set_Lmin." OR ".$row_4["sncanel_2_2"].">=".$set_Lmax;
    }
    if($row_5["statussn_2_2"] == 4){
        $text_6 = " OR ".$row_4["sncanel_2_2"]."<=".$set_Smin." OR ".$row_4["sncanel_2_2"].">=".$set_Smax;
    }
    // -----------------------
    if($row_5["statussn_2_3"] == 1){
        $text_7 = " OR ".$row_4["sncanel_2_3"]."<=".$set_Tmin." OR ".$row_4["sncanel_2_3"].">=".$set_Tmax;
    }
    if($row_5["statussn_2_3"] == 2){
        $text_7 = " OR ".$row_4["sncanel_2_3"]."<=".$set_Hmin." OR ".$row_4["sncanel_2_3"].">=".$set_Hmax;
    }
    if($row_5["statussn_2_3"] == 3){
        $text_7 = " OR ".$row_4["sncanel_2_3"]."<=".$set_Lmin." OR ".$row_4["sncanel_2_3"].">=".$set_Lmax;
    }
    if($row_5["statussn_2_3"] == 4){
        $text_7 = " OR ".$row_4["sncanel_2_3"]."<=".$set_Smin." OR ".$row_4["sncanel_2_3"].">=".$set_Smax;
    }
    // -----------------------
    if($row_5["statussn_2_4"] == 1){
        $text_8 = " OR ".$row_4["sncanel_2_4"]."<=".$set_Tmin." OR ".$row_4["sncanel_2_4"].">=".$set_Tmax;
    }
    if($row_5["statussn_2_4"] == 2){
        $text_8 = " OR ".$row_4["sncanel_2_4"]."<=".$set_Hmin." OR ".$row_4["sncanel_2_4"].">=".$set_Hmax;
    }
    if($row_5["statussn_2_4"] == 3){
        $text_8 = " OR ".$row_4["sncanel_2_4"]."<=".$set_Lmin." OR ".$row_4["sncanel_2_4"].">=".$set_Lmax;
    }
    if($row_5["statussn_2_4"] == 4){
        $text_8 = " OR ".$row_4["sncanel_2_4"]."<=".$set_Smin." OR ".$row_4["sncanel_2_4"].">=".$set_Smax;
    }
    // -----------------------
    if($row_5["statussn_3_1"] == 1){
        $text_9 = " OR ".$row_4["sncanel_3_1"]."<=".$set_Tmin." OR ".$row_4["sncanel_3_1"].">=".$set_Tmax;
    }
    if($row_5["statussn_3_1"] == 2){
        $text_9 = " OR ".$row_4["sncanel_3_1"]."<=".$set_Hmin." OR ".$row_4["sncanel_3_1"].">=".$set_Hmax;
    }
    if($row_5["statussn_3_1"] == 3){
        $text_9 = " OR ".$row_4["sncanel_3_1"]."<=".$set_Lmin." OR ".$row_4["sncanel_3_1"].">=".$set_Lmax;
    }
    if($row_5["statussn_3_1"] == 4){
        $text_9 = " OR ".$row_4["sncanel_3_1"]."<=".$set_Smin." OR ".$row_4["sncanel_3_1"].">=".$set_Smax;
    }
    // -----------------------
    if($row_5["statussn_3_2"] == 1){
        $text_10 = " OR ".$row_4["sncanel_3_2"]."<=".$set_Tmin." OR ".$row_4["sncanel_3_2"].">=".$set_Tmax;
    }
    if($row_5["statussn_3_2"] == 2){
        $text_10 = " OR ".$row_4["sncanel_3_2"]."<=".$set_Hmin." OR ".$row_4["sncanel_3_2"].">=".$set_Hmax;
    }
    if($row_5["statussn_3_2"] == 3){
        $text_10 = " OR ".$row_4["sncanel_3_2"]."<=".$set_Lmin." OR ".$row_4["sncanel_3_2"].">=".$set_Lmax;
    }
    if($row_5["statussn_3_2"] == 4){
        $text_10 = " OR ".$row_4["sncanel_3_2"]."<=".$set_Smin." OR ".$row_4["sncanel_3_2"].">=".$set_Smax;
    }
    // -----------------------
    if($row_5["statussn_3_3"] == 1){
        $text_11 = " OR ".$row_4["sncanel_3_3"]."<=".$set_Tmin." OR ".$row_4["sncanel_3_3"].">=".$set_Tmax;
    }
    if($row_5["statussn_3_3"] == 2){
        $text_11 = " OR ".$row_4["sncanel_3_3"]."<=".$set_Hmin." OR ".$row_4["sncanel_3_3"].">=".$set_Hmax;
    }
    if($row_5["statussn_3_3"] == 3){
        $text_11 = " OR ".$row_4["sncanel_3_3"]."<=".$set_Lmin." OR ".$row_4["sncanel_3_3"].">=".$set_Lmax;
    }
    if($row_5["statussn_3_3"] == 4){
        $text_11 = " OR ".$row_4["sncanel_3_3"]."<=".$set_Smin." OR ".$row_4["sncanel_3_3"].">=".$set_Smax;
    }
    // -----------------------
    if($row_5["statussn_3_4"] == 1){
        $text_12 = " OR ".$row_4["sncanel_3_4"]."<=".$set_Tmin." OR ".$row_4["sncanel_3_4"].">=".$set_Tmax;
    }
    if($row_5["statussn_3_4"] == 2){
        $text_12 = " OR ".$row_4["sncanel_3_4"]."<=".$set_Hmin." OR ".$row_4["sncanel_3_4"].">=".$set_Hmax;
    }
    if($row_5["statussn_3_4"] == 3){
        $text_12 = " OR ".$row_4["sncanel_3_4"]."<=".$set_Lmin." OR ".$row_4["sncanel_3_4"].">=".$set_Lmax;
    }
    if($row_5["statussn_3_4"] == 4){
        $text_12 = " OR ".$row_4["sncanel_3_4"]."<=".$set_Smin." OR ".$row_4["sncanel_3_4"].">=".$set_Smax;
    }
    if ($status_t1 == 1) {
        $nsql = $text_1;
    }else if ($status_t1 == 2) {
        $nsql = $text_1.$text_2;
    }else if ($status_t1 == 3) {
        $nsql = $text_1.$text_2.$text_3;
    }else if ($status_t1 == 4) {
        $nsql = $text_1.$text_2.$text_3.$text_4;
    }else if ($status_t1 == 5) {
        $nsql = $text_1.$text_2.$text_3.$text_4.$text_5;
    }else if ($status_t1 == 6) {
        $nsql = $text_1.$text_2.$text_3.$text_4.$text_5.$text_6;
    }else if ($status_t1 == 7) {
        $nsql = $text_1.$text_2.$text_3.$text_4.$text_5.$text_6.$text_7;
    }else if ($status_t1 == 8) {
        $nsql = $text_1.$text_2.$text_3.$text_4.$text_5.$text_6.$text_7.$text_8;
    }else if ($status_t1 == 9) {
        $nsql = $text_1.$text_2.$text_3.$text_4.$text_5.$text_6.$text_7.$text_8.$text_9;
    }else if ($status_t1 == 10) {
        $nsql = $text_1.$text_2.$text_3.$text_4.$text_5.$text_6.$text_7.$text_8.$text_9.$text_10;
    }else if ($status_t1 == 11) {
        $nsql = $text_1.$text_2.$text_3.$text_4.$text_5.$text_6.$text_7.$text_8.$text_9.$text_10.$text_11;
    }else if ($status_t1 == 12) {
        $nsql = $text_1.$text_2.$text_3.$text_4.$text_5.$text_6.$text_7.$text_8.$text_9.$text_10.$text_11.$text_12;
    }
    // echo $nsql;
    // exit();

    for($i= 1; $i<= $_POST["getDay"]; $i++){
        if($i < 10){
            $date = $_POST["year"].'/'.$month.'/0'.$i;
        }else{
            $date = $_POST["year"].'/'.$month.'/'.$i;
        }
        $chack_ = $dbcon->query("SELECT COUNT('data_sn') FROM tb_report_sensor WHERE data_sn = '$house_master' AND data_date = '$date' ")->fetch();
        if($chack_[0] > 0){
            if($i == $_POST["getDay"]){
                echo json_encode(['status' => "มีรายชื่อนี้แล้ว"], JSON_UNESCAPED_UNICODE );
            }
        }else{
            $stmt2 = $dbcon->query("SELECT count(data_id) AS count_data FROM tb_data_sensor WHERE data_sn = '$house_master' AND data_date ='$date'")->fetch();
            if($stmt2[0] == 0){
                if($i == $_POST["getDay"]){
                    echo json_encode(['status' => "No data",$stmt2[0]], JSON_UNESCAPED_UNICODE );                    
                }else{
                    echo json_encode(['status' => "No data",$stmt2[0]], JSON_UNESCAPED_UNICODE ); 
                }
                exit();
            }
            $sql = "SELECT * FROM tb_data_sensor WHERE data_sn = '".$house_master."' AND data_date ='".$date."' AND (".$nsql.")";
            // echo $sql;
            $stmt = $dbcon->query($sql);
            while ($row = $stmt->fetch()) {
                // echo $date.' - '.$row['data_date'].", ".$row['data_sn']."<br />\n";
                $datai = [
                    'p1' => $row["data_timestamp"],
                    'p2' => $row["data_sn"],
                    'p3' => $row["data_date"],
                    'p4' => $row["data_time"],
                    'd1_1' => $row["dataST_1_1"],
                    'd1_2' => $row["dataST_1_2"],   
                    'd1_3' => $row["dataST_1_3"],
                    'd1_4' => $row["dataST_1_4"],
                    'd1_5' => $row["dataST_1_5"],
                    'd2_1' => $row["dataST_2_1"],
                    'd2_2' => $row["dataST_2_2"],   
                    'd2_3' => $row["dataST_2_3"],
                    'd2_4' => $row["dataST_2_4"],
                    'd2_5' => $row["dataST_2_5"],
                    'd3_1' => $row["dataST_3_1"],
                    'd3_2' => $row["dataST_3_2"],   
                    'd3_3' => $row["dataST_3_3"],
                    'd3_4' => $row["dataST_3_4"],
                    'd3_5' => $row["dataST_3_5"],
                    'd4_1' => $row["dataST_4_1"],
                    'd4_2' => $row["dataST_4_2"],   
                    'd4_3' => $row["dataST_4_3"],
                    'd4_4' => $row["dataST_4_4"],
                    'd4_5' => $row["dataST_4_5"],
                    'd5_1' => $row["dataST_5_1"],
                    'd5_2' => $row["dataST_5_2"],   
                    'd5_3' => $row["dataST_5_3"],
                    'd5_4' => $row["dataST_5_4"],
                    'd5_5' => $row["dataST_5_5"],
                    'd6_1' => $row["dataST_6_1"],
                    'd6_2' => $row["dataST_6_2"],   
                    'd6_3' => $row["dataST_6_3"],
                    'd6_4' => $row["dataST_6_4"],
                    'd6_5' => $row["dataST_6_5"],
                    'd7_1' => $row["dataST_7_1"],
                    'd7_2' => $row["dataST_7_2"],  
                    'd7_3' => $row["dataST_7_3"],
                    'd7_4' => $row["dataST_7_4"],
                    'd7_5' => $row["dataST_7_5"],
                    'd8_1' => $row["dataST_8_1"],
                    'd8_2' => $row["dataST_8_2"],  
                    'd8_3' => $row["dataST_8_3"],
                    'd8_4' => $row["dataST_8_4"],
                    'd8_5' => $row["dataST_8_5"],
                    'd9_1' => $row["dataST_9_1"],
                    'd9_2' => $row["dataST_9_2"],  
                    'd9_3' => $row["dataST_9_3"],
                    'd9_4' => $row["dataST_9_4"],
                    'd9_5' => $row["dataST_9_5"],
                    'd10_1' => $row["dataST_10_1"],
                    'd10_2' => $row["dataST_10_2"],  
                    'd10_3' => $row["dataST_10_3"],
                    'd10_4' => $row["dataST_10_4"],
                    'd10_5' => $row["dataST_10_5"],
                    'd11_1' => $row["dataST_11_1"],
                    'd11_2' => $row["dataST_11_2"],  
                    'd11_3' => $row["dataST_11_3"],
                    'd11_4' => $row["dataST_11_4"],
                    'd11_5' => $row["dataST_11_5"],
                    'd12_1' => $row["dataST_12_1"],
                    'd12_2' => $row["dataST_12_2"],  
                    'd12_3' => $row["dataST_12_3"],
                    'd12_4' => $row["dataST_12_4"],
                    'd12_5' => $row["dataST_12_5"],
                    'd13_1' => $row["dataST_13_1"],
                    'd13_2' => $row["dataST_13_2"],  
                    'd13_3' => $row["dataST_13_3"],
                    'd13_4' => $row["dataST_13_4"],
                    'd13_5' => $row["dataST_13_5"],
                    'd14_1' => $row["dataST_14_1"],
                    'd14_2' => $row["dataST_14_2"],  
                    'd14_3' => $row["dataST_14_3"],
                    'd14_4' => $row["dataST_14_4"],
                    'd14_5' => $row["dataST_14_5"],
                    'd15_1' => $row["dataST_15_1"],
                    'd15_2' => $row["dataST_15_2"],  
                    'd15_3' => $row["dataST_15_3"],
                    'd15_4' => $row["dataST_15_4"],
                    'd15_5' => $row["dataST_15_5"],
                    'Tbox'  => $row["dataST_timpMS"]
                ];
                // echo json_encode($data);
                // exit();
                
                
                    $sqli = "INSERT INTO tb_report_sensor (
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
                // exit();
                if ($dbcon->prepare($sqli)->execute($datai) === TRUE) {
                    if($i == $_POST["getDay"]){
                        echo json_encode(['status'=>"success"]);
                    }
                }else{
                    if($i == $_POST["getDay"]){
                        echo json_encode(['status'=>"error"]);
                    }
                }
            }
        }
    }


    // SELECT * FROM tb_data_sensor WHERE data_sn = 'KO7MT001' AND data_date ='2020/07/30' AND (dataST_1_3<=10 OR dataST_1_3>=50 OR dataST_1_4<=10 OR dataST_1_4>=100 OR dataST_2_3<=10 OR dataST_2_3>=50 OR dataST_2_4<=10 OR dataST_2_4>=100 OR dataST_3_3<=10 OR dataST_3_3>=50 OR dataST_3_4<=10 OR dataST_3_4>=100 OR dataST_4_3<=10 OR dataST_4_3>=50 OR dataST_4_4<=10 OR dataST_4_4>=100 OR dataST_5_3<=10 OR dataST_5_3>=50 OR dataST_5_4<=10 OR dataST_5_4>=100 OR dataST_6_3<=10 OR dataST_6_3>=50 OR dataST_6_4<=10 OR dataST_6_4>=100)   ORDER BY `data_timestamp` DESC