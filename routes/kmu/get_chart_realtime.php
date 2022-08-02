<?php
require '../connectdb.php';
$house_master = $_POST["house_master"];
$start_day = date("Y/m/d - H:i:s", strtotime('-5 day'));//'-6 hour'));
$stop_day = date("Y/m/d - H:i:s");
$numb = intval(substr($house_master, 5,10));
$channel = 'round(dataST_2_3, 1) AS temp_out,
            round(dataST_2_4, 1) AS hum_out,
            round(dataST_2_2, 1) AS light_out,
            round(dataST_1_3, 1) AS temp_in,
            round(dataST_1_4, 1) AS hum_in,
            round(dataST_1_2, 1) AS light_in,
            round(dataST_3_2, 1) AS soil_in1,
            round(dataST_3_4, 1) AS soil_in2';
// echo $channel;
// exit();
$sql = "SELECT data_timestamp, $channel FROM tb_data_sensor WHERE data_sn = '$house_master' AND data_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY data_timestamp ";
$stmt = $dbcon->query($sql);
$data0 = [];
while ($row = $stmt->fetch()) {
    $data0['temp_out'][] = [
                    'x' => substr($row['data_timestamp'],0,18),
                    'y' => $row['temp_out']
                ];
    $data0['temp_in'][] = [
                    'x' => substr($row['data_timestamp'],0,18),
                    'y' => $row['temp_in']
                ];
    $data0['hum_out'][] = [
                    'x' => substr($row['data_timestamp'],0,18),
                    'y' => $row['hum_out']
                ];
    $data0['hum_in'][] = [
                    'x' => substr($row['data_timestamp'],0,18),
                    'y' => $row['hum_in']
                ];
    $data0['light_out'][] = [
                    'x' => substr($row['data_timestamp'],0,18),
                    'y' => $row['light_out']
                ];
    $data0['light_in'][] = [
                    'x' => substr($row['data_timestamp'],0,18),
                    'y' => $row['light_in']
                ];
    $data0['soil_in1'][] = [
                    'x' => substr($row['data_timestamp'],0,18),
                    'y' => $row['soil_in1']
                ];
    $data0['soil_in2'][] = [
                    'x' => substr($row['data_timestamp'],0,18),
                    'y' => $row['soil_in2']
                ];
}

   echo json_encode([
     'data'=>$data0,
     'theme' => $_SESSION["login_theme"]
  ]);
