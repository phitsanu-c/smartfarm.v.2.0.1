<?php
require '../connectdb.php';
$house_master = $_POST["house_master"];
$start_day = date("Y/m/d - H:i:s", strtotime('-1 day'));//'-6 hour'));
$stop_day = date("Y/m/d - H:i:s");

$config = $_POST['data'];
$dashStatus = $config['dashStatus'];
$dashName = $config['dashName'];
$dashName2 = $config['dashName2'];
$dashSncanel = $config['dashSncanel'];
$dashMode = $config['dashMode'];

$NameT = [];
$NameH = [];
$NameS = [];
$NameL = [];
$unitT = [];
$unitH = [];
$unitS = [];
$unitL = [];

for ($i = 1; $i <= 40; $i++) {
    if($dashStatus[$i] == 1){
        if($dashMode[$i] == 1){
            $channel['temp'][] = 'round('.$dashSncanel[$i].', 1) AS Temp_';
            $NameT[] = $dashName2[$i];
            $unitT = 1;
        }elseif($dashMode[$i] == 2){
            $channel['hum'][] = 'round('.$dashSncanel[$i].', 1) AS Hum_';
            $NameH[] = $dashName2[$i];
            $unitH = 2;
        }elseif($dashMode[$i] == 3){
            $channel['soil'][] = 'round('.$dashSncanel[$i].', 1) AS Soil_';
            $NameS[] = $dashName2[$i];
            $unitS = 3;
        }elseif($dashMode[$i] == 4){
            $channel['light'][] = 'round('.$dashSncanel[$i].'/1000, 1) AS Light_';
            $NameL[] = $dashName2[$i];
            $unitL = 4;
        }elseif($dashMode[$i] == 5){
            $channel['light'][] = 'round('.$dashSncanel[$i].'/54, 1) AS Light_';
            $NameL[] = $dashName2[$i];
            $unitL = 5;
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
// echo $sql;
// echo isset($channel['temp']);
// echo count($channel['temp']);
// exit();
$stmt = $dbcon->query("SELECT data_timestamp, $Nchannel FROM tb_data_sensor WHERE data_sn = '$house_master' AND data_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY data_timestamp ");
$data1 = [];
$data2 = [];
$data3 = [];
$data4 = [];
foreach ($stmt as $row) {
    if(isset($channel['temp'])){
        for($i = 1; $i <= count($channel['temp']); $i++){
            $data1['temp_'.$i][] = [
                            'x' => substr($row['data_timestamp'],0,18),
                            'y' => floatval($row['Temp_'.$i])
                        ];
        }
    }
    if(isset($channel['hum'])){
        for($i = 1; $i <= count($channel['hum']); $i++){
            $data2['hum_'.$i][] = [
                            'x' => substr($row['data_timestamp'],0,18),
                            'y' => floatval($row['Hum_'.$i])
                        ];
        }
    }
    if(isset($channel['soil'])){
        for($i = 1; $i <= count($channel['soil']); $i++){
            $data3['soil_'.$i][] = [
                            'x' => substr($row['data_timestamp'],0,18),
                            'y' => floatval($row['Soil_'.$i])
                        ];
        }
    }
    if(isset($channel['light'])){
        for($i = 1; $i <= count($channel['light']); $i++){
            $data4['light_'.$i][] = [
                            'x' => substr($row['data_timestamp'],0,18),
                            'y' => floatval($row['Light_'.$i])
                        ];
        }
    }
}
// echo json_encode($dd);
echo json_encode([
    'temp'  => $data1,
    'Ntemp' => $NameT,
    'UnitT' => $unitT,

    'hum'   => $data2,
    'Nhum'  => $NameH,
    'UnitH' => $unitH,

    'soil'  => $data3,
    'Nsoil' => $NameS,
    'UnitS' => $unitS,

    'light' => $data4,
    'Nlight' => $NameL,
    'UnitL'  => $unitL
//  // 'theme' => $_SESSION["login_theme"]
]);
