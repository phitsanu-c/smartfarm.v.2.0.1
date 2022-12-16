<?php
require '../connectdb.php';
$house_master = $_POST["house_master"];
$start_day = date("Y-m-d H:i:s", strtotime('-1 day'));//'-6 hour'));
$stop_day = date("Y-m-d H:i:s");
$numb = intval(substr($house_master, 5,10));
$channel = 'round(data_temp_out_'.$numb.',1) AS temp_out,
            round(data_hum_out_'.$numb.',1) AS hum_out,
            round((data_light_out_'.$numb.'/54),1) AS light_out,
            round(data_temp_in_'.$numb.',1) AS temp_in,
            round(data_hum_in_'.$numb.',1) AS hum_in,
            round((data_light_in_'.$numb.'/54),1) AS light_in,
            round(data_soil_in_'.$numb.',1) AS soil_in';
// echo $channel;
// exit();
if($_POST['eq'] == 0){
    $tb_name = 'tbn_data_tu';
}else {
    $tb_name = 'tbn_data_tu_eq';
}
$sql = "SELECT data_timestamp, $channel FROM $tb_name WHERE data_sn = 'TUSMT' AND data_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY data_timestamp ";
$stmt = $dbcon->query($sql);
$data0 = [];
while ($row = $stmt->fetch()) {
    $data0['temp_out'][] = [
                    'x' => substr($row['data_timestamp'],0,16),
                    'y' => $row['temp_out']
                ];
    $data0['temp_in'][] = [
                    'x' => substr($row['data_timestamp'],0,16),
                    'y' => $row['temp_in']
                ];
    $data0['hum_out'][] = [
                    'x' => substr($row['data_timestamp'],0,16),
                    'y' => $row['hum_out']
                ];
    $data0['hum_in'][] = [
                    'x' => substr($row['data_timestamp'],0,16),
                    'y' => $row['hum_in']
                ];
    $data0['light_out'][] = [
                    'x' => substr($row['data_timestamp'],0,16),
                    'y' => $row['light_out']
                ];
    $data0['light_in'][] = [
                    'x' => substr($row['data_timestamp'],0,16),
                    'y' => $row['light_in']
                ];
    $data0['soil_in'][] = [
                    'x' => substr($row['data_timestamp'],0,16),
                    'y' => $row['soil_in']
                ];
   // $data0['timestamp'][] = substr($row['data_timestamp'],0,16);
   // $data0['temp_out'][]  = $row['temp_out'];
   // $data0['hum_out'][]   = $row['hum_out'];
   // $data0['light_out'][] = $row['light_out'];
   // $data0['temp_in'][]   = $row['temp_in'];
   // $data0['hum_in'][]    = $row['hum_in'];
   // $data0['light_in'][]  = $row['light_in'];
   // $data0['soil_in'][]   = $row['soil_in'];
}

   echo json_encode([
     'data'=>$data0,
     'theme' => $_SESSION["login_theme"]
  ]);
