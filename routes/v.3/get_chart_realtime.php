<?php
require '../connectdb.php';
$house_master = $_POST["house_master"];
$start_day = '2022/07/24 - 00:00:00';//date("Y/m/d - H:i:s", strtotime('-1 day'));//'-6 hour'));
$stop_day = '2022/07/25 - 23:59:00';//date("Y/m/d - H:i:s");

$config = $_POST['data'];
$dashStatus = $config['dashStatus'];
$dashName = $config['dashName'];
$dashName2 = $config['dashName2'];
$dashSncanel = $config['dashSncanel'];
$dashMode = $config['dashMode'];

for ($i = 1; $i <= 40; $i++) {
    if($dashStatus[$i] == 1){
        if($dashMode[$i] == 1){
            $channel['temp'][] = 'round('.$dashSncanel[$i].', 1) AS Temp_';
            $NameT[] = $dashName2[$i];
        }elseif($dashMode[$i] == 2){
            $channel['hum'][] = 'round('.$dashSncanel[$i].', 1) AS Hum_';
        }elseif($dashMode[$i] == 3){
            $channel['soil'][] = 'round('.$dashSncanel[$i].', 1) AS Soil_';
        }elseif($dashMode[$i] == 4){
            $channel['light'][] = 'round('.$dashSncanel[$i].'/1000, 1) AS Light_';
        }
    }
}
if(isset($channel['temp'])){
    for($i = 1; $i <= count($channel['temp']); $i++){
        $new_channel[] = $channel['temp'][$i-1].$i;
    }
}
if(isset($channel['hum'])){
    for($i = 1; $i <= count($channel['hum']); $i++){
        $new_channel[] = $channel['hum'][$i-1].$i;
    }
}
if(isset($channel['soil'])){
    for($i = 1; $i <= count($channel['soil']); $i++){
        $new_channel[] = $channel['soil'][$i-1].$i;
    }
}
if(isset($channel['light'])){
    for($i = 1; $i <= count($channel['light']); $i++){
        $new_channel[] = $channel['light'][$i-1].$i;
    }
}
$Nchannel = implode(", ", $new_channel);
// echo $Nchannel;
// exit();
$sql = "SELECT data_timestamp, $Nchannel FROM tb_data_sensor WHERE data_sn = '$house_master' AND data_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY data_timestamp ";
$stmt = $dbcon->query($sql);
$data1 = [];
$data2 = [];
$data3 = [];
$data4 = [];
while ($row = $stmt->fetch()) {
    if(isset($channel['temp'])){
        for($i = 1; $i <= count($channel['temp']); $i++){
            $data1['temp_'.$i][] = [
                            'x' => substr($row['data_timestamp'],0,18),
                            'y' => $row['Temp_'.$i]
                        ];
        }
    }
    if(isset($channel['hum'])){
        for($i = 1; $i <= count($channel['hum']); $i++){
            $data2['hum_'.$i][] = [
                            'x' => substr($row['data_timestamp'],0,18),
                            'y' => $row['Hum_'.$i]
                        ];
        }
    }
    if(isset($channel['soil'])){
        for($i = 1; $i <= count($channel['soil']); $i++){
            $data3['soil_'.$i][] = [
                            'x' => substr($row['data_timestamp'],0,18),
                            'y' => $row['Soil_'.$i]
                        ];
        }
    }
    if(isset($channel['light'])){
        for($i = 1; $i <= count($channel['light']); $i++){
            $data4['light_'.$i][] = [
                            'x' => substr($row['data_timestamp'],0,18),
                            'y' => $row['Light_'.$i]
                        ];
        }
    }
}
echo json_encode([
    'temp'  => $data1,
    'Ntemp' => $NameT,
    'hum'   => $data2,
    'soil'  => $data3,
    'light' => $data4,
 // 'theme' => $_SESSION["login_theme"]
]);
